<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\frame\models\ParameterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frame', 'Parameter');

$this->params['breadcrumbs'][] = ['label' => Yii::t('frame', 'Frame'), 'url' => ['parameter/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameter-index">

    <?php // echo $this->render('_search', ['models' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frame', 'Create Model'), ['parameter/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_grid') ?>
