<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\resource\models\SocialSecurity */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('socialSecurity', 'Social Securities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-security-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('socialSecurity', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('socialSecurity', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('socialSecurity', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'models' => $model,
        'attributes' => [
            'id',
            'month',
            'base_value',
            'pension_c',
            'pension_p',
            'medical_c',
            'medical_p',
            'critical_illness_c',
            'critical_illness_p',
            'employment_injury_c',
            'employment_injury_p',
            'maternity_c',
            'maternity_p',
            'unemployment_c',
            'unemployment_p',
        ],
    ]) ?>

</div>
