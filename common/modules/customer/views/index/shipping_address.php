<?php

use kartik\form\ActiveForm;

?>

<?php $form = ActiveForm::begin() ?>

    <div id="shipping-address">
        <h2>Shipping Address</h2>

        <hr>

        <div class="row">
            <?= $form->field($shippingAddress, 'name', ['options' => ['class' => 'form-group col-sm-2']])->label('Receiver\'s Name') ?>
            <?= $form->field($shippingAddress, 'company', ['options' => ['class' => 'form-group col-sm-2']])->label('Company Name') ?>
        </div>

        <div class="row">
            <?= $form->field($shippingAddress, 'street_address_1', ['options' => ['class' => 'form-group col-sm-4']]) ?>
        </div>
        <div class="row">
            <?= $form->field($shippingAddress, 'street_address_2', ['options' => ['class' => 'form-group col-sm-4']]) ?>
        </div>

        <div class="row">
            <?= $form->field($shippingAddress, 'city', ['options' => ['class' => 'form-group col-sm-2']]) ?>
            <?= $form->field($shippingAddress, 'state', ['options' => ['class' => 'form-group col-sm-2']]) ?>
            <?= $form->field($shippingAddress, 'country', ['options' => ['class' => 'form-group col-sm-2']])
                ->dropDownList(\common\models\Country::getCountries(), ['prompt' => '']);
            ?>
            <?= $form->field($shippingAddress, 'zip_code', ['options' => ['class' => 'form-group col-sm-2']]) ?>
        </div>

        <div class="row">
            <?= $form->field($shippingAddress, 'mobile_phone', ['options' => ['class' => 'form-group col-sm-3']]) ?>
        </div>
        <div class="row">
            <?= $form->field($shippingAddress, 'other_phone', ['options' => ['class' => 'form-group col-sm-3']]) ?>
        </div>
    </div>

<?php ActiveForm::end() ?>