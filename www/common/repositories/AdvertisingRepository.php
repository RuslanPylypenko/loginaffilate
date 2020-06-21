<?php


namespace common\repositories;


use common\models\Advertising\Advertising;

class AdvertisingRepository
{
    public function save(Advertising $advertising): void
    {
        $advertising->save();
    }

}