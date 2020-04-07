<?php

use common\models\TopCasino;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \backend\forms\TopCasinoForm */

$this->title = 'Топ казино';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-casino-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="top-casino-form">

        <?php $form = ActiveForm::begin(); ?>

        <?php echo $form->field($model, 'casinoIds', [
            'addon' => [
                'append' => [
                    'content' => Html::submitButton('Добавить', ['class' => 'btn btn-primary']),
                    'asButton' => true
                ]
            ]
        ])->widget(Select2::classname(), [
            'data' => $model->loadCasinos(),
            'language' => 'ru',
            'options' => [
                'placeholder' => 'Выберите казино из списка ...',
                'multiple' => true
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>


        <?php ActiveForm::end(); ?>

    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'casino.title',
                'value' => function (TopCasino $model) {
                    return Html::a(Html::encode($model->casino->title), ['casino/view', 'id' => $model->casino_id]);
                },
                'format' => 'raw',
            ],

            [
                'attribute' => 'Добавлено в топ',
                'value' => function (TopCasino $model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'medium');
                },
                'format' => 'raw',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 8.7%'],
                'visible' => Yii::$app->user->isGuest ? false : true,
                'template' => '{up} {down} {delete}',
                'buttons' => [
                    'up' => function ($url, TopCasino $model) {
                        if (!$model->isFirst())
                            return Html::a("<span class='glyphicon glyphicon-arrow-up'></span>",
                                [
                                    'up', 'id' => $model->casino_id], [
                                    'class' => 'btn btn-default btn-xs',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ]);
                    },

                    'down' => function ($url, TopCasino $model) {
                        if (!$model->isLast())
                            return Html::a("<span class='glyphicon glyphicon-arrow-down'></span>",
                                [
                                    'down', 'id' => $model->casino_id], [
                                    'class' => 'btn btn-default btn-xs',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ]);
                    },

                    'delete' => function ($url, TopCasino $model) {
                        return Html::a("<span class='glyphicon glyphicon-trash'></span>",
                            [
                                'remove-from-top-list', 'id' => $model->casino_id], [
                                'class' => 'btn btn-default btn-xs',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);
                    },
                ],
            ],

        ],
    ]); ?>


</div>
