<?php
use common\modules\staff\models\StaffGeneralInfo;
use common\modules\staff\models\StaffJobInfo;
use common\modules\staff\models\Salary;
use backend\modules\resource\models\SocialSecurity;

use yii\bootstrap\Html;
use kartik\form\ActiveForm;

\common\modules\staff\assets\StaffAsset::register($this);

$this->title = Yii::t('human_resources', 'Add Multiple Salaries');

$staffIds = StaffGeneralInfo::find()->indexBy('staff_id')->column();
?>

<?php $form = ActiveForm::begin([]) ?>
<?php
$timestamp = strtotime('now');
$lastMonth = date('Y-m-01', strtotime(date('Y', $timestamp) . '-' . (date('m', $timestamp) - 1)));

$month = '2017-04-01';
?>


<div class="form-group">
    <label for="month">Month</label>
    <input type="text" id="month" name="month" class="form-control" value="<?= $lastMonth ?>" readonly />
</div>


<table class="table salary">
    <thead>
    <tr>
        <th>Staff ID</th>
        <th>Name</th>
        <th>Days</th>
        <th>Basic Salary</th>
        <th>Commission</th>
        <th>Deduction</th>
        <th>Pension</th>
        <th>Medical</th>
        <th>Critical Illness</th>
        <th>Employment Injury</th>
        <th>Maternity</th>
        <th>Unemployment</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($salaries as $staffId => $salary) : ?>
        <?php
        $generalInfo = new StaffGeneralInfo();
        $fullName = $generalInfo->getFullName($staffId);

        $working_days = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($month)), date('Y', strtotime($month)));
        $salary->working_days = $working_days;

        $jobInfo = new StaffJobInfo();
        $basicSalary = $jobInfo->getBasicSalary($staffId);

        $commission = Salary::getCommission($staffId);
        $salary->commission = $commission;

        $deduction = Salary::getDeduction($staffId);
        $salary->deduction = $deduction;

        $socialSecurity = new SocialSecurity();
        $salary->pension = $socialSecurity->getInsuranceCharges('personal', $staffId, 'pension', 'last_month');
        $salary->medical = $socialSecurity->getInsuranceCharges('personal', $staffId, 'medical', 'last_month');
        $salary->critical_illness = $socialSecurity->getInsuranceCharges('personal', $staffId, 'critical_illness', 'last_month');
        $salary->employment_injury = $socialSecurity->getInsuranceCharges('personal', $staffId, 'employment_injury', 'last_month');
        $salary->maternity = $socialSecurity->getInsuranceCharges('personal', $staffId, 'maternity', 'last_month');
        $salary->unemployment = $socialSecurity->getInsuranceCharges('personal', $staffId, 'unemployment', 'last_month');
        ?>
        <tr>
            <td><?= $form->field($salary, "[$staffId]staff_id")->textInput(['value' => $staffId, 'readonly' => true])->label(false) ?></td>
            <td><input type="text" value="<?= $fullName ?>" readonly /></td>
            <td><?= $form->field($salary, "[$staffId]working_days")->label(false) ?></td>
            <td><?= $form->field($salary, "[$staffId]basic_salary")->textInput(['value' => $basicSalary, 'readonly' => true])->label(false) ?></td>
            <td><?= $form->field($salary, "[$staffId]commission")->label(false) ?></td>
            <td><?= $form->field($salary, "[$staffId]deduction")->label(false) ?></td>
            <td><?= $form->field($salary, "[$staffId]pension")->label(false) ?></td>
            <td><?= $form->field($salary, "[$staffId]medical")->label(false) ?></td>
            <td><?= $form->field($salary, "[$staffId]critical_illness")->label(false) ?></td>
            <td><?= $form->field($salary, "[$staffId]employment_injury")->label(false) ?></td>
            <td><?= $form->field($salary, "[$staffId]maternity")->label(false) ?></td>
            <td><?= $form->field($salary, "[$staffId]unemployment")->label(false) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>

<?php

if ($month == '') {
    $month = self::getLastMonth();
}

$orderShipping = \common\modules\order\models\OrderShipping::find()
    ->select('*, MAX(`order_shipping`.`shipping_date`) AS latest_shipping_date')
    ->groupBy('`order_shipping`.`order_id`');

$orders = \common\modules\order\models\Order::find()
    ->joinWith('orderPayments')
    ->leftJoin(['os' => $orderShipping], '`os`.`order_id` = `order`.`order_id`')
    ->where([
        'sales_representative' => '1001',
        'status' => 'Shipped',
        'DATE_FORMAT(latest_shipping_date,"%Y-%m")' => '2018-02'])
    ->orderBy('`order`.`order_date` DESC')
    ->asArray()
    ->all();

// Calculate Commission
$commission = 0;
foreach ($orders as $order) {
    echo $order['order_id'] . ' ';

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

        echo $orderPayment['amount'] . ' ';
    }

    echo '<br />';
    $commission += $subTotal * $rate;
}

return round($commission,2);


?>