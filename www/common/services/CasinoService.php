<?php

namespace common\services;

use backend\forms\CreateCasinoForm;
use common\models\Casino;

class CasinoService
{
    /**
     * @param CreateCasinoForm $casinoForm
     * @return Casino
     */
    public function createCasino(CreateCasinoForm $casinoForm)
    {
        $casino = new Casino();
        $casino->title = $casinoForm->title;
        $casino->country_id = 1;
        $casino->logo = 'logo';
        $casino->background = 'background';
        $casino->description = $casinoForm->description;
        $casino->status = Casino::STATUS_DRAFT;

        return $casino;
    }

}