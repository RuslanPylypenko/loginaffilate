<?php


namespace common\repositories;


use common\models\Currency;
use common\models\Language;
use yii\web\NotFoundHttpException;

class LanguageRepository
{

    public function get($languageId)
    {
        if (!$language = Language::findOne($languageId)) {
            throw new NotFoundHttpException('Language is not found.');
        }
        return $language;
    }

    public function findByName($name): ?Language
    {
        return Language::findOne(['name' => $name]);
    }

    public function save(Language $language): void
    {
        if (!$language->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Language $language): void
    {
        if (!$language->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}