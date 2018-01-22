<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\retail\models\OrderException */

$this->title = Yii::t('retail', 'Create Order Exception');
$this->params['breadcrumbs'][] = ['label' => Yii::t('retail', 'Order Exceptions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-exception-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
