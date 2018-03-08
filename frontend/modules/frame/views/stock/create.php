<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\frame\models\Stock */

$this->title = Yii::t('frame', 'Create Stock');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frame', 'Stocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
