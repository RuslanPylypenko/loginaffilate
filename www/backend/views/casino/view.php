<?php

use common\helpers\CasinoHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Casino */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Casinos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="casino-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?php if ($model->isActive()): ?>
            <?= Html::a('В черновик', ['draft', 'id' => $model->id], ['class' => 'btn btn-warning', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Активировать ', ['activate', 'id' => $model->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>

        <?= Html::a('Изменить рейтинг', ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить в топ', ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Редактировать урл', ['update-url', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Бонусы казино', ['update-url', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Отзывы казино', ['update-url', 'id' => $model->id], ['class' => 'btn btn-default']) ?>

        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'title',
            'url',
            'rating',
            'logo',
            'background',
            'website',
            'description:ntext',
            [
                'attribute' => 'status',
                'value' => CasinoHelper::statusLabel($model->status),
                'format' => 'raw',
            ],
        ],
    ]) ?>
    <?php if ($model->isActive()): ?>
        <?= Html::a('Посмотреть на сайте', ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    <?php endif; ?>
</div>
