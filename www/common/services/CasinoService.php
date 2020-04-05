<?php

namespace common\services;

use backend\forms\CreateCasinoForm;
use backend\forms\SetRatingForm;
use backend\forms\UpdateUrlForm;
use common\models\Casino;
use common\models\Currency;
use common\models\License;
use common\models\TopCasino;
use common\repositories\CasinoRepository;
use common\repositories\CurrencyRepository;
use common\repositories\LicenseRepository;
use common\repositories\TopCasinoRepository;

class CasinoService
{
    private $casinos;
    private $topCasinos;
    private $licenses;
    private $currencies;
    private $transaction;

    public function __construct(
        CasinoRepository $casinos,
        TopCasinoRepository $topCasinos,
        LicenseRepository $licenses,
        CurrencyRepository $currencies,
        TransactionManager $transaction
    )
    {
        $this->casinos = $casinos;
        $this->topCasinos = $topCasinos;
        $this->licenses = $licenses;
        $this->currencies = $currencies;
        $this->transaction = $transaction;
    }


    public function createCasino(CreateCasinoForm $form): Casino
    {
        $casino = Casino::create(
            $form->title,
            $form->description,
            $form->provider_id,
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


        foreach ($form->currencies->existing as $currencyId) {
            $currency = $this->currencies->get($currencyId);
            $casino->assignCurrency($currency->id);
        }

        $this->transaction->wrap(function () use ($casino, $form) {
            foreach ($form->currencies->newNames as $currencyName) {
                if (!$currency = $this->currencies->findByName($currencyName)) {
                    $currency = Currency::create($currencyName);
                    $this->currencies->save($currency);
                }
                $casino->assignCurrency($currency->id);
            }
            $this->currencies->save($currency);
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
        $casino = $this->casinos->get($id);
        $topCasino = TopCasino::create($casino->id);
        $topCasino->addToTopList($casino);
        $this->topCasinos->save($topCasino);
    }

    public function removeFromTopList($id)
    {
        $topCasino = $this->topCasinos->get($id);
        $this->topCasinos->remove($topCasino);

        $this->transaction->wrap(function () {
            /** @var TopCasino[] $topCasinos */
            $topCasinos = TopCasino::find()->all();
            $ordCounter = 1;
            foreach ($topCasinos as $topCasino) {
                $topCasino->ord = $ordCounter;
                $this->topCasinos->save($topCasino);
                $ordCounter++;
            }
        });
    }

    public function moveUpInTop($casinoId)
    {
        $this->transaction->wrap(function () use ($casinoId) {
            $currentTopCasino = $this->topCasinos->get($casinoId);
            $currentTopCasino->moveUp();
            $previousTopCasino = $this->topCasinos->getByOrd($currentTopCasino->ord);
            $previousTopCasino->moveDown();
            $this->topCasinos->save($currentTopCasino);
            $this->topCasinos->save($previousTopCasino);
        });
    }

    public function moveDownInTop($casinoId)
    {
        $this->transaction->wrap(function () use ($casinoId) {
            $currentTopCasino = $this->topCasinos->get($casinoId);
            $currentTopCasino->moveDown();
            $previousTopCasino = $this->topCasinos->getByOrd($currentTopCasino->ord);
            $previousTopCasino->moveUp();
            $this->topCasinos->save($currentTopCasino);
            $this->topCasinos->save($previousTopCasino);
        });
    }

}