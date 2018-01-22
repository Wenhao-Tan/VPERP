<?php
$model->order_id = $_GET['orderId'];
?>

<div class="add-payment">
    <h2>Add Payment</h2>
    <hr />

    <?php
    echo $this->render('form', [
        'model' => $model,
    ])
    ?>
</div>
