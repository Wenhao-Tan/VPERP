<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/1/17
 * Time: 7:17
 */

namespace frontend\modules\order\models;


use yii\db\ActiveRecord;

class OrderShipping extends ActiveRecord
{
    public function rules()
    {
        return [
            [
                ['shipping_id', 'package_weight', 'package_volume', 'remark'], 'safe',
            ],
            [
                ['order_id','shipping_date', 'shipping_method', 'shipping_carrier',
                    'shipping_agent', 'shipping_cost', 'tracking'], 'required',
            ],
            [
                ['shipping_cost'], 'double',
            ],
            [
                ['shipping_id', 'order_id', 'shipping_date', 'package_weight', 'package_volume',
                    'shipping_method', 'shipping_carrier', 'shipping_agent', 'shipping_cost',
                    'tracking', 'remark'], 'filter', 'filter' => 'trim'
            ]
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            $order = Order::findOne(['order_id' => $this->order_id]);
            $order->status = 'Shipped';
            $order->update(false);
        }
    }
}