<?php

namespace frontend\widgets\advertising;

use yii\base\Widget;
use yii\helpers\Html;

class BannerWidget extends Widget
{
    public $url;
    public $blockName;


    public function run()
    {
        echo Html::tag('div', "Баннер {$this->blockName}", ['class' => 'well', 'style' => 'height: 200px']);
    }
}