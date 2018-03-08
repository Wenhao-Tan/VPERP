<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\frame\models\Price */

$this->title = $model->reference;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frame', 'Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('frame', 'Update'), ['update', 'id' => $model->reference], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frame', 'Delete'), ['delete', 'id' => $model->reference], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('frame', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'models' => $model,
        'attributes' => [
            'reference',
            'purchase_price',
            'wholesale_price_cny',
            'wholesale_min_price_cny',
            'wholesale_price_usd',
            'wholesale_min_price_usd',
            'retailing_price_cny',
            'retailing_price_usd',
        ],
    ]) ?>

</div>
