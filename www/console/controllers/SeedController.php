<?php

namespace console\controllers;


use backend\helpers\BannerHelper;
use common\models\Advertising\Advertising;
use common\models\Advertising\AdvertisingStatistic;
use common\models\Advertising\Banner;
use common\models\User;
use Faker\Factory;
use Yii;
use yii\console\Controller;

class SeedController extends Controller
{
    public $count = 1;

    private $seeder;
    private $generator;
    private $faker;

    public function __construct($id, $module, $config = [])
    {
        $this->seeder = new \tebazil\yii2seeder\Seeder();
        $this->generator = $this->seeder->getGeneratorConfigurator();
        $this->faker = $faker = Factory::create();

        parent::__construct($id, $module, $config);
    }

    public function options($actionID)
    {
        return ['count'];
    }

    public function optionAliases()
    {
        return ['n' => 'count'];
    }

    public function actionUsers()
    {
        $user = [
            'id', //automatic pk
            'username' => $this->faker->userName,
            'password_hash' => Yii::$app->security->generatePasswordHash('111111'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'email' => $this->faker->email,
            'created_at' => time(),
            'updated_at' => time(),
            'status' => $this->faker->randomElement([User::STATUS_ACTIVE, User::STATUS_DELETED, User::STATUS_INACTIVE]),
        ];

        $this->seeder->table('user')->columns($user)->rowQuantity($this->count);
        $this->seeder->refill();

        $admin = $user;
        $admin['username'] = 'admin';
        $Admin = new User();
        $Admin->id = $this->count + 1;
        $Admin->username = $admin['username'];
        $Admin->password_hash = $admin['password_hash'];
        $Admin->auth_key = $admin['auth_key'];
        $Admin->email = $admin['email'];
        $Admin->created_at = $admin['created_at'];
        $Admin->status = User::STATUS_ACTIVE;
        $Admin->save();
    }


    public function actionBanners()
    {

        Yii::$app->db->createCommand()->truncateTable(Advertising::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(Banner::tableName())->execute();
        Yii::$app->db->createCommand()->truncateTable(AdvertisingStatistic::tableName())->execute();

        $advertisers = User::find()->select('id')->where(['status' => User::STATUS_ACTIVE])->column();

        for ($i = 0; $i <= $this->count; $i++) {

            if ($this->faker->boolean) {
                $Adv = Advertising::createFreeAdvertising(
                    $this->faker->randomElement($advertisers),
                    $this->faker->company,
                    $this->faker->dateTimeBetween('-15 days', '+10 days')->format('Y-m-d H:i:s'),
                    $this->faker->dateTimeBetween('-15 days', '+10 days')->format('Y-m-d H:i:s')
                );
            } else {
                $Adv = Advertising::createPaidAdvertising(
                    $this->faker->randomElement($advertisers),
                    $this->faker->company,
                    $this->faker->dateTimeBetween('-15 days', '+10 days')->format('Y-m-d H:i:s'),
                    $this->faker->randomElement([5, 3, 10]),
                    random_int(0, 10),
                    $this->faker->randomElement([50, 100, 300, 500]),
                    $this->faker->randomElement([
                        Advertising::FREE_PAID_TYPE,
                        Advertising::CLICK_PAID_TYPE,
                        Advertising::VIEW_PAID_TYPE,
                        Advertising::PERIOD_PAID_TYPE,
                    ])
                );
            }

            $Adv->status = $this->faker->randomElement([
                Advertising::STATUS_ACTIVE,
                Advertising::STATUS_WAIT,
                Advertising::STATUS_DISABLED
            ]);

            $Adv->save();

            $Banner = Banner::create(
                $Adv->id,
                random_int(1, count(BannerHelper::loadBlockList()) - 1),
                $url = $this->faker->imageUrl(),
                $this->faker->url
            );

            $statCnt = random_int(1, 150);


            for ($j = 0; $j < $statCnt; $j++) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($Adv->paid_type === Advertising::VIEW_PAID_TYPE) {
                        $Statistic = AdvertisingStatistic::createView(
                            $Adv->id,
                            $Adv->price
                        );
                        $Statistic->save();
                        $Adv->writeOffMoney($Adv->price);
                    } elseif ($Adv->paid_type === Advertising::CLICK_PAID_TYPE) {
                        $Statistic = AdvertisingStatistic::createClick(
                            $Adv->id,
                            $Adv->price
                        );
                        $Statistic->save();
                        $Adv->writeOffMoney($Adv->price);
                    }
                    if ($statCnt <= 4) {
                        $Statistic = AdvertisingStatistic::createRefill(
                            $Adv->id,
                            $amount = random_int(300, 500)
                        );
                        $Statistic->save();
                        $Adv->refillMoney($amount);
                    }
                    $Adv->save();

                    $transaction->commit();
                } catch (\Exception $exception) {
                    $transaction->rollBack();
                    echo $exception->getMessage() . PHP_EOL;
                }


            }

            $Banner->save();
        }
    }
}