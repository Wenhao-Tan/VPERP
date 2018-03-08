<?php

use yii\helpers\Html;
use frontend\modules\frame\Module;
/* @var $this yii\web\View */
/* @var $model frontend\modules\frame\models\Parameter */

$this->title = Module::t('frame', 'Update {modelClass}: ', [
    'modelClass' => 'Parameter',
]) . $model->reference;
$this->params['breadcrumbs'][] = ['label' => Module::t('frame', 'Eyeglass Frames'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = Module::t('frame', 'Update');
?>
<div class="parameter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
