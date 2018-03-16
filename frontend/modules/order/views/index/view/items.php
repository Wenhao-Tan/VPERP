<?php
use kartik\grid\GridView;

$orderItems = $order->getOrderItems();
$dataProvider = new \yii\data\ActiveDataProvider([
    'query' => $orderItems,
    'pagination' => false,
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => false,
    'caption' => Yii::t('order', 'Item List'),
    'showFooter' => true,
    'columns' => [
        [
            'attribute' => 'reference',
            'footer' => 'Sub Total'
        ],
        'color',
        [
            'attribute' => 'quantity',
            'contentOptions' => ['class' => 'text-right'],
            'footer' => \frontend\modules\order\models\OrderItem::getTotalQuantity($dataProvider->models),
            'footerOptions' => ['class' => 'text-right'],
        ],
        [
            'attribute' => 'unit_price',
            'contentOptions' => ['class' => 'text-right'],
        ],
        [
            'attribute' => 'amount',
            'label' => Yii::t('order', 'Amount'),
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($model) {
                return number_format((float)$model->quantity * $model->unit_price, 2, '.', ',');
            },
            'contentOptions' => ['class' => 'text-right'],
            'footer' => \frontend\modules\order\models\OrderItem::getTotalAmount($dataProvider->models),
            'footerOptions' => ['class' => 'text-right'],
        ],
    ],
]);
?>