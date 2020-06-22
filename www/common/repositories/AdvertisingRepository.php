<?php


namespace common\repositories;


use common\models\Advertising\Advertising;
use common\models\Advertising\Banner;

class AdvertisingRepository
{
    public function saveAdvertising(Advertising $advertising): void
    {
        $advertising->save();
    }

    public function saveBanner(Banner $banner): void
    {
        $banner->save();
    }

}