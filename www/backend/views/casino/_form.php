<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use kartik\icons\FontAwesomeAsset;
use kartik\select2\Select2;

use kartik\editors\Summernote;

FontAwesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Casino */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="casino-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Описание</div>
                <div class="panel-body">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?php echo $form->field($model, 'description')->widget(Summernote::class, [
                        'options' => ['placeholder' => 'Edit content here...', 'rows' => 2]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Детали</div>
                <div class="panel-body">
                    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

                    <?php echo $form->field($model, 'country_ids')->widget(Select2::classname(), [
                        'data' => ['0' => 'Украина', 1 => 'Польша', 3 => 'USA'],
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Select a countries ...',  'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                    <?php echo $form->field($model, 'year_of_creation')->widget(Select2::classname(), [
                        'data' => ['2016' => 2016, '2017' => 2017, '2018' => 2018, '2019' => 2019, '2020' => 2020],
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Выберите год...',],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                    <?= $form->field($model, 'year_of_creation')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'min_deposit')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'min_output')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'restriction_limit')->textInput(['maxlength' => true]) ?>

                    <?php echo $form->field($model, 'license_id')->widget(Select2::classname(), [
                        'data' =>  ['1' => 'Лицензия 1', '2' => 'Лицензия 2', '3' => 'Лицензия 3'],
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Выберите лицензию...',],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>


                    <?php echo $form->field($model, 'provider_id')->widget(Select2::classname(), [
                        'data' =>   ['1' => 'Провайдер 1', '2' => 'Провайдер 2', '3' => 'Провайдер 3'],
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Выберите Провайдера...',],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>


                    <?php echo $form->field($model, 'currency_ids')->widget(Select2::classname(), [
                        'data' => ['1' => 'Валюта 1', '2' => 'Валюта 2', '3' => 'Валюта 3'],
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Select a currency ...',  'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                    <?php echo $form->field($model, 'method_output_ids')->widget(Select2::classname(), [
                        'data' => ['1' => 'Метод 1', '2' => 'Метод 2', '3' => 'Метод 3'],
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Select a method output ...', 'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                    <?php echo $form->field($model, 'method_deposit_ids')->widget(Select2::classname(), [
                        'data' => ['1' => 'Метод 1', '2' => 'Метод 2', '3' => 'Метод 3'],
                        'language' => 'ru',
                        'options' => [
                            'placeholder' => 'Select a deposite method ...',
                            'multiple' => true
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                    <?php echo $form->field($model, 'language_ids')->widget(Select2::classname(), [
                        'data' => ['1' => 'Язык 1', '2' => 'Язык 2', '3' => 'Язык 3'],
                        'language' => 'ru',
                        'options' => [
                            'placeholder' => 'Select a language ...',
                            'multiple' => true
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Изображения</div>
                <div class="panel-body">
                    <?php echo $form->field($model, 'logo')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/*'],
                    ]); ?>

                    <?php echo $form->field($model, 'background')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/*'],
                    ]); ?>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Плюсы минусы</div>
            <div class="panel-body">
                <div class="col-sm-6">
                    <?= $form->field($model, 'positive_options')->textarea(['rows' => 7]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'negative_options')->textarea(['rows' => 7]) ?>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
