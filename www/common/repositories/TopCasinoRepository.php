<?php

namespace common\repositories;

use common\models\Casino;
use common\models\TopCasino;
use Yii;
use yii\web\NotFoundHttpException;

class TopCasinoRepository
{

    public function get($id): TopCasino
    {
        if (!$topCasino = TopCasino::find()->where(['casino_id' => $id])->one()) {
            throw new NotFoundHttpException('Casino is not found.');
        }
        return $topCasino;
    }

    public function save(TopCasino $topCasino)
    {
        if (!$topCasino->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(TopCasino $topCasino)
    {
        if (!$topCasino->delete()) {
            throw new \RuntimeException('Remove error.');
        }
    }

    public function getByOrd(int $ord): TopCasino
    {
        if (!$topCasino = TopCasino::find()->where(['ord' => $ord])->one()) {
            throw new NotFoundHttpException('Casino is not found.');
        }
        return $topCasino;
    }


}