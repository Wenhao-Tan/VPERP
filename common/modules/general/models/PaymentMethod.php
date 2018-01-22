<?php

namespace common\modules\general\models;

use Yii;

/**
 * This is the models class for table "payment_method".
 *
 * @property integer $id
 * @property string $code
 * @property string $payment_method
 * @property string $description
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'payment_method'], 'required'],
            [['description'], 'string'],
            [['code'], 'string', 'max' => 5],
            [['payment_method'], 'string', 'max' => 50],
            [['code'], 'unique'],
            [['payment_method'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'payment_method' => 'Payment Method',
            'description' => 'Description',
        ];
    }
}
