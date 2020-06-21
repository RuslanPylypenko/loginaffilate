<?php


namespace backend\forms\advertising;


use yii\base\Model;

class CreateTickerAdvertising extends Model
{
    public $content;

    private $_link;

    public function __construct($config = [])
    {
        $this->_link = new AdvertLinkForm();

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['content', 'link'], 'required'],
        ];
    }


    /**
     * @return AdvertLinkForm
     */
    public function getLink(): AdvertLinkForm
    {
        return $this->_link;
    }
}