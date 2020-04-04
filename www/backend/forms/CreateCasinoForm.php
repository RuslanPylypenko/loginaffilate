<?php

namespace backend\forms;

use common\forms\CompositeForm;
use common\models\Provider;
use yii\helpers\ArrayHelper;

/**
 * @property LicensesForm $licenses
 * @property CurrenciesForm $currencies
 */
class CreateCasinoForm extends CompositeForm
{
    public $title;
    public $description;
    public $website;
    public $forbidden_countries;
    public $logo;
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
    public $language_ids;

    public function __construct($config = [])
    {
        $this->licenses = new LicensesForm();
        $this->currencies = new CurrenciesForm();
        parent::__construct($config);
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
                ],
                'required'],
            ['website', 'url'],
            [['min_deposit', 'min_output', 'restriction_limit'], 'double', 'min' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название казино H1',
            'forbidden_countries' => 'Запрещенные страны',
            'year_of_creation' => 'Год создания казино',
            'min_deposit' => 'Минимальный депозит',
            'min_output' => 'Минимальный вывод',
            'restriction_limit' => 'Ограничение лимита',
            'provider_id' => 'Провайдер',
            'logo' => 'Лого',
            'background' => 'Подложка',
            'website' => 'Сайт казино',
            'description' => 'Описание',
            'status' => 'Статус',
            'url' => 'Ссылка',
            'rating' => 'Рейтинг',
            'method_output_ids' => 'Методы вывода',
            'method_deposit_ids' => 'Методы депозита',
        ];
    }

    public function providerList(): array
    {
        return ArrayHelper::map(Provider::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return ['licenses', 'currencies'];
    }
}