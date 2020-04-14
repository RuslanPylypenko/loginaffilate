<?php


namespace backend\forms;

use yii\base\Model;

class ProviderForm extends Model
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
            'name' => 'Провайдер',
        ];
    }
}