<?php


namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $casino_id;
 * @property integer $currency_id;
 */

class CurrenciesAssignments extends ActiveRecord
{
    public static function create($currencyId): self
    {
        $assignment = new static();
        $assignment->currency_id = $currencyId;
        return $assignment;
    }

    public function isForCurrency($id): bool
    {
        return $this->currency_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%currencies_assignments}}';
    }

}