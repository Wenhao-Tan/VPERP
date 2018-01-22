<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2018/1/7
 * Time: 15:58
 */

namespace common\modules\customer\controllers;

use common\modules\customer\models\Customer;
use Yii;
use common\modules\customer\models\Address;
use common\modules\customer\models\CustomerAddress;
use yii\web\Controller;

class AddressController extends Controller
{
    public function actionCreate()
    {
        $address = new Address();
        $customerAddress = new CustomerAddress();

        if ($address->load(Yii::$app->request->post()) && $customerAddress->load(Yii::$app->request->post())) {
            $isValid = $address->validate();
            $isValid = $customerAddress->validate() && $isValid;

            if ($isValid) {
                if ($address->save()) {
                    $customerAddress->address_id = $address->id;
                    $customerAddress->save();
                }
            }

            return $this->redirect(['index/view', 'id' => $customerAddress->customer_id]);
        }
    }

    public function actionGetAddress()
    {
        $customerID = $_POST['customerID'];
        $address = [];

        if ($customerID) {
            $addressIDs = CustomerAddress::find()
                ->select('address_id')
                ->where(['customer_id' => $customerID])
                ->asArray()
                ->column();

            foreach ($addressIDs as $addressID) {
                $oAddress = Address::find()->where(['id' => $addressID])->one();

                $aAddress = [];
                $aAddress['name'] = $oAddress->name;
                $aAddress['company'] = $oAddress->company;

                if ($oAddress->street_2 != '') {
                    $aAddress['street'] = $oAddress->street_1 . ',' . $oAddress->street_2;
                } else {
                    $aAddress['street'] = $oAddress->street_1;
                }
                $aAddress['street'] = str_replace(', ', ',', $aAddress['street']);

                $aAddress['city'] = $oAddress->city;
                $aAddress['state'] = ($oAddress->state != '') ? $oAddress->state : 'null';
                $aAddress['zip_code'] = ($oAddress->zip_code != '') ? $oAddress->zip_code : 'null';
                $aAddress['country'] = $oAddress->country;
                $aAddress['mobile_phone'] = $oAddress->mobile_phone;

                $address[$addressID]['id'] = $addressID;
                $address[$addressID]['name'] = implode(', ', $aAddress);
            }

        } else {
            throw new Exception('Customer ID is missing');
        }

        return json_encode($address);
    }
}