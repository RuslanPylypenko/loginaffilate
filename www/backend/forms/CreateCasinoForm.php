<?php

namespace backend\forms;

use common\forms\CompositeForm;
use common\models\Casino;
use common\models\Currency;
use common\models\Language;
use common\models\Provider;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * @property CurrenciesForm $currencies
 * @property LanguagesForm $languages
 */
class CreateCasinoForm extends Model
{
    public $title;
    public $description;
    public $website;
    public $forbidden_countries;
    public $logo_main;
    public $logo_small;
    public $background;
    public $positive_options;
    public $negative_options;
    public $year_of_creation;
    public $min_deposit;
    public $min_output;
    public $restriction_limit;
    public $provider_id;
    public $method_output_ids;
    public $method_deposit_ids;
    public $has_license;
    public $currencies;
    public $languages;

    public $website_options;
    public $country_switch;

    public function __construct($config = [])
    {
        parent::__construct($config);
//        $this->currencies = new CurrenciesForm();
//        $this->languages = new LanguagesForm();

    }


    public function rules()
    {
        return [
            [
                [
                    'title',
                    'description',
                    'website',
                    'year_of_creation',
                    'min_deposit',
                    'min_output',
                    'restriction_limit',
                    'provider_id',
                    'background',
                    'logo_main',
                    'currencies',
                    'languages',
                    'logo_small',
                    'forbidden_countries'
                ],
                'required'],
            ['title', 'trim'],
            ['title', 'uniqueTitle'],
            ['website', 'url'],
            [['website_options', 'country_switch', 'has_license'], 'safe'],
            [['min_deposit', 'min_output', 'restriction_limit'], 'double', 'min' => 0],
            ['background', 'image'],
            ['logo_main', 'image'],
            ['logo_small', 'image'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'languages' => 'Языки',
            'currencies' => 'Валюты',
            'title' => 'Название казино H1',
            'forbidden_countries' => 'Запрещенные страны',
            'year_of_creation' => 'Год создания казино',
            'min_deposit' => 'Минимальный депозит',
            'min_output' => 'Минимальный вывод',
            'restriction_limit' => 'Ограничение лимита',
            'provider_id' => 'Провайдер',
            'logo_main' => 'Лого без фона',
            'logo_small' => 'Лого маленькое',
            'background' => 'Подложка',
            'website' => 'Сайт казино',
            'website_options' => 'Настройки ссылки',
            'description' => 'Описание',
            'has_license' => 'Лицензия',
            'status' => 'Статус',
            'url' => 'Ссылка',
            'rating' => 'Рейтинг',
            'method_output_ids' => 'Методы вывода',
            'method_deposit_ids' => 'Методы депозита',
        ];
    }


    public function uniqueTitle($attribute)
    {
        if (Casino::find()->where(['title' => $this->title])->exists()) {
            $this->addError($attribute, "Казино с таким названием уже существует");
        }

    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->background = UploadedFile::getInstance($this, 'background');
            $this->logo_main = UploadedFile::getInstance($this, 'logo_main');
            $this->logo_small = UploadedFile::getInstance($this, 'logo_small');
            return true;
        }
        return false;
    }

    public function currenciesList(): array
    {
        return ArrayHelper::map(Currency::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function providerList(): array
    {
        return ArrayHelper::map(Provider::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function loadWebsiteOptions(): array
    {
        return ['target' => '_blank', 'rel' => 'nofollow'];
    }

    public function languagesList(): array
    {
        return ArrayHelper::map(Language::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return ['currencies', 'languages'];
    }
}