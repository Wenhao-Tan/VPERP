<?php

namespace frontend\modules\retail\models;

use Yii;

/**
 * This is the models class for table "retail_order_in_exception".
 *
 * @property integer $id
 * @property string $order_id
 * @property string $currency
 * @property string $order_amount
 * @property string $penalty_date
 * @property string $staff
 * @property string $penalty_amount
 * @property string $reason
 */
class OrderException extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retail_order_in_exception';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'order_amount', 'staff', 'reason',
                'penalty_date', 'penalty_month'], 'required'],
            [['order_amount'], 'number'],
            [['penalty_date'], 'safe'],
            [['order_id'], 'string', 'max' => 20],
            [['currency'], 'string', 'max' => 5],
            [['reason'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('retail', 'ID'),
            'order_id' => Yii::t('retail', 'Order ID'),
            'currency' => Yii::t('retail', 'Currency'),
            'order_amount' => Yii::t('retail', 'Order Amount'),
            'penalty_date' => Yii::t('retail', 'Penalty Date'),
            'staff' => Yii::t('retail', 'Staff'),
            'penalty_amount' => Yii::t('retail', 'Penalty Amount'),
            'reason' => Yii::t('retail', 'Reason'),
            'penalty_month' => Yii::t('retail', 'Penalty Month'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function addOrderException()
    {
        $selectedStaff = $this->staff;

        if ($this->reason == 'neglect_05') {
            $this->penalty_amount = round($this->order_amount * 0.05,2);
        } elseif ($this->reason == 'expiration') {
            $this->penalty_amount = round($this->order_amount * 0.15, 2);
        }

        foreach ($selectedStaff as $id) {
            $this->staff = $id;
            $this->save();
        }

    }
}
