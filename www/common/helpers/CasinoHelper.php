<?php

namespace common\helpers;

use common\models\Casino;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class CasinoHelper
{

    public static function statusList()
    {
        return [
            Casino::STATUS_DRAFT => 'Черновик',
            Casino::STATUS_ACTIVE => 'Активный',
        ];
    }

    /**
     * @param $status
     * @return mixed
     */
    public static function statusName($status)
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status)
    {
        switch ($status) {
            case Casino::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Casino::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }


    public static function tagLabels(Casino $casino)
    {
        $status = self::statusLabel($casino->status);

        $top = "";
        if ($casino->is_top) {
            $top = Html::tag('span', 'топ', [
                'class' => 'label label-success',
            ]);
        }

        $advert = "";
        if ($casino->is_advert) {
            $advert = Html::tag('span', 'реклама', [
                'class' => 'label label-success',
            ]);
        }


        return trim($status . " " . $top . " " . $advert);
    }

}