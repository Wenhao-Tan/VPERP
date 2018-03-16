<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\grid\ActionColumn;
use yii\helpers\Url;


?>

<?php if ($order->status == 'Full Payment') : ?>

    <?php
    $orderShipping = $order->getOrderShipping();
    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => $orderShipping,
        'sort' => ['defaultOrder' => ['shipping_date' => SORT_DESC]],
    ]);
    ?>
    <hr>

    <div id="order-shipping">
        <?php if ($orderShipping->exists()) : ?>
            <div id="grid-shipping">
                <?php
                echo GridView::widget([
                    'id' => 'grid-shipping',
                    'dataProvider' => $dataProvider,
                    'summary' => false,
                    'caption' => Yii::t('app', 'Shipping Information'),
                    'captionOptions' => ['class' => 'text-left kv-table-caption'],
                    'columns' => [
                        'shipping_id',
                        'shipping_date',
                        'package_weight',
                        'package_volume',
                        'shipping_method',
                        'shipping_carrier',
                        'shipping_agent',
                        [
                            'attribute' => 'shipping_cost',
                            'label' => Yii::t('app', 'Shipping Cost (￥)'),
                        ],
                        'tracking',
                        [
                            'class' => ActionColumn::className(),
                            'template' => '{update}{delete}',
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, [
                                        'class' => 'a-update-shipping colorbox',
                                        'title' => Yii::t('app', 'Update'),
                                    ]);
                                },
                                'delete' => function ($url) {
                                    return Html::a('<i class="glyphicon glyphicon-remove"></i>', $url, [
                                        'class' => 'a-delete-shipping',
                                        'title' => Yii::t('app', 'Delete'),
                                        'data-confirm' => Yii::t('app', 'Are you sure to delete this item?')
                                    ]);
                                }
                            ],
                            'urlCreator' => function ($action, $model) {
                                switch ($action) {
                                    case 'update':
                                        return Url::toRoute(['shipping/update', 'shippingId' => $model->shipping_id]);
                                        break;
                                    case 'delete':
                                        return Url::toRoute(['shipping/delete', 'shippingId' => $model->shipping_id]);
                                        break;
                                }
                            },
                            'visibleButtons' => [
                                'delete' => Yii::$app->user->can('admin'),
                            ],
                        ],
                    ],
                    'rowOptions' => ['style' => 'background: #fff'],
                ]);
                ?>
            </div>
        <?php endif; ?>

        <div id="create-shipping">
            <?= Html::button('Create Shipping', ['id' => 'btn-create-shipping', 'class' => 'btn btn-primary']) ?>

            <div id="shipping-form" style="display:none">
                <?= $this->render('shipping_form') ?>
            </div>
        </div>

    </div>
<?php endif; ?>`