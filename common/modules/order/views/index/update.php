<?php
use yii\helpers\Html;

$this->title = Yii::t('order', 'Update {modelClass}: ', [
        'modelClass' => 'Order',
    ]) . $model->order_id;
?>

<div class="order-update col-xs-12">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
