<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/1/23
 * Time: 7:06
 */

namespace frontend\modules\order\controllers;

use Yii;
use frontend\modules\order\models\OrderShipping;
use frontend\modules\order\models\OrderShippingForm;
use common\models\ShippingCarrier;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class ShippingController extends Controller
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
                        'allow' => true,
                        'actions' => ['index', 'create', 'update','get-carrier'],
                        'roles' => ['sales'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {

    }

    public function actionCreate()
    {
        $model = new OrderShipping();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->shipping_id = ($model->shipping_id != null) ? $model->shipping_id : 'SH' . date('YmdHis');

            $model->save();

            $this->redirect(['index/view', 'orderId' => $model->order_id]);
        }
    }

    public function actionUpdate($shippingId)
    {
        $orderShippingModel = new OrderShippingForm();
        $orderShipping = OrderShipping::findOne(['shipping_id' => $shippingId]);

        if ($orderShippingModel->load(Yii::$app->request->post()) && $orderShippingModel->validate()) {
            $orderShippingModel->updateShipping($shippingId);

            $this->redirect(['index/view', 'orderId' => $_GET['orderId']]);
        }

        return $this->renderAjax('update', [
            'orderShippingModel' => $orderShippingModel,
            'orderShipping' => $orderShipping,
        ]);
    }

    public function actionDelete($shippingId)
    {
        $orderShipping = OrderShipping::findOne(['shipping_id' => $shippingId]);
        $orderShipping->delete();

        $this->redirect(['index/index']);
    }

    public function actionGetCarrier()
    {
        $data = '';

        if (isset($_POST['method'])) {
            $method = $_POST['method'];

            $carrierCode = ArrayHelper::map(ShippingCarrier::find()->where(['method' => $method])->all(), 'code', 'code');

            return Json::encode($carrierCode);
        }
    }

    public function actionAddress()
    {

    }
}