<?php
namespace common\modules\order\controllers;


use common\modules\customer\models\Customer;
use common\modules\customer\models\Address;
use yii\web\Controller;

class InvoiceController extends Controller
{
    public $layout = 'order.php';

    public function actionCreate()
    {
        $customer = new Customer();
        $shippingAddress = new Address();

        return $this->render('create', [
            'customer' => $customer,
            'shippingAddress' => $shippingAddress,
        ]);
    }


}