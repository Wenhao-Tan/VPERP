<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\retail\models\Retail */

$this->title = Yii::t('retail', 'Update {modelClass}: ', [
    'modelClass' => 'Retail',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('retail', 'Retails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('retail', 'Update');
?>
<div class="retail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
