<?php


namespace common\models\Advertising;


use backend\helpers\BannerHelper;
use yii\db\ActiveRecord;

/**
 * @property integer block_id
 * @property string photo
 * @property string link
 */
class Banner extends ActiveRecord
{
    public static function tableName()
    {
        return 'advert_banner';
    }

    public function getBlock(): string
    {
        return BannerHelper::getBlock($this->block_id);
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function getLink(): AdvertisingLink
    {
        return new AdvertisingLink('', '', []);
    }
}