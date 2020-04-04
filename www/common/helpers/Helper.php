<?php


namespace common\helpers;


use yii\helpers\ArrayHelper;

class Helper
{
    public static function getYearsArray($start = 1970, $end = null)
    {
        $end = $end ? $end : date("Y", time());
        return array_combine(range($start,$end),range($start,$end));
    }
}