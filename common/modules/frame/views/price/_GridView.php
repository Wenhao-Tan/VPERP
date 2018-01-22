<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\modules\frame\models\PriceSearch;
use yii\helpers\Url;
use yii\bootstrap\Html;

/* @var $searchModel common\modules\frame\models\PriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (!isset($dataProvider)) {
    $searchModel = new PriceSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
}
?>

<?= GridView::widget([
    'id' => 'frame-price-grid',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\CheckboxColumn'],

        'reference',
        [
            'attribute' => 'purchase_price',
            'visible' => Yii::$app->user->can('admin'),
        ],
        'wholesale_price_cny',
        'wholesale_min_price_cny',
        'wholesale_price_usd',
        'wholesale_min_price_usd',
        'retailing_price_cny',
        'retailing_price_usd',

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
            'buttonOptions' => ['class' => 'update-price'],
            'urlCreator' => function ($action, $model, $key, $index) {
                $url = '';
                if ($action == 'update') {
                    $url = Url::toRoute(['price/update', 'reference' => $model->reference]);
                }
                return $url;
            },
            'visible' => Yii::$app->user->can('admin'),
        ],
    ],
    'summary' => '',
    'panel' => [
        'type' => 'default',
    ],
    'toolbar' => [
        [
            'content' => Yii::$app->user->can('admin') ?
                Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['price/multiple-updates'], [
                    'title' => Yii::t('frame', 'Update Prices'),
                    'class' => 'btn btn-success price-multiple-updates',
                ]) : '' . ' '
        ],
        '{export}',
        '{toggleData}',
    ],
    'pjax' => true,

]); ?>
