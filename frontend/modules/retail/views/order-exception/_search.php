<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\retail\models\OrderExceptionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-exception-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'currency') ?>

    <?= $form->field($model, 'order_amount') ?>

    <?= $form->field($model, 'penalty_date') ?>

    <?php // echo $form->field($models, 'staff') ?>

    <?php // echo $form->field($models, 'penalty_amount') ?>

    <?php // echo $form->field($models, 'reason') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('retail', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('retail', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
