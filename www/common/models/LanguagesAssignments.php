<?php


namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $casino_id;
 * @property integer $language_id;
 */

class LanguagesAssignments extends ActiveRecord
{
    public static function create($languageId): self
    {
        $assignment = new static();
        $assignment->language_id = $languageId;
        return $assignment;
    }

    public function isForLanguage($id): bool
    {
        return $this->language_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%language_assignments}}';
    }

}