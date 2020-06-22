<?php


namespace backend\forms\advertising;


use backend\helpers\BannerHelper;
use yii\base\Model;
use yii\web\UploadedFile;

class CreateBannerAdvertising extends Model
{
    public $block;

    /**
     * @var UploadedFile
     */
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
            [['block'], 'required'],
            ['photo', 'safe'],
        ];
    }


    public function load($data, $formName = null)
    {
        $loadSelf = parent::load($data, $formName);

        $link = true;
        if($this->_link){
            $link = $this->_link->load($data, $formName === null ? null : 'link');
        }

        return $loadSelf && $link;
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        $validateSelf = parent::validate($attributeNames, $clearErrors);

        $link = true;
        if($this->_link){
            $link = $this->_link->validate(null, $clearErrors);
        }

        return $validateSelf && $link;
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