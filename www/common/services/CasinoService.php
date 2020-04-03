<?php

namespace common\services;

use backend\forms\CreateCasinoForm;
use backend\forms\UpdateUrlForm;
use common\models\Casino;
use common\repositories\CasinoRepository;

class CasinoService
{
    private $casinos;

    public function __construct(CasinoRepository $casinos)
    {
        $this->casinos = $casinos;
    }

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
        $casino->website = $casinoForm->website;
        $casino->status = Casino::STATUS_DRAFT;

        return $casino;
    }

    public function activate($id)
    {
        $casino = $this->casinos->get($id);
        $casino->activate();
        $this->casinos->save($casino);
    }

    public function draft($id)
    {
        $casino = $this->casinos->get($id);
        $casino->draft();
        $this->casinos->save($casino);
    }

    public function updateUrl(UpdateUrlForm $updateUrlForm)
    {
        $casino = $this->casinos->get($updateUrlForm->casinoId);
        $casino->setUrl($updateUrlForm->url);
        $this->casinos->save($casino);
    }

}