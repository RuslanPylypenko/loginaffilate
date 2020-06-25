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

        if ($advertising->isWait()) {
            return Html::tag('span', 'Приостановлено', ['class' => 'label label-warning']);
        }

        if ($advertising->isOutOfFunds()) {
            return Html::tag('span', 'Закончились средства', ['class' => 'label label-danger']);
        }

        if ($advertising->isFutureStart()) {
            return Html::tag(
                'span',
                "Запуск планируется на " . \Yii::$app->formatter->asDatetime($advertising->date_start, 'short'),
                ['class' => 'label label-info']);
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
        if ($advertising->isRunOutOfTime() || $advertising->isOutOfFunds()) {
            $progress = 0;
        }
        $class = 'progress-bar-info';
        if ($progress < 20) {
            $class = 'progress-bar-danger';
        }
        $activeClass = $advertising->isActive() ? 'active' : '';
        return '<div class="progress">
                    <div class="progress-bar progress-bar-striped ' . $activeClass . ' ' . $class . '" role="progressbar" aria-valuenow="' . $progress . '"
                    aria-valuemin="0" aria-valuemax="100" style="width:' . $progress . '%">
                    ' . $progress . '%
                    </div>
            </div>';
    }

    public static function getPaymentTypeBadge(Advertising $advertising): ?string
    {
        if ($advertising->isFree()) {
            return Html::tag('span', 'Бесплатная', ['class' => 'label label-info']);
        }

        if ($advertising->isClickPaid()) {
            return Html::tag('span', 'За клики', ['class' => 'label label-info']);
        }

        if ($advertising->isPeriodPaid()) {
            return Html::tag('span', 'За время', ['class' => 'label label-info']);
        }

        if ($advertising->isViewPaid()) {
            return Html::tag('span', 'За просмотр', ['class' => 'label label-info']);
        }

        return null;
    }
}