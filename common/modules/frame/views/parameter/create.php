<?php

use yii\helpers\Html;
use common\modules\frame\Module;


/* @var $this yii\web\View */
/* @var $model common\modules\frame\models\Parameter */

$this->title = Module::t('frame', 'Create Frame Parameter');
$this->params['breadcrumbs'][] = ['label' => Module::t('frame', 'Eyeglass Frame'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
