<?php

namespace backend\forms;

use yii\base\Model;

class UpdateCasinoForm extends Model
{
    public $id;
    public $title;
    public $description;
    public $website;

    public $country_ids;
    public $logo;
    public $background;
    public $positive_options;
    public $negative_options;
    public $year_of_creation;
    public $min_deposit;
    public $min_output;
    public $restriction_limit;
    public $license_id;
    public $provider_id;
    public $currency_ids;
    public $method_output_ids;
    public $method_deposit_ids;
    public $language_ids;

    public $country_id;
    public $url;
    public $status;
    public $rating;
    public $is_top;
    public $is_advert;
    public $created_at;
    public $updated_at;


    public function rules()
    {
        return [
            [['title', 'description', 'website'], 'required'],
            ['website', 'url'],
        ];
    }
}