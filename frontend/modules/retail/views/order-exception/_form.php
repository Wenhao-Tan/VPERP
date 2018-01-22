<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Currency;

/* @var $this yii\web\View */
/* @var $model frontend\modules\retail\models\OrderException */
/* @var $form yii\widgets\ActiveForm */

$model->reason = [
    'neglect_05' => 'Order neglected more than 5 days',
    'expiration' => 'Order expired',
];

$currency = Currency::find()
    ->select(['code'])
    ->indexBy('code')
    ->where(['status' => 1])
    ->column();

$staff = [
    '1001' => 'Teresa',
    '1005' => 'Julia',
];

if (!$model->penalty_date) {
    $model->penalty_date = date('Y-m-d');
}
?>

<div class="order-exception-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reason')->dropDownList($model->reason) ?>

    <?= $form->field($model, 'currency')->dropDownList($currency, ['options' => ['USD' => ['Selected' => true]]]) ?>

    <?= $form->field($model, 'order_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'staff')->listBox($staff, ['multiple' => 'true']) ?>

    <?= $form->field($model, 'penalty_date')->textInput() ?>

    <?= $form->field($model, 'penalty_month')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('retail', 'Create') : Yii::t('retail', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>