<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\modules\staff\models\StaffJobInfo;
use backend\modules\user\models\UserAssigned;
use common\models\Currency;
use common\modules\order\Module;
use common\modules\general\models\PaymentMethod;
use common\modules\customer\models\Customer;

// Get Current User
$user = Yii::$app->getUser();
$staffId = UserAssigned::getCurrentStaffId();


// Get customers of the sales representative
$customersList = Customer::getCustomers();

// Get a list of User for admin
$salesReps = StaffJobInfo::find()
    ->select('english_name')
    ->where(['department' => ['Sales', 'Management']])
    ->indexBy('staff_id')
    ->column();
foreach ($salesReps as $id => $name) {
    $salesReps[$id] = $id . ' - ' . $name;
}

$incoterm = [
    'FOB' => 'FOB',
    'CFR' => 'CFR',
    'CIF' => 'CIF',
    'EXW' => 'EXW',
];
?>
<div class="order-form">
    <?php
    if ($model->scenario == 'update') {
        $form = ActiveForm::begin([]);
    } else {
        $form = ActiveForm::begin(['action' => ['create-items']]);
    }
    ?>

    <div class="row">
        <?= $form->field($model, 'order_id', ['options' => ['class' => 'col-sm-4']])
            ->textInput()
            ->input('order_id', ['placeholder' => Yii::t('order', 'Generate Automatically'), 'readonly' => true]) ?>

        <?= $form->field($model, 'order_date', ['options' => ['class' => 'col-sm-4 form-group']])
            ->widget(DatePicker::className(), [
                'type' => DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => 'Choose Order Date ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
            ])
        ?>

        <?= $form->field($model, 'customer_id', [
            'options' => ['class' => 'col-sm-4 form-group'],
            'template' => '{label}' . Html::tag('div', '', ['class' => 'clearfix']) . '{input}'.
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/customer/index/create/'], ['class' => 'btn btn-success pull-right', 'target' => '_blank']) .
                Html::tag('div', '', ['class' => 'clearfix'])
                . '{hint}{error}',])
            ->dropDownList($customersList,['prompt' => '','class' => 'form-control pull-left'])
        ?>

        <?php
        if ($user->can('admin')) {
            echo $form->field($model, 'sales_representative', ['options' => ['class' => 'col-sm-4 form-group']])
                ->dropDownList($salesReps, ['prompt' => '']);
        } else {
            echo $form->field($model, 'sales_representative')->hiddenInput(['value' => $staffId])->label(false);
        }
        ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'billing_address', ['options' => ['class' => 'col-sm-8 form-group']])
            ->dropDownList([], ['prompt' => '', 'class' => 'form-control address', 'data-url' => \yii\helpers\Url::toRoute(['/customer/address/get-address'])]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'shipping_address', ['options' => ['class' => 'col-sm-8 form-group']])
            ->dropDownList([], ['prompt' => '', 'class' => 'form-control address', 'data-url' => \yii\helpers\Url::toRoute(['/customer/address/get-address'])]) ?>
    </div>

    <hr />

    <div class="row">
        <?= $form->field($model, 'payment_method', ['options' => ['class' => 'col-sm-5 form-group']])
            ->dropDownList(ArrayHelper::map(PaymentMethod::find()->all(), 'payment_method', 'payment_method')) ?>
        <?= $form->field($model, 'reference_id', ['options' => ['class' => 'col-sm-4 form-group']]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'currency', ['options' => ['class' => 'col-sm-3 form-group']])
            ->dropDownList(ArrayHelper::map(Currency::find()->where(['status' => 1])->all(), 'code', 'code'), ['prompt' => '']) ?>
        <?= $form->field($model, 'order_amount', ['options' => ['class' => 'col-sm-3 form-group']]) ?>
        <?= $form->field($model, 'shipping_charges', ['options' => ['class' => 'col-sm-3 form-group']]) ?>
    </div>

    <?php // Only Admin can see and set the "Commission Rate" ?>
    <?php if (Yii::$app->user->can('admin')) : ?>
        <div class="row">
            <?php if ($model->commission_rate == null) : ?>
                <?php $model->commission_rate = 5 ?>
                <?= $form->field($model, 'commission_rate', ['options' => ['class' => 'col-sm-4 form-group']]) ?>
            <?php endif ?>
        </div>
    <?php endif ?>

    <hr />

    <div class="row">
        <?= $form->field($model, 'custom_declaration', ['options' => ['class' => 'col-sm-3 form-group']])
            ->inline(true)
            ->radioList(['0' => Module::t('order', 'No'), '1' => Module::t('order', 'Yes')]) ?>
        <?= $form->field($model, 'declaration_value', ['options' => ['class' => 'col-sm-3 form-group']]) ?>
        <?= $form->field($model, 'incoterm', ['options' => ['class' => 'col-sm-2 form-group']])
            ->dropDownList($incoterm) ?>
    </div>

    <hr />

    <?php if ($model->scenario != 'update') : ?>
        <div class="row">
            <?= $form->field($model, 'excelFile', ['options' => ['class' => 'col-sm-3 form-group']])->fileInput() ?>
            <div class="col-sm-3 form-group">
                <br />
                <?= Html::a(Yii::t('order', 'Download'), ['download'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
        <hr />
    <?php endif; ?>

    <div class="row">
        <?= $form->field($model, 'remark', ['options' => ['class' => 'col-sm-8 form-group']])->textarea() ?>
    </div>

    <div class="form-group text-center">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>



<script type="text/javascript">
    var paymentMethod = $('#orderform-paymentmethod');

    var bankField = $('.field-orderform-bankcode');
    var bank = $('#orderform-bankcode');

    paymentMethod.change('change', function(){
        var method = paymentMethod.val();

        if (method !== 'TT' && method !== 'TT-P') {
            bankField.css('display', 'none');
            bank.prop('disabled', true);
        } else {
            bank.prop('disabled', false);
            bankField.css('display', 'block')
        }
    });
</script>