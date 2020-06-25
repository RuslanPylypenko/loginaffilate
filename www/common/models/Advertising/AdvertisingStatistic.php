<?php


namespace common\models\Advertising;


use yii\db\ActiveRecord;

/**
 * @property int advert_id
 * @property false|mixed|string|null created_at
 * @property string action
 * @property float amount
 */
class AdvertisingStatistic extends ActiveRecord
{
    const VIEW_ACTION = 'view';
    const CLICK_ACTION = 'click';
    const PERIOD_ACTION = 'period';
    const REFILL_ACTION = 'refill';

    public static function createView(int $advertId, $amount): self
    {
        $Statistic = new self();
        $Statistic->advert_id = $advertId;
        $Statistic->created_at = date('Y-m-d H:i:s', time());
        $Statistic->action = self::VIEW_ACTION;
        $Statistic->amount = $amount;
        return $Statistic;
    }

    public static function createClick(int $advertId, $amount): self
    {
        $Statistic = new self();
        $Statistic->advert_id = $advertId;
        $Statistic->created_at = date('Y-m-d H:i:s', time());
        $Statistic->action = self::CLICK_ACTION;
        $Statistic->amount = $amount;
        return $Statistic;
    }

    public static function createRefill(int $advertId, $amount): self
    {
        $Statistic = new self();
        $Statistic->advert_id = $advertId;
        $Statistic->created_at = date('Y-m-d H:i:s', time());
        $Statistic->action = self::REFILL_ACTION;
        $Statistic->amount = $amount;
        return $Statistic;
    }

    public static function tableName()
    {
        return 'advertising_statistic';
    }
}