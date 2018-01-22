<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use common\models\Country;
use backend\modules\user\models\UserAssigned;

$countries = Country::getCountries();
$staffId = UserAssigned::getCurrentStaffId();
?>

<?php $form = ActiveForm::begin() ?>
    <div id="customer">
        <div class="row">
            <?= $form->field($model, 'email', ['options' => ['class' => 'col-sm-3']]) ?>
        </div>

        <div class="row">
            <?= $form->field($model, 'given_name', ['options' => ['class' => 'col-sm-3']]) ?>
            <?= $form->field($model, 'family_name', ['options' => ['class' => 'col-sm-3']]) ?>
        </div>

        <div class="row">
            <?= $form->field($model, 'company', ['options' => ['class' => 'col-sm-3']]) ?>
            <?= $form->field($model, 'nationality', ['options' => ['class' => 'col-sm-3']])->dropDownList($countries) ?>
        </div>

        <div class="row">
            <?= $form->field($model, 'mobile_phone', ['options' => ['class' => 'col-sm-3']]) ?>
            <?= $form->field($model, 'whatsapp', ['options' => ['class' => 'col-sm-3']]) ?>
            <?= $form->field($model, 'skype', ['options' => ['class' => 'col-sm-3']]) ?>
        </div>

        <div class="row">
            <?php if (Yii::$app->getUser()->can('admin')): ?>

                <?= $form->field($model, 'sales_representative', ['options' => ['class' => 'col-sm-3']]) ?>

            <?php else: ?>

                <?= $form->field($model, 'sales_representative', ['options' => ['class' => 'col-sm-3']])
                    ->hiddenInput(['value' => $staffId])->label(false) ?>

            <?php endif ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('customer', 'Create') : Yii::t('customer', 'Update'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
    </div>

<?php ActiveForm::end() ?>