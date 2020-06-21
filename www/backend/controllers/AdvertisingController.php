<?php


namespace backend\controllers;


use backend\forms\advertising\CreateAdvertising;
use backend\forms\advertising\CreateBannerAdvertising;
use backend\forms\advertising\CreateFreeAdvertising;
use backend\forms\advertising\CreatePaidAdvertising;
use backend\forms\advertising\CreateTickerAdvertising;
use backend\services\advertising\AdvertCreateService;
use InvalidArgumentException;
use yii\web\Controller;

class AdvertisingController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBanners()
    {
        return $this->render('banners');
    }

    public function actionTicker()
    {
        return $this->render('ticker');
    }

    public function actionCreateAdvertising($paidType, $advertType)
    {
        if (!in_array($paidType, ['paid', 'free'])){
            throw new InvalidArgumentException('Paid type is not correct');
        }

        if (!in_array($advertType, ['banner', 'ticker'])){
            throw new InvalidArgumentException('Advert type is not correct');
        }

        $model = new CreateAdvertising();
        if ($paidType === 'paid') {
            $model->assignPaidForm(new CreatePaidAdvertising());
        }elseif ($paidType === 'free'){
            $model->assignFreeForm(new CreateFreeAdvertising());
        }

        if ($advertType == 'banner'){
            $model->assignBannerForm(new CreateBannerAdvertising());
        }elseif ($advertType == 'ticker'){
            $model->assignTickerForm(new CreateTickerAdvertising());
        }

        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            /** @var AdvertCreateService $service */
            $service = \Yii::$container->get(AdvertCreateService::class, ['advertType' => $advertType]);
            $service->create($model);
        }

        return $this->render('forms/createAdvertising', [
            'model' => $model,
        ]);
    }
}