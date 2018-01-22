<?php
use common\models\UserExtend;
use yii\data\ActiveDataProvider;

$this->title = 'User Management';

$query = UserExtend::find()->joinWith('userAssigned');
$dataProvider = new ActiveDataProvider([
    'query'      => $query,
    'pagination' => [
        'pageSize' => 30,
    ],
]);
?>

<div class="user-list">
    <?php
    echo $this->render('block/list', [
        'dataProvider' => $dataProvider,
    ]);
    ?>
</div>

<hr />

<div class="user-create">
    <?php echo $this->render('block/signup', [
        'models' => $model,
    ]); ?>
</div>

<hr />

<div class="user-assign">
    <?php
    echo $this->render('block/assign',[
        'modelAssignForm' => $modelAssignForm,
        'dataProvider' => $dataProvider,
        'query' => $query,

    ]);
    ?>
</div>