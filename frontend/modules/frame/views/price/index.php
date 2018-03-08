<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\frame\models\PriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frame', 'Prices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['models' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frame', 'Create Price'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'reference',
            'purchase_price',
            [
                'attribute' => 'wholesale_price_cny',
                'label' => Yii::t('frame', 'Wholesale Price (CNY)'),
            ],

            'wholesale_min_price_cny',
            'wholesale_price_usd',
            'wholesale_min_price_usd',
            // 'retailing_price_cny',
            // 'retailing_price_usd',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
