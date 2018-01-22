<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\retail\models\OrderException */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('retail', 'Order Exceptions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-exception-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('retail', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('retail', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('retail', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'models' => $model,
        'attributes' => [
            'id',
            'order_id',
            'currency',
            'order_amount',
            'penalty_date',
            'staff',
            'penalty_amount',
            'reason',
        ],
    ]) ?>

</div>
