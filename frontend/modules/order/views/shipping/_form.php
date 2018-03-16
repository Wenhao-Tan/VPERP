<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

use common\models\ShippingMethod;
use kartik\date\DatePicker;

$methods = ShippingMethod::find()->select('description')->indexBy('method')->column();
?>

<?php $form = ActiveForm::begin([
    'id' => 'form-order-shipping',
]) ?>

<div class="row">
    <?= $form->field($orderShippingModel, 'shippingId', ['options' => ['class' => 'col-sm-3']])
        ->textInput()
        ->input('shippingId', ['placeholder' => Yii::t('app', 'Leave empty to generate automatically')])
    ?>
    <?= $form->field($orderShippingModel, 'orderId', ['options' => ['class' => 'col-sm-3']])
        ->textInput(['readonly' => true]) ?>
    <?= $form->field($orderShippingModel, 'shippingDate', ['options' => ['class' => 'col-sm-3']])
        ->widget(DatePicker::className(), [
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
            ],
        ])
    ?>
</div>

<div class="row">
    <?= $form->field($orderShippingModel, 'packageWeight', ['options' => ['class' => 'col-sm-3']])
        ->label(Yii::t('app', 'Package Weight (KG)')) ?>
    <?= $form->field($orderShippingModel, 'packageVolume', ['options' => ['class' => 'col-sm-3']]) ?>
</div>

<div class="row">
    <?= $form->field($orderShippingModel, 'shippingMethod', ['options' => ['class' => 'col-sm-3']])
        ->dropDownList($methods, ['prompt' => '']) ?>
    <?= $form->field($orderShippingModel, 'shippingCarrier', ['options' => ['class' => 'col-sm-3']])
        ->dropDownList([]) ?>
    <?= $form->field($orderShippingModel, 'shippingAgent', ['options' => ['class' => 'col-sm-3']]) ?>
    <?= $form->field($orderShippingModel, 'shippingCost', ['options' => ['class' => 'col-sm-3']])
        ->label(Yii::t('app', 'Shipping Cost (￥)'))
    ?>
</div>

<div class="row">
    <?= $form->field($orderShippingModel, 'tracking', ['options' => ['class' => 'col-sm-3']]) ?>
</div>

<?= Html::submitButton('Add Shipping', ['class' => 'btn btn-primary', 'id' => 'submit-shipping']) ?>
<?php ActiveForm::end() ?>

<script type="text/javascript">
    //Change the Options of shipping method, and Update Carrier Option
    var shippingMethod = $('#ordershippingform-shippingmethod');
    var shippingCarrier = $('#ordershippingform-shippingcarrier');

    function getCarrier() {
        $.ajax({
            url: 'get-carrier',
            type: 'POST',
            data: {method: shippingMethod.val()},
            dataType: 'json'
        }).done(function (data) {
            shippingCarrier.find('option').remove();
            $.each(data, function (key, value) {
                shippingCarrier.append('<option value="' + key + '">' + value + '</option>')
            });
        });
    }

    $(document).ready(function () {
        if (shippingMethod.val() !== '') {
            getCarrier();
        }
    });

    shippingMethod.on('change', function () {
        getCarrier();
    });
</script>