<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Countries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="countries-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'iso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'continent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_az')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_cs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_hy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_pl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_nl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_fr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_tr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_de')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_et')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_sk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_zh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_it')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lat')->textInput() ?>

    <?= $form->field($model, 'lon')->textInput() ?>

    <?= $form->field($model, 'timezone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
