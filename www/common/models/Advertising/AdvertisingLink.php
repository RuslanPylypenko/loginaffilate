<?php


namespace common\models\Advertising;


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
}