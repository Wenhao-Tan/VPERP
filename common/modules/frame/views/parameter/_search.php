<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\frame\Module;

/* @var $this yii\web\View */
/* @var $model common\modules\frame\models\ParameterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parameter-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'reference') ?>

    <?= $form->field($model, 'front_material') ?>

    <?= $form->field($model, 'temple_material') ?>

    <?= $form->field($model, 'rim_type') ?>

    <?= $form->field($model, 'shape') ?>

    <?php // echo $form->field($models, 'lens_width') ?>

    <?php // echo $form->field($models, 'bridge_width') ?>

    <?php // echo $form->field($models, 'temple_length') ?>

    <?php // echo $form->field($models, 'frame_width') ?>

    <?php // echo $form->field($models, 'lens_height') ?>

    <?php // echo $form->field($models, 'spring_hinge') ?>

    <?php // echo $form->field($models, 'clip_on') ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('frame', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Module::t('frame', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
