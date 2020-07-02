<?php


namespace backend\forms;


use common\models\Category;
use yii\base\Model;

class SeoPageForm extends Model
{
    public $url;
    public $entityId;
    public $entityType;

    public $title;
    public $metaTitle;
    public $metaDescription;
    public $footerTitle;
    public $footerText;

    public function loadPage(Category $category)
    {
        $this->url = $category->seo->url;
        $this->entityId = $category->id;
        $this->entityType = $category->slug;
        $this->title = $category->seo->meta->title;
        $this->metaTitle = $category->seo->meta->meta_title;
        $this->metaDescription = $category->seo->meta->meta_description;
        $this->footerTitle = $category->seo->meta->footer_title;
        $this->footerText = $category->seo->meta->footer_text;
    }

}