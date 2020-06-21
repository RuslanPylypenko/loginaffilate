<?php


namespace backend\forms\advertising;


use yii\base\Model;

class AdvertLinkForm extends Model
{
    public $title;
    public $href;
    public $options;

    public function rules()
    {
        return [
            [['title', 'href'], 'required'],
        ];
    }

    public function loadOptions(): array
    {
        return ['target' => '_blank', 'rel' => 'nofollow'];
    }
}