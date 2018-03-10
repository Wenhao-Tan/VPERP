<?php

namespace frontend\modules\frame\controllers;

use Yii;
use frontend\modules\frame\models\Parameter;
use frontend\modules\frame\models\ParameterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ParameterController implements the CRUD actions for Parameter models.
 */
class ParameterController extends Controller
{
    public $layout = 'frame';
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
     * Lists all Parameter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParameterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Parameter models.
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
     * Creates a new Parameter models.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Parameter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['default/index', 'ParameterSearch[reference]' => $model->reference]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Parameter models.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $reference
     * @return mixed
     */
    public function actionUpdate($reference)
    {
        $model = $this->findModel($reference);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['default/index', 'ParameterSearch[reference]' => $model->reference]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Parameter models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $reference
     * @return mixed
     */
    public function actionDelete($reference)
    {
        $model = $this->findModel($reference);

        $this->findModel($reference)->delete();

        return $this->redirect(['default/index', 'ParameterSearch[reference]' => $model->reference]);
    }

    /**
     * Finds the Parameter models based on its primary key value.
     * If the models is not found, a 404 HTTP exception will be thrown.
     * @param string $reference
     * @return Parameter the loaded models
     * @throws NotFoundHttpException if the models cannot be found
     */
    protected function findModel($reference)
    {
        if (($model = Parameter::findOne($reference)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
