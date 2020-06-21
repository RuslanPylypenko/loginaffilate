<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use kartik\icons\FontAwesomeAsset;

FontAwesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \backend\forms\advertising\CreateAdvertising */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provider-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">

            <div class="panel panel-info">
                <div class="panel-heading"><b>Общее</b></div>
                <div class="panel-body">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Название') ?>

                    <?php echo $form->field($model, 'advertiser')->widget(Select2::classname(), [
                        'data' => $model->loadAdvertisers(),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Выберите рекламодателя ....', 'multiple' => false],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Рекламодатель'); ?>

                    <?= $form->field($model, 'dateStart')->widget(DatePicker::class, [
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'mm/dd/yyyy'
                        ]
                    ])->label('Дата начала рк') ?>
                </div>
            </div>


            <?php if ($model->getPaidAdvert()): ?>
                <div class="panel panel-success">
                    <div class="panel-heading"><b>Оплата</b></div>
                    <div class="panel-body">

                        <?php echo $form->field($model->getPaidAdvert(), 'paidType')->widget(Select2::classname(), [
                            'data' => $model->getPaidAdvert()->loadPaidTypes(),
                            'language' => 'ru',
                            'options' => ['placeholder' => 'Выберите тип оплаты', 'multiple' => false],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label('Тип оплаты'); ?>

                        <?= $form->field($model->getPaidAdvert(), 'budget', [
                            'addon' => ['prepend' => ['content' => '<i class="fas fa-dollar-sign"></i>']]
                        ])->textInput(['maxlength' => true])->label('Бюджет') ?>

                        <?= $form->field($model->getPaidAdvert(), 'price', [
                            'addon' => ['prepend' => ['content' => '<i class="fas fa-dollar-sign"></i>']]
                        ])->textInput(['maxlength' => true])->label('Цена') ?>

                        <?= $form->field($model->getPaidAdvert(), 'bonus', [
                            'addon' => ['prepend' => ['content' => '<i class="fas fa-plus-square"></i>']]
                        ])->textInput(['maxlength' => true])->label('Бонус') ?>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Дополнительная информация</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Кликов осталось</td>
                                    <td>40</td>
                                </tr>
                                <tr>
                                    <td>Просмотров осталось</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Дней осталось</td>
                                    <td>-</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($model->getFreeAdvdert()): ?>
                <div class="panel panel-success">
                    <div class="panel-heading"><b>Бесплатная реклама</b></div>
                    <div class="panel-body">
                        <?= $form->field($model->getFreeAdvdert(), 'dateEnd')->widget(DatePicker::class, [
                            'removeButton' => false,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'mm/dd/yyyy'
                            ]
                        ])->label('Дата окончания рк') ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
        <div class="col-sm-6">

            <?php if ($model->getBannerAdvdert()): ?>
                <div class="panel panel-primary">
                    <div class="panel-heading"><b>Баннер</b></div>
                    <div class="panel-body">

                        <?php echo $form->field($model->getBannerAdvdert(), 'block')->widget(Select2::classname(), [
                            'data' => $model->getBannerAdvdert()->loadBlockList(),
                            'language' => 'ru',
                            'options' => ['placeholder' => 'Выберите местоположение', 'multiple' => false],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label('Блок'); ?>

                        <?php echo $form->field($model->getBannerAdvdert(), 'photo')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'],
                        ])->label('Баннер'); ?>


                        <div class="panel panel-default">
                            <div class="panel-heading">Ccылка</div>
                            <div class="panel-body">
                                <?= $form->field($model->getBannerAdvdert()->getLink(), 'title')->textInput(['maxlength' => true])->label('Подпись') ?>
                                <?= $form->field($model->getBannerAdvdert()->getLink(), 'href', [
                                    'addon' => ['prepend' => ['content' => '<i class="fas fa-globe"></i>']]
                                ])->textInput(['maxlength' => true])->label('Url') ?>
                                <?= $form->field($model->getBannerAdvdert()->getLink(), 'options')
                                    ->checkboxList($model->getBannerAdvdert()->getLink()->loadOptions(), ['inline' => true]); ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif; ?>


            <!-- TICKER -->
            <?php if ($model->getTickerAdvdert()): ?>
                <div class="panel panel-primary">
                    <div class="panel-heading"><b>Бегущая строка</b></div>
                    <div class="panel-body">

                        <?php echo $form->field($model->getTickerAdvdert(), 'content')->textarea(['rows' => 4])->label('Контент'); ?>


                        <div class="panel panel-default">
                            <div class="panel-heading">Ccылка</div>
                            <div class="panel-body">
                                <?= $form->field($model->getTickerAdvdert()->getLink(), 'title')->textInput(['maxlength' => true])->label('Подпись') ?>
                                <?= $form->field($model->getTickerAdvdert()->getLink(), 'href', [
                                    'addon' => ['prepend' => ['content' => '<i class="fas fa-globe"></i>']]
                                ])->textInput(['maxlength' => true])->label('Url') ?>
                                <?= $form->field($model->getTickerAdvdert()->getLink(), 'options')
                                    ->checkboxList($model->getTickerAdvdert()->getLink()->loadOptions(), ['inline' => true]); ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>
    <div class="row">
        <div class="col-sm-6">


        </div>
        <div class="col-sm-6"></div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
