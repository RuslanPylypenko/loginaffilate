<?php


namespace common\models\Advertising;


use yii\helpers\Html;

class AdvertisingLink
{
    public $title;

    public $href;

    public $options;

    public function __construct(string $title, string $href, array $options)
    {
        $this->title = $title;
        $this->href = $href;
        $this->options = $options;
    }

    public function __toString()
    {
       return Html::a($this->title, $this->href, $this->options);
    }
}