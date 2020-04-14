<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\searchModels\CountrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="countries-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'iso') ?>

    <?= $form->field($model, 'continent') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'name_en') ?>

    <?php // echo $form->field($model, 'name_ru') ?>

    <?php // echo $form->field($model, 'name_uk') ?>

    <?php // echo $form->field($model, 'name_az') ?>

    <?php // echo $form->field($model, 'name_ka') ?>

    <?php // echo $form->field($model, 'name_cs') ?>

    <?php // echo $form->field($model, 'name_hy') ?>

    <?php // echo $form->field($model, 'name_pl') ?>

    <?php // echo $form->field($model, 'name_nl') ?>

    <?php // echo $form->field($model, 'name_fr') ?>

    <?php // echo $form->field($model, 'name_tr') ?>

    <?php // echo $form->field($model, 'name_de') ?>

    <?php // echo $form->field($model, 'name_et') ?>

    <?php // echo $form->field($model, 'name_sk') ?>

    <?php // echo $form->field($model, 'name_zh') ?>

    <?php // echo $form->field($model, 'name_it') ?>

    <?php // echo $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'lon') ?>

    <?php // echo $form->field($model, 'timezone') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
