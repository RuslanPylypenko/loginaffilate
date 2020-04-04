<?php

namespace backend\forms;

use common\forms\CompositeForm;

/**
 * @property LicensesForm $licenses
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
    public $currency_ids;
    public $method_output_ids;
    public $method_deposit_ids;
    public $language_ids;

    public function __construct($config = [])
    {
        $this->licenses = new LicensesForm();
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
                    'restriction_limit'
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
            'title' => 'Название',
            'forbidden_countries' => 'Запрещенные страны',
            'year_of_creation' => 'Год создания казино',
            'min_deposit' => 'Минимальный депозит',
            'min_output' => 'Минимальный вывод',
            'restriction_limit' => 'Ограничение лимита',
            'logo' => 'Лого',
            'background' => 'Подложка',
            'website' => 'Сайт казино',
            'description' => 'Описание',
            'status' => 'Статус',
            'url' => 'Ссылка',
            'rating' => 'Рейтинг',
        ];
    }

    protected function internalForms(): array
    {
        return ['licenses'];
    }
}