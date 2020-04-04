<?php


namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $casino_id;
 * @property integer $license_id;
 */

class LicenseAssignments extends ActiveRecord
{
    public static function create($licenseId): self
    {
        $assignment = new static();
        $assignment->license_id = $licenseId;
        return $assignment;
    }

    public function isForLicense($id): bool
    {
        return $this->license_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%license_assignments}}';
    }

}