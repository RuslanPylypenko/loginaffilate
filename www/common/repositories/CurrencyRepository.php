<?php


namespace common\repositories;


use common\models\Currency;
use yii\web\NotFoundHttpException;

class CurrencyRepository
{

    public function get($currencyId)
    {
        if (!$currency = Currency::findOne($currencyId)) {
            throw new NotFoundHttpException('Currency is not found.');
        }
        return $currency;
    }

    public function findByName($name): ?Currency
    {
        return Currency::findOne(['name' => $name]);
    }

    public function save(Currency $currency): void
    {
        if (!$currency->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Currency $currency): void
    {
        if (!$currency->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}