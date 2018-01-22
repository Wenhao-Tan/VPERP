<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\frame\models\PriceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="price-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'reference') ?>

    <?= $form->field($model, 'purchase_price') ?>

    <?= $form->field($model, 'wholesale_price_cny') ?>

    <?= $form->field($model, 'wholesale_min_price_cny') ?>

    <?= $form->field($model, 'wholesale_price_usd') ?>

    <?php // echo $form->field($models, 'wholesale_min_price_usd') ?>

    <?php // echo $form->field($models, 'retailing_price_cny') ?>

    <?php // echo $form->field($models, 'retailing_price_usd') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frame', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frame', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
