<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бегущая строка';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_tabs', ['active' => 'ticker']) ?>
    <br>

    <p>
        <?= Html::a('Создать бегущую строку  <span class="glyphicon glyphicon-usd"></span>', ['create-advertising', 'paidType' => 'paid', 'advertType' => 'ticker'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Создать бегущую строку (free)', ['create-advertising', 'paidType' => 'free', 'advertType' => 'ticker'], ['class' => 'btn btn-info']) ?>
    </p>

</div>
