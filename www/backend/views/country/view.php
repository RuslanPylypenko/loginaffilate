<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Countries */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="countries-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'iso',
            'continent',
            'name',
            'name_en',
            'name_ru',
            'name_uk',
            'name_az',
            'name_ka',
            'name_cs',
            'name_hy',
            'name_pl',
            'name_nl',
            'name_fr',
            'name_tr',
            'name_de',
            'name_et',
            'name_sk',
            'name_zh',
            'name_it',
            'lat',
            'lon',
            'timezone',
        ],
    ]) ?>

</div>
