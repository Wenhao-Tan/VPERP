<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\frame\models\PriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frame', 'Prices');

$this->params['breadcrumbs'][] = ['label' => Yii::t('frame', 'Frame'), 'url' => ['parameter/index']];
$this->params['breadcrumbs'][] = Yii::t('frame', $this->title);
?>
<div class="price-index">

    <?php // echo $this->render('_search', ['models' => $searchModel]); ?>

    <?= $this->render('_grid') ?>
</div>
