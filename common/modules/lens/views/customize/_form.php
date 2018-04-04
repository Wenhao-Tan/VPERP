<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use backend\modules\user\models\UserAssigned;

use common\modules\lens\models\ParameterMaterial;
use common\modules\lens\models\ParameterRefractiveIndex;
use common\modules\lens\models\ParameterPrescriptionType;
use common\modules\lens\models\ParameterPrescriptionLensType;
use common\modules\lens\models\ParameterColorType;
use common\modules\lens\models\ParameterColor;
use common\modules\lens\models\ParameterSurface;
use common\modules\lens\models\ParameterDiameter;
use common\modules\lens\models\ParameterCoating;

$username = Yii::$app->user->identity->username;
$user = UserAssigned::findOne(['username' => $username]);
$staffId = $user->staff_id;

$model->order_rep = $staffId;

$material = ParameterMaterial::find()->select(['name'])->indexBy('name')->column();
$refractiveIndex = ParameterRefractiveIndex::find()->select(['index'])->indexBy('index')->column();
$prescriptionType = ParameterPrescriptionType::find()->select(['type'])->indexBy('type')->orderBy(['type' => SORT_ASC])->column();
$prescriptionLensType = ParameterPrescriptionLensType::find()->select(['prescription_lens_type'])->indexBy('prescription_type')->column();
$colorType = ParameterColorType::find()->select(['type'])->indexBy('type')->column();
$color = ParameterColor::find()->select(['name'])->indexBy('name')->column();
$surface = ParameterSurface::find()->select(['surface'])->indexBy('surface')->column();
$diameter = ParameterDiameter::find()->select(['diameter'])->indexBy('diameter')->column();
$coating = ParameterCoating::find()->select(['code'])->indexBy('code')->column();

// Prescription Data
$prescription = [
    'SPH' => [],
    'CYL' => [],
    'AXS' => [],
    'ADD' => [],
    'prismDiopter' => [],
    'prismDirection' => [],
];

function generateLensData($min, $max, $step = 0.25, $type = 'strength')
{
    $arr = [];
    for ($i = $min; $i <= $max; $i += $step) {
        if ($type == 'strength') {
            if ($i > 0) {
                $i = '+' . number_format((float)$i, 2);
            } else {
                $i = number_format((float)$i, 2);
            }
        } else if($type == 'prism') {
            $i = number_format((float)$i, 1);
        }

        $arr[$i] = $i;
    }

    return $arr;
}

$prescription['SPH'] = generateLensData(-16.00, 16.00);
$prescription['CYL'] = generateLensData(-6.00, 6.00);
$prescription['AXS'] = generateLensData(1, 180, 1, 'axis');
$prescription['ADD'] = generateLensData(0.50, 4.00);
$prescription['prismDiopter'] = generateLensData(0.5, 9, 0.5, 'prism');
$prescription['prismDirection'] = [
    'up' => 'Up',
    'down' => 'Down',
    'in' => 'In',
    'out' => 'Out'
];

?>

<?php $form = ActiveForm::begin(); ?>
    <div class="row custom-info">
        <?= $form->field($model, 'custom_number', [
            'options' => [
                'class' => 'form-group col-xs-2',
            ],
            'inputOptions' => [
                'value' => '',              // implode('', explode('-', date('Y-m-d-H-i-s'))),
                'readonly' => 'readonly',
            ]
        ]); ?>

        <?= $form->field($model, 'ref_number', ['options' => ['class' => 'form-group col-xs-2']]); ?>

        <?= $form->field($model, 'order_rep', ['options' => ['class' => 'form-group col-xs-2']])
            ->textInput(['readonly' => true]) ?>
    </div>

    <div class="row frame-info">
        <?= $form->field($model, 'frame_model', ['options' => ['class' => 'form-group col-xs-2']]) ?>
    </div>

    <hr/>

    <div class="row">
        <?= $form->field($model, 'material', ['options' => ['class' => 'form-group col-xs-2']])
            ->dropDownList($material, ['options' => ['Resin' => ['Selected' => true]]]) ?>

        <?= $form->field($model, 'refractive_index', ['options' => ['class' => 'form-group col-xs-2']])
            ->dropDownList($refractiveIndex, ['options' => ['1.56' => ['Selected' => true]]])
            ->label('Index'); ?>

        <?= $form->field($model, 'prescription_type', ['options' => ['class' => 'form-group col-xs-2']])
            ->dropDownList($prescriptionType, ['options' => ['Single Vision' => ['Selected' => true]]]) ?>

        <?= $form->field($model, 'prescription_lens_type', ['options' => ['class' => 'form-group col-xs-2']])
            ->dropDownList($prescriptionLensType, ['options' => ['' => ['Selected' => true]], 'disabled' => 'disabled'])
            ->label('Lens Type') ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'color_type', ['options' => ['class' => 'form-group col-xs-2']])
            ->dropDownList($colorType, ['options' => ['Clear' => ['selected' => true]]]) ?>

        <?= $form->field($model, 'color', ['options' => ['class' => 'form-group col-xs-2']])
            ->dropDownList($color, ['prompt' => '', 'disabled' => 'disabled']) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'surface', ['options' => ['class' => 'form-group col-xs-2']])
            ->dropDownList($surface, ['options' => ['ASP' => ['Selected' => true]]]) ?>

        <?= $form->field($model, 'diameter', ['options' => ['class' => 'form-group col-xs-2']])
            ->dropDownList($diameter, ['prompt' => '']) ?>

        <?php $model->coating = ['HMC']; ?>
        <?= $form->field($model, 'coating', ['options' => ['class' => 'form-group col-xs-4']])
            ->inline(true)
            ->checkboxList($coating) ?>
    </div>

    <hr/>

    <div class="row">
        <div class="col-xs-9">
            <table class="table">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>SPH</th>
                    <th>CYL</th>
                    <th>AXS</th>
                    <th>ADD</th>
                    <th>Prism Diopter</th>
                    <th>Prism Direction</th>
                    <th>PD</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>R (OD)</th>
                    <td>
                        <?= $form->field($model, 'r_sph')
                            ->dropDownList($prescription['SPH'], ['options' => ['0.00' => ['Selected' => true]]])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'r_cyl')
                            ->dropDownList($prescription['CYL'], ['options' => ['0.00' => ['Selected' => true]]])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'r_axs')
                            ->dropDownList($prescription['AXS'], ['prompt' => '',])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'r_add')
                            ->dropDownList($prescription['ADD'], ['prompt' => '',])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'r_prism_diopter')
                            ->dropDownList($prescription['prismDiopter'], ['prompt' => '',])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'r_prism_direction')
                            ->dropDownList($prescription['prismDirection'], ['prompt' => ''])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'r_pd')->label(false) ?>
                    </td>

                </tr>
                <tr>
                    <th>L (OS)</th>
                    <td>
                        <?= $form->field($model, 'l_sph')
                            ->dropDownList($prescription['SPH'], ['options' => ['0.00' => ['Selected' => true]]])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'l_cyl')
                            ->dropDownList($prescription['CYL'], ['options' => ['0.00' => ['Selected' => true]]])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'l_axs')
                            ->dropDownList($prescription['AXS'], ['prompt' => '',])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'l_add')
                            ->dropDownList($prescription['ADD'], ['prompt' => '',])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'l_prism_diopter')
                            ->dropDownList($prescription['prismDiopter'], ['prompt' => '',])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'l_prism_direction')
                            ->dropDownList($prescription['prismDirection'], ['prompt' => ''])
                            ->label(false) ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'l_pd')->label(false) ?>
                    </td>
                </tr>
                </tbody>
            </table>

            <hr/>

            <div class="row">
                <?php $model->quantity = 1.0; ?>
                <?= $form->field($model, 'quantity', ['options' => ['class' => 'form-group col-xs-2']]); ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'remark', ['options' => ['class' => 'form-group col-xs-12']])
                    ->textarea(['rows' => 5]) ?>
            </div>

            <?= Html::submitButton('Submit', ['name' => 'create', 'class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>