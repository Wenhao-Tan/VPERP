<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\retail\models\Permission */

$this->title = Yii::t('retail', 'Create Permission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('retail', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
