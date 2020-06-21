<?php


namespace common\services;


use common\models\Casino;
use common\models\Pages\Page;

class PageService
{
    public function createForCasino(Casino $casino): Page
    {
        return Page::createForCasino($casino);
    }
}