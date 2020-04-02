<?php

namespace app\models;

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
 */
class Casino extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'casinos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id'], 'default', 'value' => null],
            [['country_id'], 'integer'],
            [['description'], 'string'],
            [['title', 'logo', 'background', 'website'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'country_id' => 'Country ID',
            'logo' => 'Logo',
            'background' => 'Background',
            'website' => 'Website',
            'description' => 'Description',
        ];
    }
}
