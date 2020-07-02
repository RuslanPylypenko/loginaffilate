<?php


namespace common\models\Pages;

use yii\db\ActiveRecord;

/**
 * @property int page_id
 * @property string title
 * @property string meta_title
 * @property string meta_description
 * @property string footer_title
 * @property string footer_text
 */
class PageMeta extends ActiveRecord
{
    public static function tableName()
    {
        return 'page_meta';
    }

    public static function create(
        int $pageId,
        string $title,
        string $description,
        string $footerTitle,
        string $footerText
    ): self
    {
        $PageMeta = new self();
        $PageMeta->page_id = $pageId;
        $PageMeta->title = $pageId;
        $PageMeta->meta_title = $title;
        $PageMeta->meta_description = $description;
        $PageMeta->footer_title = $footerTitle;
        $PageMeta->footer_text = $footerText;

        return $PageMeta;
    }
}