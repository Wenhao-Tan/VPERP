<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

if ($scenario == 'create') {
    $formId = 'form-create-staff';
    $submitButton = Html::submitButton('Create Staff', ['class' => 'btn btn-primary']);
} else {
    $formId = 'form-update-staff';
    $submitButton = Html::submitButton('Update Staff', ['class' => 'btn btn-primary']);
}

$form = ActiveForm::begin([
    'id' => $formId,
]);

$gender = [
    'Male' => 'Male',
    'Female' => 'Female',
];
?>

<div class="general_info">
    <h2><?= Yii::t('app', 'General Information')?></h2>
    <div class="row">
        <?= $form->field($model, 'idCardNumber', ['options' => ['class' => 'col-sm-6']]); ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'familyName', ['options' => ['class' => 'col-sm-3']]); ?>
        <?= $form->field($model, 'familyNameZh', ['options' => ['class' => 'col-sm-3']]); ?>
        <?= $form->field($model, 'givenName', ['options' => ['class' => 'col-sm-3']]); ?>
        <?= $form->field($model, 'givenNameZh', ['options' => ['class' => 'col-sm-3']]); ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'gender', ['options' => ['class' => 'col-sm-3']])->dropDownList($gender, ['prompt' => '']); ?>
        <?= $form->field($model, 'education', ['options' => ['class' => 'col-sm-3']]); ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'mobilePhone', ['options' => ['class' => 'col-sm-3']]); ?>
        <?= $form->field($model, 'otherPhone', ['options' => ['class' => 'col-sm-3']]); ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'address', ['options' => ['class' => 'col-sm-6']]) ?>
    </div>
    <hr>
    <h2><?= Yii::t('app', 'Job Information') ?></h2>
    <div class="row">
        <?= $form->field($model, 'englishName', ['options' => ['class' => 'col-sm-3']]); ?>
        <?= $form->field($model, 'email', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'entryDate', ['options' => ['class' => 'col-sm-3']]); ?>
        <?= $form->field($model, 'department', ['options' => ['class' => 'col-sm-3']]); ?>
        <?= $form->field($model, 'position', ['options' => ['class' => 'col-sm-3']]); ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'basicSalary', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'salaryCardNumber', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'salaryCardBank', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'salaryCardBranch', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'resignDate', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>
    <hr>
    <div class="form-group">
        <?= $submitButton ?>
    </div>
</div>

<?php ActiveForm::end() ?>
