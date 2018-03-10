<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\frame\models\Parameter */

$this->title = Yii::t('frame', 'Update {modelClass} # ', [
    'modelClass' => 'Parameter',
]) . $model->reference;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frame', 'Eyeglass Frames'), 'url' => ['parameter/index']];
$this->params['breadcrumbs'][] = Yii::t('frame', 'Update');
?>
<div class="parameter-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
