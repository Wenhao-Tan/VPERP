<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/1/17
 * Time: 7:10
 */

namespace common\modules\order\models;


use yii\db\ActiveRecord;

class OrderPayment extends ActiveRecord
{
    public function rules()
    {
        return [
            [
                ['payment_processor', 'bank_code', 'bank_account', 'remark'], 'safe'
            ],
            [
                ['payment_id', 'order_id', 'payment_date', 'currency', 'amount', 'payment_method'], 'required',
            ],
            [
                ['payment_id', 'order_id', 'payment_date', 'currency', 'amount',
                    'payment_method', 'payment_processor',
                    'bank_code', 'bank_account', 'remark'], 'filter', 'filter'=>'trim'
            ],
            [
                ['amount'], 'double',
            ]
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_id' => 'order_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            $order = Order::findOne(['order_id' => $this->order_id]);
            $order->status = 'Paid';
            $order->update(false);
        }

    }
}