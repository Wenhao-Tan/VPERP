<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\modules\frame\models\FrameParamMaterial;
use frontend\modules\frame\models\FrameParamRimType;
use frontend\modules\frame\models\FrameParamShape;
/* @var $this yii\web\View */
/* @var $model frontend\modules\frame\models\Parameter */
/* @var $form yii\widgets\ActiveForm */

$material = FrameParamMaterial::find()->select('material')->indexBy('material')->column();
$rimType = FrameParamRimType::find()->select('rim_type')->indexBy('rim_type')->column();
$shape = FrameParamShape::find()->select('shape')->indexBy('shape')->column();
?>

<div class="parameter-form">

    <?php $form = ActiveForm::begin([]); ?>

    <div class="row">
        <?= $form->field($model, 'reference', ['options' => ['class' => 'col-xs-2 form-group']])
            ->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'front_material', ['options' => ['class' => 'col-xs-2 form-group']])
            ->dropDownList($material, ['prompt' => '']) ?>

        <?= $form->field($model, 'temple_material', ['options' => ['class' => 'col-xs-2 form-group']])
            ->dropDownList($material, ['prompt' => '']) ?>

        <?= $form->field($model, 'rim_type', ['options' => ['class' => 'col-xs-2 form-group']])
            ->dropDownList($rimType, ['prompt' => '']) ?>

        <?= $form->field($model, 'shape', ['options' => ['class' => 'col-xs-2 form-group']])
            ->dropDownList($shape, ['prompt' => '']) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'lens_width', ['options' => ['class' => 'col-xs-2 form-group']])->textInput() ?>

        <?= $form->field($model, 'bridge_width', ['options' => ['class' => 'col-xs-2 form-group']])->textInput() ?>

        <?= $form->field($model, 'temple_length', ['options' => ['class' => 'col-xs-2 form-group']])->textInput() ?>

        <?= $form->field($model, 'frame_width', ['options' => ['class' => 'col-xs-2 form-group']])->textInput() ?>

        <?= $form->field($model, 'lens_height', ['options' => ['class' => 'col-xs-2 form-group']])->textInput() ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'spring_hinge', ['options' => ['class' => 'col-xs-2 form-group']])
            ->dropDownList([0 => 'No', 1 => 'Yes'], ['prompt' => '']) ?>

        <?= $form->field($model, 'clip_on', ['options' => ['class' => 'col-xs-2 form-group']])
            ->dropDownList([0 => 'No', 1 => 'Yes' ], ['prompt' => '']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(
                $model->isNewRecord ? Yii::t('frame', 'Create') : Yii::t('frame', 'Update'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
