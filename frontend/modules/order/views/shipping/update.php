<?php
$orderShippingModel->shippingId = $orderShipping->shipping_id;
$orderShippingModel->orderId = $orderShipping->order_id;
$orderShippingModel->shippingDate = $orderShipping->shipping_date;
$orderShippingModel->packageWeight = $orderShipping->package_weight;
$orderShippingModel->packageVolume = $orderShipping->package_volume;
$orderShippingModel->shippingMethod = $orderShipping->shipping_method;
$orderShippingModel->shippingCarrier = $orderShipping->shipping_carrier;
$orderShippingModel->shippingAgent = $orderShipping->shipping_agent;
$orderShippingModel->shippingCost = $orderShipping->shipping_cost;
$orderShippingModel->tracking = $orderShipping->tracking;
?>

<div class="update-shipping col-sm-12">
    <h2>Update Shipping</h2>
    <hr />

    <?php
    echo $this->render('form', [
        'orderShippingModel' => $orderShippingModel,
        'orderShipping' => $orderShipping,
    ]);
    ?>

</div>