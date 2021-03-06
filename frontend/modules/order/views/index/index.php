<?php
use yii\bootstrap\Tabs;
use frontend\modules\order\assets\OrderAsset;
use frontend\modules\order\Module;

$this->title = Module::t('order', 'Order Information');
?>
<div class="order">
    <?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => Module::t('order', 'View Orders'),
                'content' => $this->render('grid', [
                    'dataProvider' => $dataProvider['order'],
                    'searchModel' => $searchModel['order'],
                ]),
            ],
            [
                'label' => Yii::t('order', 'Payment Info'),
                'content' => $this->render('order-payment', [
                    'dataProvider' => $dataProvider['order_payment'],
                    'searchModel' => $searchModel['order_payment'],
                ]),
                'visible' => Yii::$app->user->can('admin'),
            ],
        ],
    ]);
    ?>
</div>
