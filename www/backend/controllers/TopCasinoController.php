<?php

namespace backend\controllers;

use backend\forms\TopCasinoForm;
use common\services\CasinoService;
use Yii;
use common\models\TopCasino;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TopCasinoController implements the CRUD actions for TopCasino model.
 */
class TopCasinoController extends Controller
{
    private $casinoService;

    public function __construct($id, $module, CasinoService $casinoService, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->casinoService = $casinoService;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'up' => ['POST'],
                    'down' => ['POST'],
                    'add-to-top-list' => ['POST'],
                    'remove-from-top-list' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TopCasino models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new TopCasinoForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                foreach ($model->casinoIds as $casinoId){
                    $this->casinoService->addToTopList($casinoId);
                }
                Yii::$app->session->setFlash('success', "Новые казино добавлены в топ");

            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            return $this->redirect(['index']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => TopCasino::find()->with('casino'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionUp($id)
    {
        try {
            $this->casinoService->moveUpInTop($id);
            Yii::$app->session->setFlash('success', "Порядок успешно изменен");
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: (['index']));
    }

    public function actionDown($id)
    {
        try {
            $this->casinoService->moveDownInTop($id);
            Yii::$app->session->setFlash('success', "Порядок успешно изменен");
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: (['index']));
    }



    public function actionAddToTopList($id)
    {
        try {
            $this->casinoService->addToTopList($id);
            Yii::$app->session->setFlash('success', "Казино добавлено в топ");
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: (['view', 'id' => $id]));
    }


    public function actionRemoveFromTopList($id)
    {
        try {
            $this->casinoService->removeFromTopList($id);
            Yii::$app->session->setFlash('success', "Казино удалено из топ");
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: (['view', 'id' => $id]));
    }
}
