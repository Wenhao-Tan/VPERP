<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\frame\models\Stock */

$this->title = Yii::t('frame', 'Update {modelClass}: ', [
    'modelClass' => 'Stock',
]) . $model->sku;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frame', 'Stocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sku, 'url' => ['view', 'id' => $model->sku]];
$this->params['breadcrumbs'][] = Yii::t('frame', 'Update');
?>
<div class="stock-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
