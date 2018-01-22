<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\resource\models\SocialSecurity */

$this->title = Yii::t('socialSecurity', 'Update {modelClass}: ', [
    'modelClass' => 'Social Security',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('socialSecurity', 'Social Securities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('socialSecurity', 'Update');
?>
<div class="social-security-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
