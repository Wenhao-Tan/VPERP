<?php
$this->title = Yii::t('customer', 'Customer Details') . ' - ' . $model->getFullName($_GET['id']);
?>

<?php
echo $this->render('view/address', [
    'model' => $model,
]);
?>

