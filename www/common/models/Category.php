<?php


namespace common\models;


use common\models\Pages\Page;
use yii\db\ActiveRecord;

/**
 * @property string slug
 * @property int id
 * @property Page seo
 */
class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'categories';
    }

    public static function create(string $slug): self
    {
        $Category = new self();
        $Category->slug = $slug;
        return $Category;
    }


    public function getSeo()
    {
        return $this->hasOne(Page::class, ['entity_id' => 'id'])->where(['entity_type' => $this->slug]);
    }
}