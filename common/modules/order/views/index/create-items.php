<?php

use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;
use kartik\builder\TabularForm;
use kartik\grid\GridView;

$this->title = Yii::t('order', 'Create Items for Order #') . $model->order_id;

?>

<div class="row">
    <?php
    $form = ActiveForm::begin([
        'action' => 'submit',
        // 'type' => ActiveForm::TYPE_HORIZONTAL,
        // 'formConfig' => ['labelSpan' => 4],
    ]);
    ?>

    <div class="col-sm-12">
        <?php
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 4,
            'attributeDefaults' => [
                'type' => Form::INPUT_HIDDEN_STATIC,
            ],
            'attributes' => [
                'order_id' => [],
                'order_date' => [],
                'customer_id' => [
                    'label' => 'Customer',
                    'staticValue' => function ($model) {
                        $customer = \common\modules\customer\models\Customer::findOne($model->customer_id);
                        return $customer->getFullName();
                    }
                ],
                'sales_representative' => [
                    'type' => Form::INPUT_HIDDEN,
                ],
            ],
        ]);

        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 4,
            'attributeDefaults' => [
                'type' => Form::INPUT_HIDDEN_STATIC,
            ],
            'attributes' => [
                'payment_method' => [],
                'currency' => [],
                'order_amount' => [],
                'shipping_charges' => [],
                'commission_rate' => [
                    'type' => Form::INPUT_HIDDEN,
                ],
            ],
        ]);

        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 4,
            'attributeDefaults' => [
                'type' => Form::INPUT_HIDDEN_STATIC,
            ],
            'attributes' => [
                'custom_declaration' => [
                    'staticValue' => function ($model) {
                        return $model->custom_declaration == 1 ? Yii::t('app', 'Yes') : Yii::t('app', 'No');
                    },
                ],
                'declaration_value' => [],
                'incoterm' => [],
            ],
        ]);

        echo '<hr>';

        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 2,
            'attributeDefaults' => [
                'type' => Form::INPUT_HIDDEN_STATIC,
            ],
            'attributes' => [
                'billing_address' => [
                    'staticValue' => function ($model) {
                        return \common\modules\customer\models\Address::get($model->billing_address)->format(true)->generate();
                    }
                ],
                'shipping_address' => [
                    'staticValue' => function ($model) {
                        return \common\modules\customer\models\Address::get($model->shipping_address)->format(true)->generate();
                    }
                ],
            ],
        ])
        ?>
    </div>

    <div class="col-sm-12">
        <?php
        try {
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
                    'color' => [
                        'type' => TabularForm::INPUT_DROPDOWN_LIST,
                        'items' => $color,
                        'label' => 'Color'
                    ],
                    'quantity' => [
                        'label' => 'Quantity',
                        'options' => ['class' => 'form-control text-right'],
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
                    'panelHeadingTemplate' => '{heading}',
                    'panelFooterTemplate' => '{footer}',
                    'panel' => [
                        'heading' => '<h3 class="panel-title">Item List</h3>',
                        'type' => GridView::TYPE_PRIMARY,
                        'before' => false,
                        'footer' => '',
                        'after' => false,
                    ]
                ]
            ]);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }

        ?>
    </div>

    <div class="col-sm-12">
        <?php
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 4,
            'attributeDefaults' => [
                'type' => Form::INPUT_HIDDEN_STATIC,
            ],
            'attributes' => [
                'remark' => [],
            ],
        ])
        ?>
    </div>

    <div class="col-sm-12">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
