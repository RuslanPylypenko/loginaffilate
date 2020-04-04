<?php


namespace common\models;


use common\helpers\StatusHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property int $status
 */
class License extends ActiveRecord
{

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'skeeks\yii2\slug\SlugBehavior',
                'slugAttribute' => 'slug',                    //The attribute to be generated
                'attribute' => 'name',                          //The attribute from which will be generated
                // optional params
                'maxLength' => 64,                              //Maximum length of attribute slug
                'minLength' => 3,                               //Min length of attribute slug
                'ensureUnique' => true,
                'slugifyOptions' => [
                    'lowercase' => true,
                    'separator' => '-',
                    'trim' => true
                ]
            ],
            [
                'class' => TimestampBehavior::className(),
                'value' => date("Y-m-d H:i:s", time()),
            ],
        ];
    }

    public static function create($name): self
    {
        $license = new static();
        $license->name = $name;
        $license->status = StatusHelper::STATUS_ACTIVE;
        return $license;
    }

    public function edit($name, $slug): void
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public static function tableName(): string
    {
        return '{{%licenses}}';
    }
}