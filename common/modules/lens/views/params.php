<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-05-28
 * Time: 11:30
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Lens Parameters';
?>

<?php $form = ActiveForm::begin([]); ?>

    <div class="row">
        <?= $form->field($lensParamsModel, 'material', ['options' => ['class' => 'col-xs-3']]) ?>
        <?php // echo $form->field($lensParamsModel, 'material_list', ['options' => ['class' => 'col-xs-12']])->dropDownList($lensParamsColumn['lensMaterialColumn']) ?>
    </div>

    <hr/>

    <div class="row">
        <?= $form->field($lensParamsModel, 'refractive_index', ['options' => ['class' => 'col-xs-3']]) ?>
        <?= $form->field($lensParamsModel, 'material_list', ['options' => ['class' => 'col-xs-3']])->dropDownList($lensParamsList['materialList']) ?>
        <?= $form->field($lensParamsModel, 'refractive_index_list', ['options' => ['class' => 'col-xs-12']])->dropDownList($lensParamsList['refractiveIndexList']) ?>
    </div>

    <hr/>

    <div class="row">
        <?= $form->field($lensParamsModel, 'surface', ['options' => ['class' => 'col-xs-3']]) ?>
        <?= $form->field($lensParamsModel, 'surface_list', ['options' => ['class' => 'col-xs-3']])->dropDownList($lensParamsList['surfaceList']) ?>
    </div>

    <hr/>

    <div class="row">
        <?= $form->field($lensParamsModel, 'diameter', ['options' => ['class' => 'col-xs-3']]) ?>
        <?= $form->field($lensParamsModel, 'diameter_list', ['options' => ['class' => 'col-xs-3']]) ?>
    </div>

    <hr/>

    <div class="row">
        <?= $form->field($lensParamsModel, 'prescription_type', ['options' => ['class' => 'col-xs-3']]) ?>
        <?= $form->field($lensParamsModel, 'prescription_type_list', ['options' => ['class' => 'col-xs-3']]) ?>
    </div>

    <hr/>

    <div class="row">
        <?= $form->field($lensParamsModel, 'prescription_lens_type', ['options' => ['class' => 'col-xs-3']]) ?>
        <?= $form->field($lensParamsModel, 'prescriptioin_lens_type_list', ['options' => ['class' => 'col-xs-3']]) ?>
    </div>

    <hr />

    <div class="row">
        <?= $form->field($lensParamsModel, 'color_type', ['options' => ['class' => 'col-xs-3']]) ?>
        <?= $form->field($lensParamsModel, 'color_type_list', ['options' => ['class' => 'col-xs-3']])->dropDownList($lensParamsList['colorTypeList']) ?>
    </div>

    <hr />

    <div class="row">
        <?= $form->field($lensParamsModel, 'color', ['options' => ['class' => 'col-xs-3']]) ?>
        <?= $form->field($lensParamsModel, 'color_list', ['options' => ['class' => 'col-xs-3']])->dropDownList($lensParamsList['colorList']) ?>
    </div>

    <div>
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>