<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2017/10/25
 * Time: 8:31
 */

$this->title = 'Upload';
?>

<?php $form = \kartik\form\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <button>Submit</button>

<?php \kartik\form\ActiveForm::end() ?>

<?php
$file = './uploads/order.xlsx';

$objPHPExcel = PHPExcel_IOFactory::load($file);
echo $objPHPExcel->getSheetCount();
echo '<br>';
echo gettype($objPHPExcel->getSheetNames());
print_r($objPHPExcel->getSheetNames());