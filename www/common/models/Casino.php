<?php

namespace common\models;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

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
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property double rating
 * @property License[] $licenses
 * @property LicenseAssignments[] $licenseAssignments
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


    public static function create($title, $description, $website): self
    {
        $casino = new static();
        $casino->title = $title;
        $casino->website = $website;
        $casino->description = $description;
        $casino->status = self::STATUS_DRAFT;

        return $casino;
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
            ],
            [
                'class' => TimestampBehavior::className(),
                'value' => date("Y-m-d H:i:s", time()),
            ],
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['licenseAssignments'],
            ],
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


    public function setRating($rating)
    {
        if ($rating < 0 || $rating > 10) {
            throw new \DomainException('Недопустимое значение рейтинга');
        }
        $this->rating = $rating;
    }

    // Licenses

    public function assignLicense($id): void
    {
        $assignments = $this->licenseAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForLicense($id)) {
                return;
            }
        }
        $assignments[] = LicenseAssignments::create($id);
        $this->licenseAssignments = $assignments;
    }

    public function revokeLicense($id): void
    {
        $assignments = $this->licenseAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForLicense($id)) {
                unset($assignments[$i]);
                $this->licenseAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    public function revokeLicenses(): void
    {
        $this->licenseAssignments = [];
    }



    public function getLicenseAssignments(): ActiveQuery
    {
        return $this->hasMany(LicenseAssignments::class, ['casino_id' => 'id']);
    }

    public function getLicenses(): ActiveQuery
    {
        return $this->hasMany(License::class, ['id' => 'license_id'])->via('licenseAssignments');
    }
}
