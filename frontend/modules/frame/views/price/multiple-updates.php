<?php

use yii\helpers\Html;
use frontend\modules\frame\Module;
/* @var $this yii\web\View */
/* @var $model frontend\modules\frame\models\Price */

$this->title = Yii::t('frame', 'Multiple Updates');

/*
$this->params['breadcrumbs'][] = ['label' => Yii::t('frame', 'Prices'), 'url' => ['default/index']];
// $this->params['breadcrumbs'][] = ['label' => $models->reference, 'url' => ['view', 'id' => $models->reference]];
$this->params['breadcrumbs'][] = Yii::t('frame', 'Update');
*/
?>
<div class="price-update col-sm-12">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <hr />

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
