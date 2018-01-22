<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\resource\models\SocialSecuritySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="social-security-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'month') ?>

    <?= $form->field($model, 'base_value') ?>

    <?= $form->field($model, 'pension_c') ?>

    <?= $form->field($model, 'pension_p') ?>

    <?php // echo $form->field($models, 'medical_c') ?>

    <?php // echo $form->field($models, 'medical_p') ?>

    <?php // echo $form->field($models, 'critical_illness_c') ?>

    <?php // echo $form->field($models, 'critical_illness_p') ?>

    <?php // echo $form->field($models, 'employment_injury_c') ?>

    <?php // echo $form->field($models, 'employment_injury_p') ?>

    <?php // echo $form->field($models, 'maternity_c') ?>

    <?php // echo $form->field($models, 'maternity_p') ?>

    <?php // echo $form->field($models, 'unemployment_c') ?>

    <?php // echo $form->field($models, 'unemployment_p') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('socialSecurity', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('socialSecurity', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
