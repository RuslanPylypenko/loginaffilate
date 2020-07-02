<?php

namespace backend\controllers;

use backend\forms\CreateCasinoForm;
use backend\forms\SeoPageForm;
use backend\forms\SetRatingForm;
use backend\forms\UpdateCasinoForm;
use backend\forms\UpdateUrlForm;
use common\models\Category;
use common\services\CasinoService;
use common\services\PageService;
use http\Url;
use Yii;
use common\models\Casino;
use common\searchModels\CasinoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CasinoController implements the CRUD actions for Casino model.
 */
class CasinoController extends Controller
{
    private $casinoService;
    /**
     * @var PageService
     */
    private $pageService;

    public function __construct(
        $id,
        $module,
        CasinoService $casinoService,
        PageService $pageService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);

        $this->casinoService = $casinoService;
        $this->pageService = $pageService;
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
                    'delete' => ['POST'],
                    'activate' => ['POST'],
                    'draft' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Casino models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CasinoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Casino model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Casino model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CreateCasinoForm();

        if ($form->load(Yii::$app->request->post())) {
            $casino = $this->casinoService->createCasino($form);
            $casino->save();
            $page = $this->pageService->createForCasino($casino);
            $page->save();
            return $this->redirect(['view', 'id' => $casino->id]);
        }

        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing Casino model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $casino = $this->findModel($id);

        $form = new UpdateCasinoForm($casino->attributes);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            return $this->redirect(['view', 'id' => $form->id]);
        }

        return $this->render('update', [
            'model' => $form,
            'casino' => $casino,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionActivate($id)
    {
        try {
            $this->casinoService->activate($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: (['view', 'id' => $id]));
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDraft($id)
    {
        try {
            $this->casinoService->draft($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(Yii::$app->request->referrer ?: (['view', 'id' => $id]));
    }


    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdateUrl($id)
    {
        $casino = $this->findModel($id);
        $updateUrlForm = new UpdateUrlForm(['casinoId' => $casino->id, 'url' => $casino->url]);

        if ($updateUrlForm->load(Yii::$app->request->post()) && $updateUrlForm->validate()) {

            try {
                $this->casinoService->updateUrl($updateUrlForm);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            Yii::$app->session->setFlash('success', 'Url успешно обновлен');

            return $this->redirect(['view', 'id' => $updateUrlForm->casinoId]);
        }

        return $this->render('update-url', [
            'updateUrlForm' => $updateUrlForm,
            'model' => $casino,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdateRating($id)
    {
        $casino = $this->findModel($id);
        $updateRatingForm = new SetRatingForm(['casinoId' => $casino->id, 'rating' => $casino->rating]);

        if ($updateRatingForm->load(Yii::$app->request->post()) && $updateRatingForm->validate()) {

            try {
                $this->casinoService->setRating($updateRatingForm);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            Yii::$app->session->setFlash('success', 'Рейтинг успешно обновлен');

            return $this->redirect(['view', 'id' => $updateRatingForm->casinoId]);
        }

        return $this->render('update-rating', [
            'updateRatingForm' => $updateRatingForm,
            'model' => $casino,
        ]);
    }


    public function actionSeo()
    {
        $Category = Category::find()->where(['slug' => Casino::CATEGORY_SLUG])->one();

        $model = new SeoPageForm();
        $model->loadPage($Category);

        $this->view->params['breadcrumbs'][] = ['label' => 'Казино', 'url' => ['/casino/index']];

        return $this->render('/seo/form', [
            'model' => $model,
            'backUrl' => ['/casino/index']
        ]);
    }


    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Casino model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Casino the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Casino::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
