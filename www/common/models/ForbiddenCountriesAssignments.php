<?php


namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $casino_id;
 * @property integer $country_id;
 */

class ForbiddenCountriesAssignments extends ActiveRecord
{
    public static function create($countryId): self
    {
        $assignment = new static();
        $assignment->country_id = $countryId;
        return $assignment;
    }

    public function isForCountry($id): bool
    {
        return $this->country_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%forbidden_countries_assignments}}';
    }

}