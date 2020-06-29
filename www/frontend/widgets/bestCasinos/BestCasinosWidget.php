<?php

namespace frontend\widgets\bestCasinos;

use yii\base\Widget;

class BestCasinosWidget extends Widget
{
    public function run()
    {
        return $this->render('index');
    }
}