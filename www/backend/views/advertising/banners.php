<?php

use backend\helpers\AdvertisingHelper;
use backend\helpers\BannerHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;

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

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th>Фото</th>
            <th>Info</th>
            <th>Местоположение</th>
            <th>Прогресс</th>
            <th></th>

        </tr>
        </thead>
        <tbody>
        <?php /** @var \common\models\Advertising\Banner[] $banners */
        foreach ($banners as $banner): ?>
            <tr>
                <td>
                    <h4><?= $banner->advertising->getName() ?></h4></td>
                <td>
                    <?= Html::img($banner->photo, ['class' => 'img-thumbnail', 'style' => 'width: 90px']) ?>
                </td>
                <td>
                    <?= AdvertisingHelper::getStatusBadge($banner->advertising) ?>
                    <?= AdvertisingHelper::getPaymentTypeBadge($banner->advertising) ?>
                </td>

                <td>
                    <?= StringHelper::truncate(BannerHelper::getBlock($banner->block_id), 20) ?>
                </td>
                <td>
                    <?= AdvertisingHelper::getProgress($banner->advertising) ?>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="<?= Url::to(['/advertising/banner', 'id' => $banner->id]) ?>"
                           class="btn btn-sm btn-info">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
