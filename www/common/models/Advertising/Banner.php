<?php


namespace common\models\Advertising;


use backend\helpers\BannerHelper;
use yii\db\ActiveRecord;

/**
 * @property integer block_id
 * @property string photo
 * @property string link
 * @property int advert_id
 */
class Banner extends ActiveRecord
{
    public static function tableName()
    {
        return 'advert_banner';
    }

    public static function create(int $advertId, int $blockId, string $photo, string $link): self
    {
        $Banner = new self();
        $Banner->advert_id = $advertId;
        $Banner->block_id = $blockId;
        $Banner->photo = $photo;
        $Banner->link = $link;

        return $Banner;
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