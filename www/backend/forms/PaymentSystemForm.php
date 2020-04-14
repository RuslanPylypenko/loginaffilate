<?php


namespace backend\forms;

use yii\base\Model;

class PaymentSystemForm extends Model
{
    public $name;

    public function rules(): array
    {
        return [
            ['name', 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Платежная система',
        ];
    }
}