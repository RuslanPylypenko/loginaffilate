<?php

use kartik\editors\Summernote;
use kartik\form\ActiveForm;
use yii\helpers\Html;

/** @var $model \backend\forms\SeoPageForm */
/** @var $backUrl string */

$this->title = 'SEO';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(); ?>
            <?= $form->field($model, 'metaTitle')->textInput(); ?>
            <?= $form->field($model, 'metaDescription')->widget(Summernote::class, [
                'options' => ['placeholder' => '', 'rows' => 2]
            ]); ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'url')->textInput(); ?>
            <?= $form->field($model, 'footerTitle')->textInput(); ?>
            <?= $form->field($model, 'footerText')->widget(Summernote::class, [
                'options' => ['placeholder' => '', 'rows' => 2]
            ]); ?>
        </div>
    </div>

    <?= Html::a('Назад', $backUrl, ['class' => 'btn btn-info']) ?>
    <?= Html::submitButton('Cохранить', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end() ?>
</div>
