<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TopCasino */

$this->title = 'Create Top Casino';
$this->params['breadcrumbs'][] = ['label' => 'Top Casinos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-casino-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
