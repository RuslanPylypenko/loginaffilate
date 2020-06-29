<?php


namespace frontend\controllers;


use yii\web\Controller;

class SlotsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}