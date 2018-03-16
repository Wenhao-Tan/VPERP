<?php
use frontend\modules\order\models\Order;
use frontend\modules\order\models\OrderPayment;
?>

<?php
$orders = Order::find()
    ->select('sum(declaration_value) as total_value')
    ->where(['custom_declaration' => '1'])
    ->asArray()
    ->one();

echo 'Total Declaration Value: $' . $orders['total_value'] . '<br />';

$payments = OrderPayment::find()
    ->select('sum(amount) as total_amount')
    ->where(['payment_method' => ['TT', 'Telegraphic Transfer']])
    ->asArray()
    ->one();

echo 'Total Payment Amount: $' . $payments['total_amount'] . '<br />';