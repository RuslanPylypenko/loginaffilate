<?php


namespace backend\forms;


use yii\base\Model;

class UpdateUrlForm extends Model
{
    public $url;
    public $casinoId;

    public function rules()
    {
        return [
            [['casinoId', 'url'], 'required'],
            ['url', 'string', 'min' => 3],
        ];
    }
}