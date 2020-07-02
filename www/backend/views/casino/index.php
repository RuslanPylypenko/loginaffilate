<?php

use common\helpers\CasinoHelper;
use common\models\Casino;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\searchModels\CasinoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Казино';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casino-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать казино', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Топ казино', ['top-casino/index'], ['class' => 'btn btn-default']) ?>

        <?= Html::a('Сео', ['seo'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Рекламные блоки', ['advertising'], ['class' => 'btn btn-info']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'title',
                'value' => function (Casino $model) {
                    return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            [
                'contentOptions' => ['style' => 'width: 100px'],
                'filter' => false,
                'attribute' => 'Лого',
                'value' => function (Casino $model) {
                    return Html::a(
                        Html::img($model->getThumbFileUrl('logo_small', 'small')),
                        ['view', 'id' => $model->id],
                        ['class' => 'thumbnail', 'target' => '_blank']
                    );
                },
                'format' => 'raw',
            ],
            //'website',
            //'description:ntext',

            [
                'contentOptions' => ['style' => 'width: 180px'],
                'attribute' => 'Статус',
                'filter' => false,
                'value' => function (Casino $model) {
                    return CasinoHelper::tagLabels($model);
                },
                'format' => 'raw',
            ],

            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 8.7%'],
                'visible' => Yii::$app->user->isGuest ? false : true,
                'template' => '{update} {activate} {delete}',
                'buttons' => [
                    'activate' => function ($url, Casino $model) {
                        if ($model->isActive()) {
                            return Html::a("<span class='glyphicon glyphicon-eye-close'></span>",
                                [
                                    'draft', 'id' => $model->id], [
                                    'class' => 'btn btn-default btn-xs',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ]);
                        } else {
                            return Html::a("<span class='glyphicon glyphicon-eye-open'></span>",
                                [
                                    'activate', 'id' => $model->id], [
                                    'class' => 'btn btn-default btn-xs',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ]);
                        }

                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
