<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\grid\ActionColumn;
use yii\helpers\Url;

$orderPayments = $order->getOrderPayments();
$dataProvider = new \yii\data\ActiveDataProvider([
    'query' => $orderPayments,
    'sort' => ['defaultOrder' => ['payment_date' => SORT_DESC]],
]);
?>

<hr>

<div id="order-payment">
    <div id="grid-payment">
        <?php if ($orderPayments->exists()): ?>
            <?php
            echo GridView::widget([
                'id' => 'grid-payment',
                'dataProvider' => $dataProvider,
                'summary' => false,
                'caption' => Yii::t('app', 'Payment Information'),
                'captionOptions' => ['class' => 'text-left kv-table-caption'],
                'columns' => [
                    'payment_id',
                    'payment_date',
                    'currency',
                    'amount',
                    'payment_method',
                    'type',
                    'remark',
                    [
                        'class' => ActionColumn::className(),
                        'template' => '{update}{delete}',
                        'buttons' => [
                            'update' => function ($url) {
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, [
                                    'id' => 'a-update-payment',
                                    'title' => Yii::t('app', 'Update'),
                                ]);
                            },
                            'delete' => function ($url) {
                                return Html::a('<i class="glyphicon glyphicon-remove"></i>', $url, [
                                    'id' => 'a-delete-payment',
                                    'title' => Yii::t('app', 'Delete'),
                                    'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
                                ]);
                            }
                        ],
                        'urlCreator' => function ($action, $model) {
                            switch ($action) {
                                case 'update':
                                    return Url::toRoute(['payment/update', 'paymentId' => $model->payment_id]);
                                    break;
                                case 'delete':
                                    return Url::toRoute(['payment/delete', 'paymentId' => $model->payment_id]);
                                    break;
                            }
                        },
                        'visible' => Yii::$app->user->can('admin'),
                    ],
                ],
                'rowOptions' => ['style' => 'background: #fff'],
                'pjax' => true,
                'pjaxSettings' => [
                    'options' => ['id' => 'pjax-grid-payment']
                ],
            ]);
            ?>
        <?php endif; ?>
    </div>

    <?php if (Yii::$app->user->can('admin')): ?>
        <div id="create-payment">
            <?= Html::button(Yii::t('order', 'Create Payment'), ['id' => 'btn-create-payment', 'class' => 'btn btn-primary']) ?>
            <div id="payment-form" style="display: none;">
                <?php echo $this->render('payment_form') ?>
            </div>
        </div>
    <?php endif; ?>
</div>
