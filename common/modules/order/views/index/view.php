<?php

use kartik\detail\DetailView;

$this->title = Yii::t('order', 'Order Detail');

?>

<?php
// Order Information
echo DetailView::widget([
    'model' => $order,
    'bordered' => true,
    'striped' => false,
    'responsive' => true,
    'hover' => true,
    'mode' => DetailView::MODE_VIEW,
    'enableEditMode' => false,
    'panel' => [
        'type' => 'primary',
        'heading' => 'Order # ' . $order->order_id,
        'footer' => '<strong>Status: ' . $order->status . '</strong>',
    ],
    'attributes' => [
        [
            'group' => true,
            'label' => Yii::t('order', 'Order Information'),
            'rowOptions' => ['class' => 'info']
        ],
        [
            'columns' => [
                [
                    'attribute' => 'order_date',
                    'format' => 'date',
                    'displayOnly' => true,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'sales_representative',
                    'value' => \common\modules\staff\models\StaffJobInfo::findOne(['staff_id' => $order->sales_representative])->english_name,
                    'displayOnly' => true,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'customer_id',
                    'value' => \common\modules\customer\models\Customer::getFullName($order->customer_id),
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'country_of_destination',
                    'valueColOptions' => ['style' => 'width:30%'],
                ],

            ],
        ],
        [
            'group' => true,
            'label' => Yii::t('order', 'Payment Info'),
            'rowOptions' => ['class' => 'info']
        ],
        [
            'columns' => [
                [
                    'attribute' => 'payment_method',
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'order_amount',
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'currency',
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'shipping_charges',
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],
        ],
        [
            'group' => true,
            'label' => Yii::t('order', 'Shipping Info'),
            'rowOptions' => ['class' => 'info']
        ],
        [
            'columns' => [
                [
                    'attribute' => 'billing_address',
                    'format' => 'raw',
                    'value' => \common\modules\customer\models\Address::get($order->billing_address)->format(true)->generate(),
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'shipping_address',
                    'format' => 'raw',
                    'value' => \common\modules\customer\models\Address::get($order->shipping_address)->format(true)->generate(),
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'custom_declaration',
                    'format' => 'raw',
                    'value' => $order->custom_declaration == 1 ?
                        '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'incoterm',
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'declaration_value',
                    'labelColOptions' => ['style' => 'width:20%; text-align:right; vertical-align:middle'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'remark',
                ],
            ],
        ]

    ],
]);
?>

<?php
// Order Items
echo $this->render('view/items.php', [
    'order' => $order,
]);
?>

<?php
echo $this->render('view/payment.php', [
    'order' => $order,
]);
?>

<?php
echo $this->render('view/shipping.php', [
    'order' => $order,
]);
?>
