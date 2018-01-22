<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use common\modules\customer\models\Customer;

use yii\helpers\Url;

$this->title = Yii::t('order', 'Create Invoice');

?>

<?php $form = ActiveForm::begin() ?>
    <div class="row">
        
    </div>

    <div>
        <div class="form-group">
            <?= Html::button('Load Customer', ['id' => 'btn-display-customers', 'class' => 'btn btn-primary']) ?>
            <?= Html::button('Create Customer', ['class' => 'btn btn-primary']) ?>
        </div>

        <div id="customers-selection" class="row" style="display: none;">
            <div class="form-group col-sm-3">
                <?= Html::dropDownList('customers', '', Customer::getCustomers(), ['prompt' => '', 'id' => 'customers-list', 'class' => 'form-control']) ?>
                <?= Html::button('Load', ['id' => 'btn-load-customer', 'class' => 'btn btn-primary', 'data-url' => Url::to(['/customer/index/get-customer'])]) ?>
            </div>
        </div>
    </div>

    <div style="display: block;">
        <div class="row">
            <?= $form->field($shippingAddress, 'customer_id', ['options' => ['class' => 'form-group col-sm-2']]) ?>
        </div>

        <div class="row">
            <?= $form->field($shippingAddress, 'name', ['options' => ['class' => 'form-group col-sm-2']])->label('Receiver\'s Name') ?>
            <?= $form->field($shippingAddress, 'company_name', ['options' => ['class' => 'form-group col-sm-2']])->label('Company Name') ?>
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