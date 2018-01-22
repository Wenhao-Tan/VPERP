<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\retail\models\Permission */

$this->title = Yii::t('retail', 'Update {modelClass}: ', [
    'modelClass' => 'Permission',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('retail', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('retail', 'Update');
?>
<div class="permission-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
