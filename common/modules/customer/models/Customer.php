<?php

namespace common\modules\customer\models;


use backend\modules\user\models\UserAssigned;
use common\modules\order\models\Order;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the models class for table "customer".
 *
 * @package common\modules\customer\models
 */
class Customer extends ActiveRecord
{
    public $full_name;

    public static function tableName()
    {
        return 'customer';
    }

    public function rules()
    {
        return [
            [
                ['given_name', 'email', 'sales_representative'], 'required',
            ],
            [
                ['given_name', 'family_name', 'nationality',
                    'mobile_phone', 'whatsapp', 'skype', 'company', 'post'], 'string',
            ],
            ['email', 'email'],
            [
                ['given_name', 'family_name'], 'filter', 'filter' => 'ucfirst'
            ],
            [
                ['given_name', 'family_name', 'nationality', 'email', 'mobile_phone', 'whatsapp', 'skype'], 'trim',
            ],
        ];
    }

    public function beforeSave($insert)
    {
        $this->email = str_replace(' ', '', $this->email);

        return parent::beforeSave($insert);
    }

    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }

    public function getCustomerAddresses()
    {
        return $this->hasMany(CustomerAddress::className(), ['customer_id' => 'id']);
    }

    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['id' => 'address_id'])
            ->via('customerAddresses');
    }

    /**
     * @return array ['customer_id' => 'customer full name']
     */
    public static function getCustomers()
    {
        $staffId = UserAssigned::getCurrentStaffId();

        $customers = Customer::find()->select(['id, CONCAT(given_name, " ", family_name) AS full_name'])
            ->orderBy('given_name');

        if (!\Yii::$app->getUser()->can('admin')) {
            $customers->where(['sales_representative' => $staffId]);
        }

        $customersSelected = $customers->asArray()->all();

        $customersList = ArrayHelper::map($customersSelected, 'id', 'full_name');

        return $customersList;
    }

    public function getFullName()
    {
        return $this->given_name . ' ' . $this->family_name;
    }
}