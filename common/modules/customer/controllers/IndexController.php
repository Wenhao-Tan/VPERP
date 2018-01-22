<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/9/2
 * Time: 10:01
 */

namespace common\modules\customer\controllers;

use common\modules\customer\models\Customer;
use common\modules\customer\models\CustomerSearch;
use common\modules\customer\models\Address;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class IndexController extends Controller
{
    public $layout = 'customer';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['delete'],
                        'roles' => ['sales']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['sales'],
                    ],
                ],
            ],
        ];
    }

    public function findModel($id)
    {
        if (($model = Customer::findOne(['id' => $id])) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Customer();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->created_at = date('Y-m-d');
            $model->save(false);

            return $this->redirect(['index/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete() !== false) {
            $this->redirect(['index/index']);
        }
    }

    public function actionGetCustomer()
    {
        $id = $_POST['id'];

        return $id;
    }
}