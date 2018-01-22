<?php
$orderShippingModel->orderId = $_GET['orderId'];
?>

<div class="add-shipping col-sm-12">
    <h2>Add Shipping</h2>
    <hr />

    <?php
    echo $this->render('_form', [
        'orderShippingModel' => $orderShippingModel,
    ])
    ?>
</div>