<?php
use kartik\grid\GridView;

?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
])
?>



