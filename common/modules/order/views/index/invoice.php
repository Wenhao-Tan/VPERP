<?php
$customer = $order->customer;

var_dump($customer);
?>

<div class="title text-center">
    <h2>Proforma Invoice</h2>
    <p class="order-id">Invoice No.: <?= $order->order_id ?></p>
</div>

<div class="order-date text-right">
    <p>Date: <?= $order->order_date ?></p>
</div>

<div class="client">
    <h4>Buyer Info</h4>
    <p>Name:</p>
    <p>Address:</p>
    <p>Tel:</p>
</div>

<div class="order-item">

</div>