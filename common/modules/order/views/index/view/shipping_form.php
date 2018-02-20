<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

use common\models\ShippingMethod;
use kartik\date\DatePicker;

$model = new \common\modules\order\models\OrderShipping();
$model->order_id = $_GET['orderId'];

$methods = ShippingMethod::find()->select('description')->indexBy('method')->column();
?>

<?php $form = ActiveForm::begin([
    'action' => ['shipping/create'],
]) ?>

<div class="row">
    <?= $form->field($model, 'shipping_id', ['options' => ['class' => 'col-sm-3']])
        ->textInput()
        ->input('shippingId', ['placeholder' => Yii::t('app', 'Leave empty to generate automatically')])
    ?>
    <?= $form->field($model, 'order_id', ['options' => ['class' => 'col-sm-3']])
        ->textInput(['readonly' => true]) ?>
    <?= $form->field($model, 'shipping_date', ['options' => ['class' => 'col-sm-3']])
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
    <?= $form->field($model, 'package_weight', ['options' => ['class' => 'col-sm-3']])
        ->label(Yii::t('app', 'Package Weight (KG)')) ?>
    <?= $form->field($model, 'package_volume', ['options' => ['class' => 'col-sm-3']]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'shipping_method', ['options' => ['class' => 'col-sm-3']])
        ->dropDownList($methods, ['prompt' => '']) ?>
    <?= $form->field($model, 'shipping_carrier', ['options' => ['class' => 'col-sm-3']])
        ->dropDownList([]) ?>
    <?= $form->field($model, 'shipping_agent', ['options' => ['class' => 'col-sm-3']]) ?>
    <?= $form->field($model, 'shipping_cost', ['options' => ['class' => 'col-sm-3']])
        ->label(Yii::t('app', 'Shipping Cost (￥)'))
    ?>
</div>

<div class="row">
    <?= $form->field($model, 'tracking', ['options' => ['class' => 'col-sm-3']]) ?>
</div>

<?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'id' => 'submit-shipping']) ?>
<?php ActiveForm::end() ?>

<script type="text/javascript">
    //Change the Options of shipping method, and Update Carrier Option
    var shippingMethod = $('#ordershipping-shipping_method');
    var shippingCarrier = $('#ordershipping-shipping_carrier');

    function getCarrier() {
        $.ajax({
            url: '../shipping/get-carrier',
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