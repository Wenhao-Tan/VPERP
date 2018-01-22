<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\frame\models\Price */

$this->title = Yii::t('frame', 'Create Price');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frame', 'Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
