<?php

namespace backend\bootstrap;


use backend\services\advertising\AdvertCreateService;
use backend\services\advertising\CreateBannerService;
use common\repositories\AdvertisingRepository;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = \Yii::$container;


        $container->set(AdvertCreateService::class, function ($container, $params, $config) {
            if(!isset($params['advertType'])){
                throw new \InvalidArgumentException('unknown advert type');
            }
            switch ($params['advertType']){
                case 'banner': return new CreateBannerService(new AdvertisingRepository());
            }
            return false;
        });

    }
}