<?php


namespace backend\forms\advertising;


use yii\base\Model;

class CreateFreeAdvertising extends Model
{
    public $dateEnd;


    public function rules()
    {
        return [
            [['dateEnd'], 'required'],
        ];
    }
}