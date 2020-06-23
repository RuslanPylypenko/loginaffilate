<?php


namespace backend\helpers;


use common\models\Advertising\Advertising;
use yii\helpers\Html;

class AdvertisingHelper
{
    public static function getStatusBadge(Advertising $advertising): ?string
    {
        if ($advertising->isActive()) {
             return Html::tag('span', 'Отображается', ['class' => 'label label-success']);
        }

        if ($advertising->isDisabled()) {
            return Html::tag('span', 'Отключено', ['class' => 'label label-default']);
        }

        if ($advertising->isRunOutOfTime()) {
            return Html::tag('span', 'Закончилось время', ['class' => 'label label-warning']);
        }

        return Html::tag('span', 'Не отображается', ['class' => 'label label-default']);
    }

    public static function getProgress(Advertising $advertising): ?string
    {
        $progress = $advertising->getProgress();
        if($advertising->isRunOutOfTime()){
            $progress = 0;
        }
        return '<div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="'.$progress.'"
                    aria-valuemin="0" aria-valuemax="100" style="width:'.$progress.'%">
                    '.$progress.'%
                    </div>
            </div>';
    }

    public static function getPaymentTypeBadge(Advertising $advertising): ?string
    {
        if($advertising->isFree()){
            return Html::tag('span', 'free', ['class' => 'label label-info']);
        }

        if($advertising->isClickPaid()){
            return Html::tag('span', 'клик', ['class' => 'label label-info']);
        }

        if($advertising->isPeriodPaid()){
            return Html::tag('span', 'за время', ['class' => 'label label-info']);
        }

        if($advertising->isViewPaid()){
            return Html::tag('span', 'просмотр', ['class' => 'label label-info']);
        }

        return null;
    }
}