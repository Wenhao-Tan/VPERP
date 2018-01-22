<?php

namespace frontend\modules\retail\controllers;

use Yii;
use frontend\modules\retail\models\OrderException;
use frontend\modules\retail\models\OrderExceptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderExceptionController implements the CRUD actions for OrderException models.
 */
class OrderExceptionController extends Controller
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
     * Lists all OrderException models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderExceptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderException models.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'models' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OrderException models.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderException();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->addOrderException();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'models' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OrderException models.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->addOrderException();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'models' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrderException models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderException models based on its primary key value.
     * If the models is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderException the loaded models
     * @throws NotFoundHttpException if the models cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderException::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
