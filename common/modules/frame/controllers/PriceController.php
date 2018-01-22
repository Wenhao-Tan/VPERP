<?php

namespace common\modules\frame\controllers;

use Yii;
use common\modules\frame\models\Price;
use common\modules\frame\models\PriceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PriceController implements the CRUD actions for Price models.
 */
class PriceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Price models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Price models.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'models' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Price models.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Price();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->reference]);
        } else {
            return $this->render('create', [
                'models' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Price models.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $reference
     * @return mixed
     */
    public function actionUpdate($reference)
    {
        $model = $this->findModel($reference);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['default/index', 'PriceSearch[reference]' => $model->reference], 301);
        } else {
            return $this->renderAjax('update', [
                'models' => $model,
            ]);
        }
    }

    public function actionMultipleUpdates($keyList)
    {
        $model = new Price();
        $keys = explode(',', $keyList);

        if (Yii::$app->request->post()) {
            foreach ($keys as $key) {
                $model = Price::findOne($key);
                $model->load(Yii::$app->request->post());
                $model->save();
            }

            return $this->redirect(['default/index']);
        }

        return $this->renderAjax('multiple-updates', [
            'models' => $model,
            'keys' => $keys,
        ]);
    }

    /**
     * Deletes an existing Price models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Price models based on its primary key value.
     * If the models is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Price the loaded models
     * @throws NotFoundHttpException if the models cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Price::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
