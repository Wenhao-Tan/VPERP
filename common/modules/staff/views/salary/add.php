<?php
use common\modules\staff\models\StaffJobInfo;
use common\modules\order\models\Order;
use common\modules\order\models\OrderShipping;

$timestamp = strtotime('now');
$lastMonth = date('Y-m',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)-1)));
$days = date('t', strtotime($lastMonth));

if (isset($_GET['staffId'])) {
    $staffId = $_GET['staffId'];

    // Get Basic Salary
    $jobInfo = StaffJobInfo::findOne(['staff_id' => $staffId]);
    $basicSalary = $jobInfo->basic_salary;

    $orderShipping = OrderShipping::find()
        ->select('*, MAX(`order_shipping`.`shipping_date`) AS latest_shipping_date')
        ->groupBy('`order_shipping`.`order_id`');

    $orders = Order::find()
        ->joinWith('orderPayments')
        ->leftJoin(['os' => $orderShipping], '`os`.`order_id` = `order`.`order_id`')
        ->where([
            'sales_representative' => $staffId,
            'status' => 'Shipped',
            'DATE_FORMAT(latest_shipping_date,"%Y-%m")' => $lastMonth ])
        ->orderBy('`order`.`order_date` DESC')
        ->asArray()
        ->all();

    // Calculate Commission
    $commission = 0;
    $totalCommission = 0;
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

    $model->staff_id = $staffId;
    $model->month = date('Y-m-01', strtotime($lastMonth));
    $model->working_days = $days;
    $model->basic_salary = $basicSalary;
    $model->commission = $commission;
}
?>

<div class="form-add-salary">
    <div class="col-sm-12">
        <h3>Add Salary</h3>

        <hr />

        <?php
        echo $this->render('_form', [
            'models' => $model,
            'action' => $action,
        ]);
        ?>
    </div>
</div>
