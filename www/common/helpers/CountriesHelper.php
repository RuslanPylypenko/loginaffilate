<?php


namespace common\helpers;


use common\models\Countries;
use yii\helpers\ArrayHelper;

class CountriesHelper
{
    public static function loadCountries()
    {
        return ArrayHelper::map(
            Countries::find()->select(['id', 'name_ru'])->asArray()->all(),
            'id',
            'name_ru'
        );
    }
}