<?php
use yii\bootstrap\Tabs;
use common\modules\order\assets\OrderAsset;
use common\modules\order\Module;

$this->title = Module::t('order', 'Order Information');
?>
<div class="order">
    <?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => Module::t('order', 'View Orders'),
                'content' => $this->render('view', [
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
