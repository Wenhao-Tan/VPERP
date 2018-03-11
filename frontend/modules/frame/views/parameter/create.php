<?php

use yii\helpers\Html;
use frontend\modules\frame\Module;


/* @var $this yii\web\View */
/* @var $model frontend\modules\frame\models\Parameter */

$this->title = Yii::t('frame', 'Create Frame');
$this->params['breadcrumbs'][] = ['label' => Module::t('frame', 'Eyeglass Frame'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameter-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
