<?php


namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $casino_id;
 * @property integer $payment_id;
 */

class OutputSystemsAssignments extends ActiveRecord
{
    public static function create($paymentId): self
    {
        $assignment = new static();
        $assignment->payment_id = $paymentId;
        return $assignment;
    }

    public function isForPayment($id): bool
    {
        return $this->payment_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%casino_output_systems}}';
    }

}