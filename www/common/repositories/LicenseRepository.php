<?php


namespace common\repositories;


use common\models\License;
use yii\web\NotFoundHttpException;

class LicenseRepository
{

    public function get($licenseId)
    {
        if (!$license = License::findOne($licenseId)) {
            throw new NotFoundHttpException('License is not found.');
        }
        return $license;
    }

    public function findByName($name): ?License
    {
        return License::findOne(['name' => $name]);
    }

    public function save(License $license): void
    {
        if (!$license->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(License $license): void
    {
        if (!$license->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}