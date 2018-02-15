<?php

use kartik\form\ActiveForm;

$address = new \common\modules\customer\models\Address();
$customerAddress = new \common\modules\customer\models\CustomerAddress();
$customerAddress->customer_id = $_GET['id'];
?>

<?php $form = ActiveForm::begin([
    'action' => ['address/create'],
]) ?>

    <div id="address">
        <h2><?= Yii::t('customer', 'Create Address') ?></h2>

        <hr>

        <div class="row">
            <?= $form->field($address, 'name', ['options' => ['class' => 'form-group col-sm-2']])->label('Receiver\'s Name') ?>
            <?= $form->field($address, 'company', ['options' => ['class' => 'form-group col-sm-2']])->label('Company Name') ?>
        </div>

        <div class="row">
            <?= $form->field($address, 'street_1', ['options' => ['class' => 'form-group col-sm-4']]) ?>
        </div>
        <div class="row">
            <?= $form->field($address, 'street_2', ['options' => ['class' => 'form-group col-sm-4']]) ?>
        </div>

        <div class="row">
            <?= $form->field($address, 'city', ['options' => ['class' => 'form-group col-sm-2']]) ?>
            <?= $form->field($address, 'state', ['options' => ['class' => 'form-group col-sm-2']]) ?>
            <?= $form->field($address, 'country', ['options' => ['class' => 'form-group col-sm-2']])
                ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Country::find()->all(), 'country_name', 'country_name'), ['prompt' => '']);
            ?>
            <?= $form->field($address, 'zip_code', ['options' => ['class' => 'form-group col-sm-2']]) ?>
        </div>

        <div class="row">
            <?= $form->field($address, 'mobile_phone', ['options' => ['class' => 'form-group col-sm-3']]) ?>
        </div>
        <div class="row">
            <?= $form->field($address, 'other_phone', ['options' => ['class' => 'form-group col-sm-3']]) ?>
        </div>

        <div class="row">
            <?= $form->field($customerAddress, 'customer_id')->hiddenInput()->label(false) ?>
            <?= $form->field($customerAddress, 'is_shipping', ['options' => ['class' => 'form-group col-sm-2']])->checkbox() ?>
            <?= $form->field($customerAddress, 'is_billing', ['options' => ['class' => 'form-group col-sm-2']])->checkbox() ?>
        </div>

        <?= \yii\helpers\Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

    </div>

<?php ActiveForm::end() ?>