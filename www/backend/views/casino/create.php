<?php

use backend\forms\CreateCasinoForm;
use common\helpers\CountriesHelper;
use common\helpers\Helper;
use kartik\editors\Summernote;
use kartik\file\FileInput;
use kartik\form\ActiveField;
use kartik\select2\Select2;
use kartik\form\ActiveForm;
use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use kartik\icons\FontAwesomeAsset;

FontAwesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $model CreateCasinoForm */

$this->title = 'Создание казино';
$this->params['breadcrumbs'][] = ['label' => 'Casinos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casino-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="casino-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Основное</div>
                    <div class="panel-body">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Валюты</div>
                    <div class="panel-body">
                        <?php echo $form->field($model->currencies, 'existing')->widget(Select2::classname(), [
                            'data' => $model->currencies->currenciesList(),
                            'language' => 'ru',
                            'options' => ['placeholder' => 'Выберите из списка ...', 'multiple' => true],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>


                        <?php echo $form->field($model->currencies, 'textNew', [
                            'hintType' => ActiveField::HINT_SPECIAL,
                            'hintSettings' => ['placement' => 'right', 'onLabelClick' => true, 'onLabelHover' => false]
                        ])->textArea([
                            'id' => 'address-input',
                            'placeholder' => 'Введите название новой валюты ...',
                            'rows' => 4
                        ])->hint('Введите название каждой новый валюты с новой строчки '); ?>

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Методы депозита/вывода валюты</div>
                    <div class="panel-body">
                        <div class="col-sm-6">
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
                        </div>

                        <div class="col-sm-6">
                            <?php echo $form->field($model, 'method_output_ids')->widget(Select2::classname(), [
                                'data' => ['1' => 'Метод 1', '2' => 'Метод 2', '3' => 'Метод 3'],
                                'language' => 'ru',
                                'options' => ['placeholder' => 'Select a method output ...', 'multiple' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Детали</div>
                    <div class="panel-body">


                        <?= $form->field($model, 'website', [
                            'addon' => ['prepend' => ['content' => '<i class="fas fa-globe"></i>']]
                        ])->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'website_options')
                            ->checkboxList($model->loadWebsiteOptions(), ['inline' => true]); ?>


                        <?php echo $form->field($model, 'has_license')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText'=>'Есть',
                                'offText'=>'Нет'
                            ]
                        ]); ?>


                        <?php echo $form->field($model, 'year_of_creation')->widget(Select2::classname(), [
                            'data' => Helper::getYearsArray(),
                            'language' => 'ru',
                            'options' => ['placeholder' => 'Выберите год...',],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>

                        <?php echo $form->field($model, 'min_deposit', [
                            'addon' => ['prepend' => ['content' => '$']]
                        ]); ?>

                        <?php echo $form->field($model, 'min_output', [
                            'addon' => ['prepend' => ['content' => '$']]
                        ]); ?>


                        <?= $form->field($model, 'restriction_limit')->textInput(['maxlength' => true]) ?>


                        <?php echo $form->field($model, 'provider_id')->widget(Select2::classname(), [
                            'data' => $model->providerList(),
                            'language' => 'ru',
                            'options' => ['placeholder' => 'Выберите Провайдера...',],
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

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Страны
                    </div>
                    <div class="panel-body">

                        <?php echo $form->field($model, 'country_switch')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onText'=>'Доступные',
                                'offText'=>'Запрещенные'
                            ]
                        ])->label(false); ?>
                        <?php echo $form->field($model, 'forbidden_countries')->widget(Select2::classname(), [
                            'data' => CountriesHelper::loadCountries(),
                            'language' => 'ru',
                            'options' => ['placeholder' => 'Выберите из списка ...', 'multiple' => true],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label(false); ?>
                    </div>
                </div>

            </div>

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Изображения</div>
                    <div class="panel-body">
                        <?php echo $form->field($model, 'logo_main')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'],
                        ]); ?>
                        <?php echo $form->field($model, 'logo_small')->widget(FileInput::classname(), [
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

        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">SEO</div>
                <div class="panel-body">
                    <?php echo $form->field($model, 'description')->widget(Summernote::class, [
                        'options' => ['placeholder' => '', 'rows' => 2]
                    ]); ?>
                </div>
            </div>

        </div>


        <div class="form-group text-right">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
