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
            'footer' => \common\modules\order\models\OrderItem::getTotalQuantity($dataProvider->models),
        ],
        'unit_price',
        [
            'attribute' => 'amount',
            'label' => Yii::t('order', 'Amount'),
            'value' => function ($model) {
                return number_format((float)$model->quantity * $model->unit_price, 2, '.', ',');
            },
            'footer' => \common\modules\order\models\OrderItem::getTotalAmount($dataProvider->models),
        ],
    ],
]);
?>