<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/1/23
 * Time: 6:59
 */

namespace frontend\modules\order\controllers;

use frontend\modules\order\models\Order;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use frontend\modules\order\models\OrderPaymentForm;
use frontend\modules\order\models\OrderPayment;

class PaymentController extends Controller
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
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new OrderPayment();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->payment_date != null ? $model->payment_date : date('Y-m-d');
            $model->save();

            $this->redirect(['index/detail', 'orderId' => $_GET['orderId']]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new OrderPayment();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->full_payment) {
                $model->type = 'Full Payment';
            }
            $model->save();

            $this->redirect(['index/view', 'orderId' => $model->order_id]);
        }
    }

    public function actionUpdate($paymentId)
    {
        $model = OrderPayment::findOne(['payment_id' => $paymentId]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $this->redirect(['index/detail', 'orderId' => $model->order_id]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($paymentId)
    {
        $orderPayment = OrderPayment::findOne(['payment_id' => $paymentId]);
        $orderPayment->delete();

        $this->redirect(['index/index']);
    }
}