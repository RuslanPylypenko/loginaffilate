<?php


namespace backend\forms;


use yii\base\Model;

class SetRatingForm extends Model
{
    public $rating;
    public $casinoId;

    public function rules()
    {
        return [
            [['casinoId', 'rating'], 'required'],
            ['rating', 'double', 'min' => 0, 'max' => 10],
        ];
    }
}