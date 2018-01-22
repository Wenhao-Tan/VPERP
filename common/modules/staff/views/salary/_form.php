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
        <?= $form->field($model, 'staff_id', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'month', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'working_days', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'basic_salary', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'commission', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'medical_insurance', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'pension', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'unemployment_insurance', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>

    <?= $submitButton ?>

    <?php ActiveForm::end() ?>
</div>

