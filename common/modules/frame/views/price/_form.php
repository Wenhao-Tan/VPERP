<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\modules\frame\Module;
/* @var $this yii\web\View */
/* @var $model common\modules\frame\models\Price */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="price-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-5',
                'offset' => '',
                'wrapper' => 'col-sm-6',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>

    <?= $form->field($model, 'purchase_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wholesale_price_cny')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wholesale_min_price_cny')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wholesale_price_usd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wholesale_min_price_usd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retailing_price_cny')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retailing_price_usd')->textInput(['maxlength' => true]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Module::t('frame', 'Create') : Module::t('frame', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
