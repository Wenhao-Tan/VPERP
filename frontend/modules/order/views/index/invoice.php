<?php
use common\modules\customer\models\Address;
use kartik\grid\GridView;

$shippingAddress = Address::get($order->shipping_address)->format(true)->generate();
?>

<div class="title text-center">
    <h2>Proforma Invoice</h2>
    <p class="order-id">Invoice No.: <?= $order->order_id ?></p>
</div>

<div class="order-date text-right">
    <p>Date: <?= $order->order_date ?></p>
</div>

<div class="buyer-info">
    <h4>Buyer Info</h4>
    <div class="col-sm-12">
        <?= $shippingAddress ?>
    </div>
</div>

<hr />

<div class="order-items">
    <?php
    echo $this->render('view/items',[
            'order' => $order,
    ])
    ?>
</div>