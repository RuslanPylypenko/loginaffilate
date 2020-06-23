<?php

use backend\helpers\AdvertisingHelper;
use backend\helpers\BannerHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $banner \common\models\Advertising\Banner */
/* @var $this yii\web\View */
/* @var $model common\models\Countries */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Реклама', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Баннера', 'url' => ['banners']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container">
    <h2><?= $banner->advertising->getName() ?></h2>

    <div class="panel panel-default">
        <div class="panel-heading">Общая информация   <a href="#" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></a></div>
        <div class="panel-body">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td><h4>Название</h4></td>
                    <td><?= $banner->advertising->name ?></td>
                </tr>
                <tr>
                    <td><h4>Ссылка</h4></td>
                    <td><?= $banner->getLink() ?></td>
                </tr>
                <tr>
                    <td><h4>Фото</h4></td>
                    <td><?= Html::img($banner->photo, ['class' => 'img-thumbnail', 'style' => 'width: 200px']) ?></td>
                </tr>
                <tr>
                    <td><h4>Info</h4></td>
                    <td>
                        <?= AdvertisingHelper::getStatusBadge($banner->advertising) ?>
                        <?= AdvertisingHelper::getPaymentTypeBadge($banner->advertising) ?>
                    </td>
                </tr>
                <tr>
                    <td><h4>Местоположение</h4></td>
                    <td>
                        <?= BannerHelper::getBlock($banner->block_id) ?>

                    </td>
                </tr>
                <tr>
                    <td><h4>Дата начала рк</h4></td>
                    <td>
                        <?= Yii::$app->formatter->asDatetime($banner->advertising->date_start, 'long') ?>
                    </td>
                </tr>
                <tr>
                    <td><h4>Прогресс</h4></td>
                    <td>
                        <?= AdvertisingHelper::getProgress($banner->advertising) ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php if ($banner->advertising->isFree()): ?>
        <div class="panel panel-default">
            <div class="panel-heading">Дата окончания</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td><h4>Дата окончания</h4></td>
                        <td><?= Yii::$app->formatter->asDatetime($banner->advertising->date_end, 'long') ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">Финансы</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td><h4>Бюджет</h4></td>
                            <td><?= $banner->advertising->budget ?></td>
                            <td><a href="#" class="btn btn-info">Пополнить счет</a></td>
                        </tr>
                        <tr>
                            <td><h4>Цена за рекламное событие</h4></td>
                            <td><?= $banner->advertising->price ?></td>
                            <td><a href="#" class="btn btn-info">Изменить цену</a></td>
                        </tr>
                        <tr>
                            <td><h4>Бонус</h4></td>
                            <td>
                                <?= $banner->advertising->bonus ?>
                            </td>
                            <td><a href="#" class="btn btn-info">Изменить бонус</a></td>
                        </tr>
                        <tr>
                            <td><h4>Действий осталось</h4></td>
                            <td>
                                77
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">Выписка по списаниям</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Операция</th>
                            <th>Сумма</th>
                            <th>Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Списание (клик)</td>
                            <td>5</td>
                            <td>5 июля 17:31</td>
                        </tr>
                        <tr>
                            <td>Списание (клик)</td>
                            <td>5</td>
                            <td>5 июля 17:31</td>
                        </tr>
                        <tr>
                            <td>Списание (клик)</td>
                            <td>5</td>
                            <td>5 июля 17:31</td>
                        </tr>
                        <tr>
                            <td>Списание (клик)</td>
                            <td>5</td>
                            <td>5 июля 17:31</td>
                        </tr>
                        <tr>
                            <td>Пополнение</td>
                            <td>200</td>
                            <td>5 мая 15:05</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-heading">Отчет</div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">День</a></li>
                <li><a data-toggle="tab" href="#menu1">Месяц</a></li>
                <li><a data-toggle="tab" href="#menu2">Все время</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Просмотров</th>
                            <th>Переходов</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>100</td>
                            <td>20</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Просмотров</th>
                            <th>Переходов</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1923</td>
                            <td>124</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Просмотров</th>
                            <th>Переходов</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>54647</td>
                            <td>643</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php if ($banner->advertising->isRunOutOfTime()): ?>
        <a href="#" class="btn btn-info">Продлить</a>
    <?php else: ?>
        <a href="#" class="btn btn-danger">Закрыть рк</a>
        <a href="#" class="btn btn-warning">Приостановить</a>
    <?php endif; ?>


</div>
