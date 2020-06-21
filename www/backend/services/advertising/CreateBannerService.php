<?php


namespace backend\services\advertising;


use backend\forms\advertising\CreateAdvertising;
use common\models\Advertising\Advertising;
use common\repositories\AdvertisingRepository;

class CreateBannerService implements AdvertCreateService
{
    /**
     * @var AdvertisingRepository
     */
    private $repository;

    public function __construct(AdvertisingRepository $repository)
    {
        $this->repository = $repository;
    }

    function create(CreateAdvertising $form): void
    {
        if ($form->getFreeAdvdert()) {
            $Advertising = Advertising::createFreeAdvertising(
                $form->advertiser,
                $form->name,
                $form->dateStart,
                $form->getFreeAdvdert()->dateEnd
            );
        } else {
            $paidForm = $form->getPaidAdvert();
            $Advertising = Advertising::createPaidAdvertising(
                $form->advertiser,
                $form->name,
                $form->dateStart,
                (int)$paidForm->price,
                (int)$paidForm->bonus,
                (int)$paidForm->budget
            );
        }

        $this->repository->save($Advertising);

    }
}