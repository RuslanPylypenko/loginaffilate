<?php


namespace backend\forms\advertising;


use backend\helpers\BannerHelper;
use yii\base\Model;

class CreateBannerAdvertising extends Model
{
    public $block;
    public $photo;

    private $_link;

    public function __construct($config = [])
    {
        $this->_link = new AdvertLinkForm();

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['block', 'link'], 'required'],
        ];
    }


    public function loadBlockList():array
    {
        return BannerHelper::loadBlockList();
    }

    /**
     * @return AdvertLinkForm
     */
    public function getLink(): AdvertLinkForm
    {
        return $this->_link;
    }
}