<?php
use yii\bootstrap\Html;
use kartik\form\ActiveForm;

if ($action == 'add') {
    $formId = 'form-add-salary';
    $submitButton = Html::submitButton('Add Salary', ['class' => 'btn btn-primary']);
}
?>

<div class="form-add-salary">
    <?php $form = ActiveForm::begin([
        'id' => $formId,
    ]) ?>

    <div class="row">
        <?= $form->field($model, 'staffId', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'month', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'workingDays', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'basicSalary', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'commission', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'medicalInsurance', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'pension', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'unemploymentInsurance', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>

    <?= $submitButton ?>

    <?php ActiveForm::end() ?>
</div>