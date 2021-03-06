<?php

namespace frontend\modules\order\controllers;

use common\models\Color;
use common\models\ShippingCarrier;
use frontend\modules\order\models\OrderItem;
use frontend\modules\order\models\OrderPaymentSearch;
use frontend\modules\order\models\OrderSearch;
use frontend\modules\order\models\Order;
use frontend\modules\order\models\UploadForm;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use frontend\modules\order\models\Invoice;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class IndexController extends Controller
{
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
                        'actions' => ['update', 'delete'],
                        'roles' => ['sales'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['sales', 'admin'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = 'order';
        return parent::beforeAction($action);
    }

    public function findModel($orderId)
    {
        if (($model = Order::findOne(['order_id' => $orderId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionIndex()
    {
        $model = new Order();
        $searchModel = array();
        $dataProvider = array();

        $searchModel['order'] = new OrderSearch();
        $dataProvider['order'] = $searchModel['order']->search(Yii::$app->request->get());

        $searchModel['order_payment'] = new OrderPaymentSearch();
        $dataProvider['order_payment'] = $searchModel['order_payment']->search(Yii::$app->request->get());

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($orderId)
    {
        $order = $this->findModel($orderId);

        return $this->render('view',[
            'order' => $order,
        ]);
    }

    public function actionCreate()
    {
        $model = new Order();
        $model->scenario = 'create';

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateItems()
    {
        $model = new Order();

        $orderItem = new OrderItem();
        $dataProvider = $orderItem->generateDataProvider();
        $color = ArrayHelper::map(Color::find()->asArray()->all(), 'name', 'name');
        $color = [''=>''] + $color;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->order_id = $model->order_id != null ? strtoupper($model->order_id) : 'VP' . date('YmdHis');

            if (!$model->commission_rate) {
                $model->commission_rate = 5;
            }

            $model->excelFile = UploadedFile::getInstance($model, 'excelFile');
            if (isset($model->excelFile->extension)) {
                $model->upload();

                $dataProvider = $orderItem->generateDataProvider($model->excelFilePath);
            }
        }

        return $this->render('create-items', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'color' => $color,
        ]);
    }

    public function actionSubmit()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $count = count(Yii::$app->request->post('OrderItem', []));
            $orderItems = [new OrderItem()];
            for ($i = 1; $i < $count; $i++) {
                $orderItems[] = new OrderItem();
            }

            if (Model::loadMultiple($orderItems, Yii::$app->request->post()) && Model::validateMultiple($orderItems)) {
                $model->save();

                foreach ($orderItems as $orderItem) {
                    $orderItem->order_id = $model->order_id;
                    $orderItem->save();
                }

                return $this->redirect(['index/index']);
            }
        }

        return $this->redirect(['index/create']);
    }


    public function actionUpdate($orderId)
    {
        $model = $this->findModel($orderId);
        $model->scenario = Order::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index/index']);
        } else {
            return $this->renderPartial('update', [
                'model' => $model
            ]);
        }
    }

    public function actionDelete($orderId = null)
    {
        if ($orderId != null) {
            $order = Order::findOne(['order_id' => $orderId]);
            $order->delete();

            return $this->redirect(['index/index']);
        } else {
            if (isset($_POST['keysList'])) {
                $keys = $_POST['keysList'];

                return Order::deleteAll(['id' => $keys]);
            }
        }
    }

    public function actionDownload()
    {
        $path = Yii::getAlias('@webroot') . '/uploads/template';
        $file = $path . '/order_items.xlsx';

        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        } else {
            return $this->redirect(['create']);
        }
    }

    public function actionInvoice($orderId)
    {
        $invoice = new Invoice();
        $order = Order::findOne(['order_id' => $orderId]);

        $content = $this->renderPartial('invoice', [
            'order' => $order,
        ]);

        $invoice->generateInvoice($content);
    }

    public function actionAjax()
    {
        $data = '';

        if (isset($_POST['method'])) {
            $method = $_POST['method'];

            $carrierCode = ArrayHelper::map(ShippingCarrier::find()->where(['method' => $method])->all(), 'code', 'code');

            return Json::encode($carrierCode);
        } else {
            echo "Bad";
        }
    }

    public function actionUpload()
    {
        // Test action
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('uploadform', ['model' => $model]);
    }

    public function actionTest()
    {
        $model = new OrderItem();


        return $this->render('test', [
            'model' => $model,
        ]);
    }
}