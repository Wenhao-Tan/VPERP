<?php
$this->title = Yii::t('customer', 'Update {modelClass}: ', [
        'modelClass' => 'Customer'
    ]) . $model->id;
?>

<div class="customer-update col-xs-12">

    <h1><?= $this->title ?></h1>
    <hr />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>