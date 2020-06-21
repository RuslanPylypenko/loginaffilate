<?php


namespace backend\forms\advertising;


use yii\base\Model;

class CreatePaidAdvertising extends Model
{
    public $paidType;
    public $price;
    public $bonus;
    public $budget;


    public function rules()
    {
        return [
            [['paidType', 'price', 'budget'], 'required'],
            ['bonus', 'number', 'min' => 0]
        ];
    }

    public function loadPaidTypes():array
    {
        return [
            1 => 'За просмотры',
            2 => 'За Клики',
            3 => 'Посуточно',
        ];
    }
}