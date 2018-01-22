<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

use common\models\Currency;
use common\modules\general\models\PaymentMethod;
?>

<?php $form = ActiveForm::begin([
    'id' => 'form-order-payment-method',
]) ?>
    <div class="row">
        <?= $form->field($model, 'payment_id', ['options' =>['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'order_id', ['options' => ['class' => 'col-sm-3']])
            ->textInput(['readonly' => true]) ?>
        <?= $form->field($model, 'payment_date', ['options' => ['class' => 'col-sm-3']])
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
        <?= $form->field($model, 'currency', ['options' => ['class' => 'col-sm-3']])
            ->dropDownList(ArrayHelper::map(Currency::find()->where(['status' => 1])->all(), 'code', 'code'), ['prompt' => ''])
            ->label(Yii::t('app', 'Currency'))
        ?>
        <?= $form->field($model, 'amount', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'payment_method', ['options' => ['class' => 'col-sm-3']])
            ->dropDownList(ArrayHelper::map(PaymentMethod::find()->all(), 'code', 'payment_method'), ['prompt' => ''])
            ->label(Yii::t('app', 'Payment Method'))
        ?>
        <?= $form->field($model, 'payment_processor', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'bank_code', ['options' => ['class' => 'col-sm-3']]) ?>
        <?= $form->field($model, 'bank_account', ['options' => ['class' => 'col-sm-3']]) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'remark', ['options' => ['class' => 'col-sm-6']])->textarea() ?>
    </div>

<?php if (!isset($orderPayment)) : ?>
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'id' => 'btn-submit-create']) ?>
<?php else : ?>
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'id' => 'btn-submit-update']) ?>
<?php endif; ?>
<?php ActiveForm::end() ?>