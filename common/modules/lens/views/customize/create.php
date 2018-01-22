<?php
$this->title = Yii::t('lens', 'Customize');
?>

<?php
echo $this->render('_form', [
        'model' => $model,
]);
