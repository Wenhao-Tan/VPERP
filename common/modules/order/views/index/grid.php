<?php
use backend\modules\user\models\UserAssigned;
use common\modules\order\Module;
use kartik\grid\GridView;
use yii\bootstrap\Html;
use yii\helpers\Url;

/*
 * Get Current Username
 */
$username = Yii::$app->user->identity->username;

/*
 * Get the Staff ID of current user
 * 获取当前用户的 员工ID
 */
$userAssigned = UserAssigned::findOne(['username' => $username]);
$staffId = ($userAssigned != null) ? $userAssigned->staff_id : null;
if ($username != 'admin') {
    $dataProvider->query->where(['order.sales_representative' => $staffId]);
}


$grid = array();

$grid['columns'] = [
    ['class' => 'yii\grid\CheckboxColumn'],
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'order_id',
        'label' => Module::t('order', 'Order ID'),
    ],
    [
        'attribute' => 'order_date',
        'label' => Module::t('order', 'Order Date'),
        'contentOptions' => ['class' => 'text-center'],
    ],
    [
        'attribute' => 'sales_representative',
        'label' => Module::t('order', 'Sales Representative'),
        'visible' => Yii::$app->user->can('admin'),
    ],
    [
        'attribute' => 'full_name',
    ],
    [
        'attribute' => 'country_of_destination',
        'label' => Module::t('order', 'Country/Region'),
        'contentOptions' => ['class' => 'text-center'],
    ],
    [
        'attribute' => 'currency',
        'label' => Module::t('order', 'Currency'),
    ],
    [
        'attribute' => 'order_amount',
        'label' => Module::t('order', 'Order Amount'),
        'contentOptions' => ['class' => 'text-right'],
    ],
    [
        'attribute' => 'commission_rate',
        'label' => Module::t('order', 'Commission Rate (%)'),
        'contentOptions' => ['class' => 'text-right'],
        'visible' => Yii::$app->user->can('admin'),
    ],
    [
        'attribute' => 'custom_declaration',
        'label' => Module::t('order', 'Custom Declaration'),
        'contentOptions' => ['class' => 'text-center'],
        'format' => 'boolean',
        'filter' => ['1' => Yii::t('order', 'Yes'), '0' => Yii::t('order', 'No')],
    ],
    [
        'attribute' => 'status',
        'label' => Module::t('order', 'Status'),
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{invoice}{detail}{update}{delete}',
        'buttons' => [
            'invoice' => function ($url, $model) {
                $url = Url::toRoute(['index/invoice', 'orderId' => $model->order_id]);
                return Html::a('<i class="fa fa-paperclip"></i>', $url, ['class' => 'a-generate-invoice']);
            },
            'detail' => function ($url, $model) {
                $url = Url::toRoute(['view', 'orderId' => $model->order_id]);
                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, ['class' => 'a-order-view']);
            },
            'update' => function ($url, $model) {
                $url = Url::toRoute(['update', 'orderId' => $model->order_id]);
                return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'a-update-order colobox']);
            },
            'delete' => function ($url, $model) {
                $url = Url::toRoute(['index/delete', 'orderId' => $model->order_id]);
                return Html::a('<i class="glyphicon glyphicon-remove"></i>', $url, ['class' => 'a-delete-order']);
            },

        ],
        'visibleButtons' => [
            'invoice' => Yii::$app->user->can('admin'),
            'update' => Yii::$app->user->can('admin'),
            'delete' => Yii::$app->user->can('admin'),
        ],
    ],

];

$grid['toolbar'] = [
    [
        'content' => Html::a(Yii::t('order', 'Create'), ['create'], ['class' => 'btn btn-success'])
    ],
    [
        'content' => Yii::$app->user->can('admin') ?
            Html::button('<i class="glyphicon glyphicon-remove"></i>' . Module::t('order', 'Delete'), [
                'type' => 'button',
                'title' => Module::t('order', 'Delete Orders'),
                'class' => 'btn btn-danger',
                'id' => 'btn-delete-orders'
            ]) : ''
    ],
    '{export}',
    '{toggleData}',
];
?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => ['id' => 'order-info'],
    'panel' => [
        'type' => 'default',
    ],
    'toolbar' => $grid['toolbar'],
    'columns' => $grid['columns'],
    'rowOptions' => function ($model, $index, $widget, $grid) {
        if ($model->status == 'Unpaid' || $model->status == 'Created') {
            return ['class' => 'danger'];
        } else if ($model->status == 'Paid' || $model->status == 'Processing') {
            return ['class' => 'success'];
        }
    },
]);
?>
