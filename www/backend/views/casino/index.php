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

$this->title = 'Casinos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casino-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать казино', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Топ казино', ['create'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Реклама казино', ['create'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Переменная категория казино', ['create'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Детали казино', ['create'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Фильтр казино', ['create'], ['class' => 'btn btn-default']) ?>
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
            'logo',
            //'website',
            //'description:ntext',

            [
                'attribute' => 'status',
                'filter' => $searchModel->statusList(),
                'value' => function (Casino $model) {
                    return CasinoHelper::statusLabel($model->status);
                },
                'format' => 'raw',
            ],

//            ['class' => 'yii\grid\ActionColumn',
//                'contentOptions' => ['style' => 'width: 8.7%'],
//                'visible' => Yii::$app->user->isGuest ? false : true,
//                'template' => '{update} {activate}',
//                'buttons' => [
//                    'update' => function ($url, $model) {
//                        $t = 'index.php?r=site/update&id=' . $model->id;
//                        return Html::button('edit', ['value' => Url::to($t), 'class' => 'btn btn-default btn-xs']);
//                    },
//                    'activate' => function ($url, $model) {
//                        return Html::a('activate', ['/casino/active', 'id' => $model->id], ['class' => 'btn btn-success btn-xs']);
//                    },
//                ],
//            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
