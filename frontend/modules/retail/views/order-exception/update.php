<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\retail\models\OrderException */

$this->title = Yii::t('retail', 'Update {modelClass}: ', [
    'modelClass' => 'Order Exception',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('retail', 'Order Exceptions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('retail', 'Update');
?>
<div class="order-exception-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
