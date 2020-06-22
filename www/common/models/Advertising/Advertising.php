<?php

namespace common\models\Advertising;

use common\models\User;
use yii\db\ActiveRecord;


/**
 * @property string status
 * @property integer advertiser_id
 * @property string name
 * @property mixed date_start
 * @property mixed|null date_end
 * @property int paid_type
 * @property int|null price
 * @property int|null bonus
 * @property int|null budget
 * @property mixed created_at
 * @property mixed updated_at
 * @property int id
 */
class Advertising extends ActiveRecord
{
    const STATUS_ACTIVE = 'active';

    //Paid Type
    const FREE_PAID_TYPE = 1;
    const CLICK_PAID_TYPE = 2;
    const VIEW_PAID_TYPE = 3;
    const PERIOD_PAID_TYPE = 4;

    public static function tableName()
    {
        return 'advertising';
    }

    public static function createFreeAdvertising(
        int $advertiserId,
        string $name,
        $dateStart,
        $dateEnd
    ): self
    {
        $Advertising = new Advertising();
        $Advertising->status = self::STATUS_ACTIVE;
        $Advertising->advertiser_id = $advertiserId;
        $Advertising->name = $name;
        $Advertising->date_start = $dateStart;
        $Advertising->date_end = $dateEnd;
        $Advertising->paid_type = self::FREE_PAID_TYPE;
        $Advertising->price = null;
        $Advertising->bonus = null;
        $Advertising->budget = null;
        $Advertising->created_at = date('Y-m-d H:i:s', time());
        $Advertising->updated_at = date('Y-m-d H:i:s', time());

        return $Advertising;
    }

    public static function createPaidAdvertising(
        int $advertiserId,
        string $name,
        $dateStart,
        int $price,
        int $bonus,
        int $budget
    ):self
    {
        $Advertising = new Advertising();
        $Advertising->status = self::STATUS_ACTIVE;
        $Advertising->advertiser_id = $advertiserId;
        $Advertising->name = $name;
        $Advertising->date_start = $dateStart;
        $Advertising->paid_type = self::FREE_PAID_TYPE;
        $Advertising->price = $price;
        $Advertising->bonus = $bonus;
        $Advertising->budget = $budget;
        $Advertising->created_at = date('Y-m-d H:i:s', time());
        $Advertising->updated_at = date('Y-m-d H:i:s', time());

        return $Advertising;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE && $this->getDateStart()->getTimestamp() > time();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertiser()
    {
        return $this->hasOne(User::class, ['advertiser_id' => 'id']);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDateStart(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->date_start);
    }

    /**
     * @return int
     */
    public function getPaidType(): int
    {
        return $this->paid_type;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @return int|null
     */
    public function getBonus(): ?int
    {
        return $this->bonus;
    }

    /**
     * @return int|null
     */
    public function getBudget(): ?int
    {
        return $this->budget;
    }
}