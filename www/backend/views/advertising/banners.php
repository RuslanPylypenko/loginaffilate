<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Упраление баннерами';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_tabs', ['active' => 'banners']) ?>
    <br>

    <p>
        <?= Html::a('Создать баннер  <span class="glyphicon glyphicon-usd"></span>', ['create-advertising', 'paidType' => 'paid', 'advertType' => 'banner'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Создать баннер (free)', ['create-advertising', 'paidType' => 'free', 'advertType' => 'banner'], ['class' => 'btn btn-info']) ?>
    </p>

</div>
