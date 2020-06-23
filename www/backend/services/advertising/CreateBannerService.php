<?php


namespace backend\services\advertising;


use backend\forms\advertising\CreateAdvertising;
use common\models\Advertising\Advertising;
use common\models\Advertising\Banner;
use common\repositories\AdvertisingRepository;
use common\services\FileUploadService;
use Yii;

class CreateBannerService implements AdvertCreateService
{
    /**
     * @var AdvertisingRepository
     */
    private $repository;
    /**
     * @var FileUploadService
     */
    private $fileUploadService;

    public function __construct(
        AdvertisingRepository $repository,
        FileUploadService $fileUploadService
    )
    {
        $this->repository = $repository;
        $this->fileUploadService = $fileUploadService;
    }

    function create(CreateAdvertising $form): void
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();

        try {
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
                    (int)$paidForm->budget,
                    $paidForm->paidType
                );
            }

            $this->repository->saveAdvertising($Advertising);

            $bannerForm = $form->getBannerAdvdert();

            $filename = 'banner_id_' . $Advertising->id . '.' . $bannerForm->photo->extension;
            $path = \Yii::getAlias('@frontend/web/uploads/banners/');

            $Banner = Banner::create($Advertising->id, $bannerForm->block, $filename, $bannerForm->getLink()->toJson());

            $this->repository->saveBanner($Banner);

            $transaction->commit();

            $this->fileUploadService->upload($bannerForm->photo, $path . $filename);
        }catch (\Exception $exception){
            $transaction->rollBack();
        }


    }
}