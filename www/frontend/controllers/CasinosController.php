<?php


namespace frontend\controllers;


use yii\web\Controller;

class CasinosController extends Controller
{

    public function actionIndex()
    {
        $this->layout = 'catalog';

        return $this->render('index');
    }
}