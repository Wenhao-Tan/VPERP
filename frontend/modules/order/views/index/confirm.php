<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;
use kartik\builder\TabularForm;
use kartik\grid\GridView;

$this->title = Yii::t('order', 'Create Order Items');
?>

<div class="row">
    <?php
    $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 4],
    ]);
    ?>


    <div class="col-sm-6">
        <?php
        echo TabularForm::widget([
            'dataProvider' => $dataProvider,
            'formName' => 'OrderItem',
            'actionColumn' => false,
            'checkboxColumn' => false,
            'attributeDefaults' => [
                'type' => TabularForm::INPUT_TEXT,
            ],
            'attributes' => [
                'reference' => ['label' => 'Reference'],
                'color' => ['label' => 'Color'],
                'quantity' => [
                    'label' => 'Quantity',
                    'options' => ['class' => 'form-control text-right'],
                    'footer' => '31',
                ],
                'unit_price' => [
                    'label' => 'Unit Price',
                    'options' => ['class' => 'form-control text-right'],
                ],
                'amount' => [
                    'type' => TabularForm::INPUT_HIDDEN_STATIC,

                    'hiddenStaticOptions' => ['class' => 'text-right'],
                ],
            ],
            'gridSettings' => [
                'floatHeader' => true,
                'panel' => [
                    'heading' => '<h3 class="panel-title">Item List</h3>',
                    'type' => GridView::TYPE_PRIMARY,
                    'before' => false,
                    'showFooter' => true,
                    'after' => false,
                ]
            ]
        ]);
        ?>
    </div>

    <div class="col-sm-12">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
