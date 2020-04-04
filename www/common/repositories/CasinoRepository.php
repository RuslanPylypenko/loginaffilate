<?php
namespace common\repositories;

use common\models\Casino;
use yii\web\NotFoundHttpException;

class CasinoRepository
{
    /**
     * @param $id
     * @return Casino|null
     * @throws NotFoundHttpException
     */
    public function get($id): Casino
    {
        if (!$casino = Casino::findOne($id)) {
            throw new NotFoundHttpException('Casino is not found.');
        }
        return $casino;
    }

    public function save(Casino $casino)
    {
        if (!$casino->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}