<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

use common\models\Currency;
use common\modules\general\models\PaymentMethod;

$orderPayment = new \frontend\modules\order\models\OrderPayment();
$orderPayment->order_id = $_GET['orderId'];
?>

<?php $form = ActiveForm::begin([
    'action' => ['payment/create']
]) ?>
    <div class="row">
        <?= $form->field($orderPayment, 'payment_id', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($orderPayment, 'order_id', ['options' => ['class' => 'col-sm-3']])
            ->textInput(['readonly' => true]) ?>
        <?= $form->field($orderPayment, 'payment_date', ['options' => ['class' => 'col-sm-3']])
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
        <?= $form->field($orderPayment, 'currency', ['options' => ['class' => 'col-sm-3']])
            ->dropDownList(ArrayHelper::map(Currency::find()->where(['status' => 1])->all(), 'code', 'code'), ['prompt' => ''])
            ->label(Yii::t('app', 'Currency'))
        ?>
        <?= $form->field($orderPayment, 'amount', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($orderPayment, 'payment_method', ['options' => ['class' => 'col-sm-3']])
            ->dropDownList(ArrayHelper::map(PaymentMethod::find()->all(), 'code', 'payment_method'), ['prompt' => ''])
            ->label(Yii::t('app', 'Payment Method'))
        ?>
        <?= $form->field($orderPayment, 'payment_processor', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>
    <div class="row">
        <?= $form->field($orderPayment, 'bank_code', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($orderPayment, 'bank_account', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>
    <div class="row">
        <?= $form->field($orderPayment, 'remark', ['options' => ['class' => 'col-sm-6']])->textarea() ?>
    </div>

    <div class="row">
        <?= $form->field($orderPayment, 'type', ['options' => ['class' => 'col-sm-3']])
            ->inline(true)
            ->radioList(['Deposit' => 'Deposit', 'Balance' => 'Balance'], ['unselect' => null])
            ->label(false) ?>
    </div>
    <div class="row">
        <?= $form->field($orderPayment, 'full_payment', ['options' => ['class' => 'col-sm-3']])
            ->inline(true)
            ->checkbox(['label' => 'Full Payment']) ?>
    </div>

<?php if ($orderPayment->isNewRecord) : ?>
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'id' => 'btn-submit-create']) ?>
<?php else : ?>
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'id' => 'btn-submit-update']) ?>
<?php endif; ?>
<?php ActiveForm::end() ?>