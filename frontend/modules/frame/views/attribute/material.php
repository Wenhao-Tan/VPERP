<?php
use kartik\grid\GridView;
use frontend\modules\frame\models\FrameParamMaterial;
use yii\data\ActiveDataProvider;

$query = FrameParamMaterial::find();
$dataProvider = new ActiveDataProvider([
    'query' => $query,
]);

?>

<div class="frame-material col-xs-12">
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
    ])
    ?>
</div>

