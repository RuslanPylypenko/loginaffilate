<?php

namespace common\services;

use backend\forms\CreateCasinoForm;
use backend\forms\SetRatingForm;
use backend\forms\UpdateUrlForm;
use common\models\Casino;
use common\models\License;
use common\repositories\CasinoRepository;
use common\repositories\LicenseRepository;

class CasinoService
{
    private $casinos;
    private $licenses;
    private $transaction;

    public function __construct(
        CasinoRepository $casinos,
        LicenseRepository $licenses,
        TransactionManager $transaction
    )
    {
        $this->casinos = $casinos;
        $this->licenses = $licenses;
        $this->transaction = $transaction;
    }


    public function createCasino(CreateCasinoForm $form): Casino
    {
        $casino = Casino::create(
            $form->title,
            $form->description,
            $form->website
        );
        foreach ($form->licenses->existing as $licenseId) {
            $license = $this->licenses->get($licenseId);
            $casino->assignLicense($license->id);
        }

        $this->transaction->wrap(function () use ($casino, $form) {
            foreach ($form->licenses->newNames as $licenseName) {
                if (!$license = $this->licenses->findByName($licenseName)) {
                    $license = License::create($licenseName);
                    $this->licenses->save($license);
                }
                $casino->assignLicense($license->id);
            }
            $this->licenses->save($license);
        });

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

    public function setRating(SetRatingForm $setRatingForm)
    {
        $casino = $this->casinos->get($setRatingForm->casinoId);
        $casino->setRating($setRatingForm->rating);
        $this->casinos->save($casino);
    }

    public function addToTopList($id)
    {

    }

}