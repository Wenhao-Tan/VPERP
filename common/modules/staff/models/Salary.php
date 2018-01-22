<?php

namespace common\modules\staff\models;

use Yii;
use common\modules\order\models\Order;
use common\modules\order\models\OrderShipping;
use frontend\modules\retail\models\OrderException;

/**
 * This is the models class for table "salary".
 *
 * @property string $salary_id
 * @property integer $staff_id
 * @property string $month
 * @property integer $working_days
 * @property string $basic_salary
 * @property string $commission
 * @property string $total_salary
 * @property string $medical_insurance
 * @property string $pension
 * @property string $unemployment_insurance
 * @property string $net_pay
 */
class Salary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hr_salary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['staff_id', 'basic_salary'], 'required'],
            [['working_days'], 'integer'],
            [['commission', 'deduction', 'pension', 'medical', 'critical_illness', 'employment_injury',
                'maternity', 'unemployment'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'salary_id' => Yii::t('human_resourcess', 'Salary ID'),
            'staff_id' => Yii::t('human_resourcess', 'Staff ID'),
            'month' => Yii::t('human_resourcess', 'Month'),
            'working_days' => Yii::t('human_resources', 'Working Days'),
            'basic_salary' => Yii::t('human_resources', 'Basic Salary'),
            'commission' => Yii::t('human_resources', 'Commission'),
            'total_salary' => Yii::t('human_resources', 'Total Salary'),
            'deduction' => Yii::t('human_resources', 'Deduction'),
            'medical' => Yii::t('human_resources', 'Medical'),
            'pension' => Yii::t('human_resources', 'Pension'),
            'unemployment' => Yii::t('human_resources', 'Unemployment'),
            'net_pay' => Yii::t('human_resources', 'Net Pay'),
        ];
    }

    public function submit()
    {
        $salary = new Salary();

        $salary->salary_id = str_replace('-', '', $this->month) . $this->staff_id;

        $salary->total_salary = $this->basic_salary + $this->commission;

        $socialSecurity = $this->medical_insurance + $this->pension + $this->unemployment_insurance;
        $salary->net_pay = $salary->total_salary - $socialSecurity;

        $salary->save();
    }

    public static function getLastMonth()
    {
        $timestamp = strtotime('now');
        $lastMonth = date('Y-m', strtotime(date('Y', $timestamp) . '-' . (date('m', $timestamp) - 1)));

        return $lastMonth;
    }

    public static function getCommission($staffId, $month = '')
    {
        if ($month == '') {
            $month = self::getLastMonth();
        }

        $orderShipping = OrderShipping::find()
            ->select('*, MAX(`order_shipping`.`shipping_date`) AS latest_shipping_date')
            ->groupBy('`order_shipping`.`order_id`');

        $orders = Order::find()
            ->joinWith('orderPayments')
            ->leftJoin(['os' => $orderShipping], '`os`.`order_id` = `order`.`order_id`')
            ->where([
                'sales_representative' => $staffId,
                'status' => 'Shipped',
                'DATE_FORMAT(latest_shipping_date,"%Y-%m")' => $month])
            ->orderBy('`order`.`order_date` DESC')
            ->asArray()
            ->all();
        

        // Calculate Commission
        $commission = 0;
        foreach ($orders as $order) {
            if (!$order['commission_rate']) {
                $rate = 5 / 100;
            } else {
                $rate = $order['commission_rate'] / 100;
            }

            $subTotal = 0;
            foreach ($order['orderPayments'] as $orderPayment) {
                $amount = 0;
                if ($orderPayment['currency'] == 'CNY') {
                    $amount = $orderPayment['amount'];
                } else {
                    if ($orderPayment['currency'] == 'USD') {
                        $amount = $orderPayment['amount'] * 6;
                    } else if ($orderPayment['currency'] == 'EUR') {
                        $amount = $orderPayment['amount'] * 6.5;
                    }
                }
                $subTotal += $amount;
            }
            $commission += $subTotal * $rate;
        }

        return round($commission,2);
    }

    public static function getDeduction($staffId, $month = '')
    {
        if ($month == '') {
            $month = self::getLastMonth() . '-01';
        }

        $ordersInException = OrderException::find()
            ->where(['staff' => $staffId, 'penalty_month' => $month])
            ->asArray()
            ->all();

        // return $ordersInException;

        $totalDeduction = 0;
        foreach ($ordersInException as $order) {
            $totalDeduction += $order['penalty_amount'];
        }

        return $totalDeduction * 6;
    }
}
