<?php


namespace common\repositories;


use common\models\Countries;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class CountryRepository
{

    public function getAllIdsWhereNotIn($forbiddenCountries)
    {
        return ArrayHelper::getColumn(
            Countries::find()->select('id')->where(['not in', 'id', $forbiddenCountries])->asArray()->all(),
            'id'
        );
    }


    public function get($countryId)
    {
        if (!$license = Countries::findOne($countryId)) {
            throw new NotFoundHttpException('Country is not found.');
        }
        return $license;
    }
}