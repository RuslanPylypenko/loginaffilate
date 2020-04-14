<?php


namespace common\repositories;


use common\models\Countries;
use common\models\PaymentSystem;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class PaymentRepository
{


    public function get($paymentId)
    {
        if (!$payment = PaymentSystem::findOne($paymentId)) {
            throw new NotFoundHttpException('Payment system is not found.');
        }
        return $payment;
    }
}