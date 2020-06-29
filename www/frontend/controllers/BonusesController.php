<?php


namespace frontend\controllers;


use yii\web\Controller;

class BonusesController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}