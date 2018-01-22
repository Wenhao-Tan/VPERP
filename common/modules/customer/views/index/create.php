<?php
$this->title = Yii::t('customer', 'New Customer');
?>

<?php
echo $this->render('_form', [
        'model' => $model,
]);
?>
