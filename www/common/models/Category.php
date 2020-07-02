<?php


namespace common\models;


use yii\db\ActiveRecord;

/**
 * @property string slug
 * @property int id
 */
class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'categories';
    }

    public static function create(string $slug):self
    {
       $Category = new self();
       $Category->slug = $slug;
       return $Category;
    }
}