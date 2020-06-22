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
            [['options'], 'safe'],
            [['title', 'href'], 'required'],
        ];
    }

    public function loadOptions(): array
    {
        return ['target' => '_blank', 'rel' => 'nofollow'];
    }


    public function toJson(): string
    {
        return json_encode(['title' => $this->title, 'href' => $this->href, 'options' => ['target' => '_blank']]);
    }

}