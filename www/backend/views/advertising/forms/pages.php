<?php

use backend\helpers\BannerHelper;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;

/** @var $model \backend\forms\SeoPageForm */
/** @var $backUrl string */

$this->title = 'Рекламные блоки';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Какие баннеры отображать на странице
        </div>
        <div class="panel-body">
            <?php echo $form->field($model, 'advertisingId')->widget(Select2::classname(), [
                'data' => BannerHelper::loadBlockList(),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выберите баннер', 'multiple' => true],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false); ?>
        </div>
    </div>



    <?= Html::a('Назад', $backUrl, ['class' => 'btn btn-info']) ?>
    <?= Html::submitButton('Cохранить', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end() ?>
</div>
