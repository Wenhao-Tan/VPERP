<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\frame\models\Stock */

$this->title = $model->sku;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frame', 'Stocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('frame', 'Update'), ['update', 'id' => $model->sku], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frame', 'Delete'), ['delete', 'id' => $model->sku], [
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
            'sku',
            'reference',
            'color',
            'quantity',
            'availability',
            'status',
        ],
    ]) ?>

</div>
