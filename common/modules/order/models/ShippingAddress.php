<?php
namespace common\modules\order\models;


use yii\db\ActiveRecord;

class ShippingAddress extends ActiveRecord
{
    public static function tableName()
    {
        return 'order_shipping_address';
    }

    public function rules()
    {
        return [
            [['street_address_1', 'city', 'country'], 'required'],
        ];
    }
}