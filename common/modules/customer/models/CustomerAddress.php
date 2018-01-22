<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2018/1/7
 * Time: 20:46
 */

namespace common\modules\customer\models;


use yii\db\ActiveRecord;

class CustomerAddress extends ActiveRecord
{
    public function rules()
    {
        return [
            [['customer_id', 'address_id', 'created_date_time'], 'safe'],
            [['is_shipping', 'is_billing'], 'boolean'],
        ];
    }

    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['id' => 'address_id']);
    }

}