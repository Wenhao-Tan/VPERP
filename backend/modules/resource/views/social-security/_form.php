<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\modules\resource\Module;
/* @var $this yii\web\View */
/* @var $model backend\modules\resource\models\SocialSecurity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="social-security-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'month')->textInput() ?>

    <?= $form->field($model, 'base_value')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'pension_c')->textInput(['maxlength' => true])->label('Pension (Company %)') ?>
            <?= $form->field($model, 'medical_c')->textInput(['maxlength' => true])->label('Medical (Company %)') ?>
            <?= $form->field($model, 'critical_illness_c')->textInput(['maxlength' => true])->label('Critical Illness (Company ￥)') ?>
            <?= $form->field($model, 'employment_injury_c')->textInput(['maxlength' => true])->label('Employment Injury (Company %)') ?>
            <?= $form->field($model, 'maternity_c')->textInput(['maxlength' => true])->label('Maternity (Company %)') ?>
            <?= $form->field($model, 'unemployment_c')->textInput(['maxlength' => true])->label('Unemployment (Company %)') ?>
        </div>

        <div class="col-sm-6 cox-xs-12">
            <?= $form->field($model, 'pension_p')->textInput(['maxlength' => true])->label('Pension (Personal %)') ?>
            <?= $form->field($model, 'medical_p')->textInput(['maxlength' => true])->label('Medical (Personal %)') ?>
            <?= $form->field($model, 'critical_illness_p')->textInput(['maxlength' => true])->label('Critical Illness (Personal ￥)') ?>
            <?= $form->field($model, 'employment_injury_p')->textInput(['maxlength' => true])->label('Employment Injury (Personal %)') ?>
            <?= $form->field($model, 'maternity_p')->textInput(['maxlength' => true])->label('Maternity (Personal %)') ?>
            <?= $form->field($model, 'unemployment_p')->textInput(['maxlength' => true])->label('Unemployment (Personal %)') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('socialSecurity', 'Create') : Yii::t('socialSecurity', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
