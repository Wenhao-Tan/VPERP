<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\frame\models\StockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'reference') ?>

    <?= $form->field($model, 'color') ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'availability') ?>

    <?php // echo $form->field($models, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frame', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('frame', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
