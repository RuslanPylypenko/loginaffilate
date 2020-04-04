<?php


namespace common\models;


use yii\db\ActiveRecord;

class Countries extends ActiveRecord
{
    public static function tableName()
    {
        return "sxgeo_country";
    }
}