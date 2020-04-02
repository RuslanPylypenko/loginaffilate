<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $createCasinoForm common\models\Casino */

$this->title = 'Создание казино';
$this->params['breadcrumbs'][] = ['label' => 'Casinos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casino-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $createCasinoForm,
    ]) ?>

</div>
