<?php
use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = Yii::t('customer', 'Customer');

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => '\kartik\grid\SerialColumn'],
        'given_name',
        'family_name',
        'nationality',
        'email',
        [
            'attribute' => 'mobile_phone',
            'visible' => Yii::$app->user->can('admin'),
        ],
        'company',
        [
            'attribute' => 'sales_representative',
            'label' => Yii::t('customer', 'Sales Rep'),
            'visible' => Yii::$app->user->can('admin'),
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'visibleButtons' => [
                'delete' => Yii::$app->user->can('admin'),
            ],
        ],
    ],
    'toolbar' => [
        ['content' => Html::a('<i class="glyphicon glyphicon-plus"></i>', 'create', [
            'class' => 'btn btn-success'])
        ],
    ],
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
    ],
    'hover' => true,
]);