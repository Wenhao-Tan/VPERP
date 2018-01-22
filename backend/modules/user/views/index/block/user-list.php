<?php
use kartik\grid\GridView;
use yii\grid\ActionColumn;
?>

<h2>Users</h2>
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'username',
        'auth_key',
        'email',
        'status',
        'created_at',
        'updated_at',
        [
            'class' => ActionColumn::className(),
        ]
    ],
]);
?>

<div class="set-password">

</div>