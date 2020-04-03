<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "casinos".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $country_id
 * @property string|null $logo
 * @property string|null $background
 * @property string|null $website
 * @property string|null $description
 * @property string|null $url
 * @property int|null $status
 */
class Casino extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 1;
    const STATUS_ACTIVE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'casinos';
    }

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'skeeks\yii2\slug\SlugBehavior',
                'slugAttribute' => 'url',                    //The attribute to be generated
                'attribute' => 'title',                          //The attribute from which will be generated
                // optional params
                'maxLength' => 64,                              //Maximum length of attribute slug
                'minLength' => 3,                               //Min length of attribute slug
                'ensureUnique' => true,
                'slugifyOptions' => [
                    'lowercase' => true,
                    'separator' => '-',
                    'trim' => true
                    //'regexp' => '/([^A-Za-z0-9]|-)+/',
                    //'rulesets' => ['russian'],
                    //@see all options https://github.com/cocur/slugify
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'country_id' => 'Country ID',
            'logo' => 'Лого',
            'background' => 'Подложка',
            'website' => 'Сайт казино',
            'description' => 'Описание',
            'status' => 'Черновик',
            'url' => 'Ссылка',
            'rating' => 'Рейтинг',
        ];
    }

    public function isActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }


    public function isDraft()
    {
        return $this->status == self::STATUS_DRAFT;
    }

    public function activate()
    {
        if ($this->isActive()) {
            throw new \DomainException('Casino is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function draft()
    {
        if ($this->isDraft()) {
            throw new \DomainException('Casino is already draft.');
        }
        $this->status = self::STATUS_DRAFT;
    }


    public function setUrl($url)
    {
        $this->url = $url;
    }


}
