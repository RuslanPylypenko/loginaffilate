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
 * @property User advertiser
 * @property AdvertisingStatistic statistic
 */
class Advertising extends ActiveRecord
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DISABLED = 'disabled';
    const STATUS_WAIT = 'wait';

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
        int $budget,
        int $paidType
    ): self
    {
        $Advertising = new Advertising();
        $Advertising->status = self::STATUS_ACTIVE;
        $Advertising->advertiser_id = $advertiserId;
        $Advertising->name = $name;
        $Advertising->date_start = $dateStart;
        $Advertising->paid_type = $paidType;
        $Advertising->price = $price;
        $Advertising->bonus = $bonus;
        $Advertising->budget = $budget;
        $Advertising->created_at = date('Y-m-d H:i:s', time());
        $Advertising->updated_at = date('Y-m-d H:i:s', time());

        return $Advertising;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE &&
            $this->getDateStart()->getTimestamp() < time() &&
            !$this->isOutOfFunds();
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isFutureStart(): bool
    {
        return $this->status === self::STATUS_ACTIVE && time() < $this->getDateStart()->getTimestamp();
    }

    public function isRunOutOfTime(): bool
    {
        return $this->status === self::STATUS_ACTIVE &&
            $this->getDateStart() !== null &&
            $this->getDateStart()->getTimestamp() > time();
    }

    public function isDisabled(): bool
    {
        return $this->status === self::STATUS_DISABLED;
    }

    public function isFree(): bool
    {
        return $this->paid_type === self::FREE_PAID_TYPE;
    }

    public function isOutOfFunds(): bool
    {
        return !$this->isFree() && ($this->getLeftPaidActions() === 0);
    }

    public function getLeftPaidActions(): int
    {
        return floor($this->budget / $this->price) + $this->bonus;
    }

    public function isClickPaid(): bool
    {
        return $this->paid_type === self::CLICK_PAID_TYPE;
    }

    public function isViewPaid(): bool
    {
        return $this->paid_type === self::VIEW_PAID_TYPE;
    }

    public function isPeriodPaid(): bool
    {
        return $this->paid_type === self::PERIOD_PAID_TYPE;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertiser()
    {
        return $this->hasOne(User::class, ['id' => 'advertiser_id']);
    }

    public function getStatistic()
    {
        return $this->hasMany(AdvertisingStatistic::class, ['advert_id' => 'id']);
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

    public function getProgress()
    {
        return random_int(1, 99);
    }

    public function writeOffMoney($amount): void
    {
        if ($this->budget < $amount && $this->bonus <= 0) {
            throw new \DomainException('insufficient funds');
        }

        if ($this->budget < $amount) {
            $this->bonus -= 1;
            return;
        }
        $this->budget -= $amount;
    }

    public function refillMoney($amount): void
    {
        $this->budget += $amount;
    }


}