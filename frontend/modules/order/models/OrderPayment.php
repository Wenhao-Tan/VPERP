<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/1/17
 * Time: 7:10
 */

namespace frontend\modules\order\models;


use yii\db\ActiveRecord;

class OrderPayment extends ActiveRecord
{
    public $full_payment;

    public function rules()
    {
        return [
            [['payment_processor', 'bank_code', 'bank_account', 'remark', 'full_payment'], 'safe'],
            ['type', 'required', 'when' => function ($model) {
                return $model->full_payment != 0;
            }, 'whenClient' => "function (attribute, value) {
                return $('input[name=\"OrderPayment[full_payment]\"]:checked').val() != 1;
            }"],
            [['payment_id', 'order_id', 'payment_date', 'currency', 'amount', 'payment_method'], 'required',],
            [['payment_id', 'order_id', 'payment_date', 'currency', 'amount',
                    'payment_method', 'payment_processor',
                    'bank_code', 'bank_account', 'remark'], 'filter', 'filter'=>'trim'],
            [['amount'], 'double',]
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

            $order->status = $this->type;

            if ($this->type == 'Deposit') {
                $order->status = 'Deposit Paid';
            } elseif ($this->type == 'Balance') {
                $order->status = 'Partial Payment';
            }

            if ($this->full_payment) {
                $order->status = 'Full Payment';
            }

            $order->update(false);
        }

    }
}