<?php
use yii\bootstrap\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\modules\frame\models\StockSearch;

if (!isset($dataProvider)) {
    $searchModel = new StockSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
}
?>

<p>
    <?= Html::a(Yii::t('frame', 'Create Stock'), ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'sku',
        'reference',
        'color',
        'quantity',
        'availability',
        // 'status',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>