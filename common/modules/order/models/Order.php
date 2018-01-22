<?php

namespace common\modules\order\models;

use common\modules\customer\models\Customer;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property string $order_id
 * @property string $order_date
 * @property string $sales_representative
 * @property string $customer_id
 * @property string $customer_name
 * @property string $payment_method
 * @property string $currency
 * @property string $order_amount
 * @property string $shipping_charges
 * @property double $commission_rate
 * @property string $incoterm
 * @property integer $custom_declaration
 * @property double $declaration_value
 * @property string $remark
 * @property string $status
 */
class Order extends ActiveRecord
{
    public $full_name;
    public $excelFile;
    public $excelFilePath;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE_ITEMS= 'create_items';
    const SCENARIO_SUBMIT = 'submit';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'order_date'], 'trim'],
            [['order_date', 'sales_representative', 'customer_id',
                'currency', 'order_amount', 'shipping_charges',
                'custom_declaration'], 'required'],
            [['order_amount', 'shipping_charges', 'commission_rate', 'declaration_value'], 'number'],
            [['custom_declaration'], 'integer'],
            ['declaration_value', 'required', 'when' => function () {
                return $this->custom_declaration == 1;
            }, 'whenClient' => "function () {
                return $('input[name=\"Order[custom_declaration]\"]:checked').val() == 1;
            }"],
            [['remark'], 'string'],
            [['order_id', 'customer_id'], 'string', 'max' => 20],
            [['sales_representative'], 'string', 'max' => 10],
            [['customer_name'], 'string', 'max' => 100],
            [['currency'], 'string', 'max' => 50],
            [['payment_method'], 'string', 'max' => 255],
            [['incoterm'], 'string', 'max' => 3],
            [['status'], 'string', 'max' => 40],
            [['order_id'], 'unique'],
            [['excelFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx', 'on' => self::SCENARIO_CREATE],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_UPDATE] = [
            'order_id', 'order_date', 'sales_representative', 'customer_id',
            'payment_method', 'currency', 'order_amount', 'shipping_charges', 'commission rate',
            'custom_declaration', 'declaration_value', 'incoterm',
            'remark'
        ];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('order', 'Order ID'),
            'order_date' => Yii::t('order', 'Order Date'),
            'sales_representative' => Yii::t('order', 'Sales Representative'),
            'customer_id' => Yii::t('order', 'Customer ID'),
            'customer_name' => Yii::t('order', 'Client Name'),
            'payment_method' => Yii::t('order', 'Payment Method'),
            'currency' => Yii::t('order', 'Currency'),
            'order_amount' => Yii::t('order', 'Order Amount'),
            'shipping_charges' => Yii::t('order', 'Shipping Charges'),
            'commission_rate' => Yii::t('order', 'Commission Rate'),
            'incoterm' => Yii::t('order', 'Incoterm'),
            'custom_declaration' => Yii::t('order', 'Custom Declaration'),
            'declaration_value' => Yii::t('order', 'Declaration Value'),
            'remark' => Yii::t('order', 'Remark'),
            'status' => Yii::t('order', 'Status'),
        ];
    }

    public function upload()
    {
        $fileName = date('YmdHis');
        if ($this->validate()) {
            $filePath = 'uploads/' . $fileName . '.' . $this->excelFile->extension;
            if ($this->excelFile->saveAs($filePath)){
                $this->excelFilePath = $filePath;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'order_id']);
    }

    public function getOrderPayments()
    {
        return $this->hasMany(OrderPayment::className(), ['order_id' => 'order_id']);
    }

    public function getOrderShipping()
    {
        return $this->hasMany(OrderShipping::className(), ['order_id' => 'order_id']);
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->status = 'Unpaid';
            $this->save();
        }
    }
}
