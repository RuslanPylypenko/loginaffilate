<?php

namespace backend\forms\advertising;

use common\models\User;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CreateAdvertising extends Model
{
    public $name;
    public $dateStart;
    public $advertiser;

    //PaidType
    public $_paidAdvdert;
    public $_freeAdvdert;

    //AdvertisingType
    public $_bannerAdvdert;
    public $_tickerAdvdert;

    public function rules()
    {
        return [
            [['name', 'dateStart', 'advertiser'], 'required']
        ];
    }

    public function assignPaidForm(CreatePaidAdvertising $form)
    {
        $this->_paidAdvdert = $form;
    }

    public function assignBannerForm(CreateBannerAdvertising $form)
    {
        $this->_bannerAdvdert = $form;
    }

    public function getPaidAdvert(): ?CreatePaidAdvertising
    {
        return $this->_paidAdvdert;
    }

    public function getBannerAdvdert(): ?CreateBannerAdvertising
    {
        return $this->_bannerAdvdert;
    }

    public function assignFreeForm(CreateFreeAdvertising $form)
    {
        $this->_freeAdvdert = $form;
    }

    public function getFreeAdvdert(): ?CreateFreeAdvertising
    {
        return $this->_freeAdvdert;
    }

    public function assignTickerForm(CreateTickerAdvertising $form)
    {
        $this->_tickerAdvdert = $form;
    }
    public function getTickerAdvdert(): ?CreateTickerAdvertising
    {
        return $this->_tickerAdvdert;
    }


    public function loadAdvertisers(): array
    {
        return ArrayHelper::map(
            User::find()->orderBy('username')
                ->select(['id', 'username'])
                ->asArray()
                ->all(),
            'id',
            'username'
        );
    }


    public function load($data, $formName = null)
    {
        $loadSelf = parent::load($data, $formName);

        $loadTicker = true;
        if($this->_tickerAdvdert){
            $loadTicker = $this->_tickerAdvdert->load($data, $formName === null ? null : 'tickerAdvert');
        }

        $loadBanner = true;
        if($this->_bannerAdvdert){
            $loadBanner = $this->_bannerAdvdert->load($data, $formName === null ? null : 'bannerAdvert');
        }

        $loadPaidAdvert = true;
        if($this->_paidAdvdert){
            $loadPaidAdvert = $this->_paidAdvdert->load($data, $formName === null ? null : 'paidAdvert');
        }

        $loadFreeAdvert = true;
        if($this->_freeAdvdert){
            $loadFreeAdvert = $this->_freeAdvdert->load($data, $formName === null ? null : 'freeAdvert');
        }

        return $loadSelf && $loadTicker && $loadBanner && $loadPaidAdvert && $loadFreeAdvert;
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        $validateSelf = parent::validate($attributeNames, $clearErrors);

        $validateBanner = true;
        if($this->_bannerAdvdert){
            $validateBanner = $this->_bannerAdvdert->validate(null, $clearErrors);
        }

        $validatePaid = true;
        if($this->_paidAdvdert){
            $validatePaid = $this->_paidAdvdert->validate(null, $clearErrors);
        }

        $validateFree = true;
        if($this->_freeAdvdert){
            $validateFree = $this->_freeAdvdert->validate(null, $clearErrors);
        }

        return $validateSelf && $validateBanner && $validatePaid && $validateFree;
    }



}