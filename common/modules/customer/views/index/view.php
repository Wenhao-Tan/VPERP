<?php
$this->title = Yii::t('customer', 'Customer Details') . ' - ' . $model->getFullName();
?>

<?php
echo $this->render('view/address', [
    'model' => $model,
]);
?>

