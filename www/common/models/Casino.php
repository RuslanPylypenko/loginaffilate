<?php

namespace common\models;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "casinos".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $country_id
 * @property string|null $logo_main
 * @property string|null $logo_small
 * @property string|null $background
 * @property string|null $website
 * @property string|null $website_options
 * @property string|null $description
 * @property string|null $provider_id
 * @property string|null $url
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property double rating
 * @property License[] $licenses
 * @property LicenseAssignments[] $licenseAssignments
 * @property CurrenciesAssignments[] $currenciesAssignments
 * @property int is_top
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


    public static function create(
        $title,
        $description,
        $provider_id,
        $website,
        $website_options,
        $background,
        $logo_main,
        $logo_small
    ): self
    {
        $casino = new static();
        $casino->title = $title;
        $casino->website = $website;
        $casino->website_options = json_encode(['target' => '_blank']);
        $casino->description = $description;
        $casino->provider_id = $provider_id;
        $casino->background = $background;
        $casino->logo_main = $logo_main;
        $casino->logo_small = $logo_small;
        $casino->background = $background;
        $casino->status = self::STATUS_DRAFT;

        return $casino;
    }

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'skeeks\yii2\slug\SlugBehavior',
                'slugAttribute' => 'url',
                'attribute' => 'title',
                // optional params
                'maxLength' => 64,
                'minLength' => 3,
                'ensureUnique' => true,
                'slugifyOptions' => [
                    'lowercase' => true,
                    'separator' => '-',
                    'trim' => true
                ]
            ],
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'background',
                'createThumbsOnRequest' => true,
                'filePath' => '@frontend/web/uploads/casinos/[[attribute_id]]/[[background]].[[extension]]',
                'fileUrl' => '@frontend/web/uploads/casinos/[[attribute_id]]/[[background]].[[extension]]',
                'thumbPath' => '@frontend/web/cache/casinos/[[attribute_id]]/[[profile]]_[[background]].[[extension]]',
                'thumbUrl' => '/cache/casinos/[[attribute_id]]/[[profile]]_[[background]].[[extension]]',
                'thumbs' => [
                    'page' => ['width' => 800, 'height' => 300],
                ],
            ],

            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'logo_main',
                'createThumbsOnRequest' => true,
                'filePath' => '@frontend/web/uploads/casinos/[[attribute_id]]/[[logo_main]].[[extension]]',
                'fileUrl' => '@frontend/web/uploads/casinos/[[attribute_id]]/[[logo_main]].[[extension]]',
                'thumbPath' => '@frontend/web/cache/casinos/[[attribute_id]]/[[profile]]_[[logo_main]].[[extension]]',
                'thumbUrl' => '/cache/casinos/[[attribute_id]]/[[profile]]_[[logo_main]].[[extension]]',
                'thumbs' => [
                    'main' => ['width' => 180, 'height' => 180],
                ],
            ],

            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'logo_small',
                'createThumbsOnRequest' => true,
                'filePath' => '@frontend/web/uploads/casinos/[[attribute_id]]/[[logo_small]].[[extension]]',
                'fileUrl' => '@frontend/web/uploads/casinos/[[attribute_id]]/[[logo_small]].[[extension]]',
                'thumbPath' => '@frontend/web/cache/casinos/[[attribute_id]]/[[profile]]_[[logo_small]].[[extension]]',
                'thumbUrl' => '/cache/casinos/[[attribute_id]]/[[profile]]_[[logo_small]].[[extension]]',
                'thumbs' => [
                    'small' => ['width' => 80, 'height' => 40],
                ],
            ],
            [
                'class' => TimestampBehavior::className(),
                'value' => date("Y-m-d H:i:s", time()),
            ],
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['licenseAssignments', 'currenciesAssignments'],
            ],
        ];
    }


    public function isActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isTop()
    {
        return TopCasino::find()->where(['casino_id' => $this->id])->exists();
    }

    public function isAdvert()
    {
        return false;
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

        if ($this->isTop()) {
            throw new \DomainException('Чтобы скрыть казино, уберите его с топ');
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


    public function removeFromTopList()
    {
        $this->is_top = 0;
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


    // Currencies

    public function assignCurrency($id): void
    {
        $assignments = $this->currenciesAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForCurrency($id)) {
                return;
            }
        }
        $assignments[] = CurrenciesAssignments::create($id);
        $this->currenciesAssignments = $assignments;
    }

    public function revokeCurrency($id): void
    {
        $assignments = $this->currenciesAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForCurrency($id)) {
                unset($assignments[$i]);
                $this->currenciesAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    public function revokeCurrencies(): void
    {
        $this->currenciesAssignments = [];
    }



    public function getLicenseAssignments(): ActiveQuery
    {
        return $this->hasMany(LicenseAssignments::class, ['casino_id' => 'id']);
    }

    public function getLicenses(): ActiveQuery
    {
        return $this->hasMany(License::class, ['id' => 'license_id'])->via('licenseAssignments');
    }

    public function getCurrenciesAssignments(): ActiveQuery
    {
        return $this->hasMany(CurrenciesAssignments::class, ['casino_id' => 'id']);
    }

    public function getCurrencies(): ActiveQuery
    {
        return $this->hasMany(Currency::class, ['id' => 'currency_id'])->via('currenciesAssignments');
    }


}
