<?php
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Html;

use common\modules\permission\models\AuthAssignment;
use common\modules\permission\models\AuthItem;
use common\modules\permission\models\AuthItemChild;
use common\modules\permission\models\AuthRule;
?>

<?php
$authAssignmentProvider = new ActiveDataProvider(['query' => AuthAssignment::find()]);
$authAssignmentProvider->pagination->pageParam = 'auth-assignment-page';
$authAssignmentProvider->sort->sortParam = 'auth-assignment-sort';

$authItemProvider = new ActiveDataProvider(['query' => AuthItem::find()]);
$authItemProvider->pagination->pageParam = 'auth-item-page';
$authItemProvider->sort->sortParam = 'auth-item-sort';

$authItemChildProvider = new ActiveDataProvider(['query' => AuthItemChild::find()]);
$authItemChildProvider->pagination->pageParam = 'auth-item-child-page';
$authItemChildProvider->sort->sortParam = 'auth-item-child-sort';

$authRuleProvider = new ActiveDataProvider(['query' => AuthRule::find()]);
$authRuleProvider->pagination->pageParam = 'auth-rule-page';
$authRuleProvider->sort->sortParam = 'auth-rule-sort';
?>

<div class="row">
    <?php
    echo GridView::widget([
        'caption' => Yii::t('app', 'Auth Assignment'),
        'dataProvider' => $authAssignmentProvider,
        'columns' => [
            'item_name',
            'user_id',
            'created_at',
            [
                'class' => \kartik\grid\ActionColumn::className()
            ],
        ],
        'options' => [
            'class' => 'col-sm-6'
        ],
    ]);
    ?>
</div>

<div class="row">
    <?php
    echo GridView::widget([
        'caption' => 'Auth Item',
        'dataProvider' => $authItemProvider,
        'options' => [
            'class' => 'col-sm-6'
        ]
    ]);
    ?>
</div>

<div class="row">
    <?php
    echo GridView::widget([
        'caption' => 'Auth Item Child',
        'dataProvider' => $authItemChildProvider,
        'options' => [
            'class' => 'col-sm-6'
        ]
    ]);
    ?>
</div>

<div class="row">
    <?php
    echo GridView::widget([
        'caption' => 'Auth Rule',
        'dataProvider' => $authRuleProvider,
        'options' => [
            'class' => 'col-sm-6'
        ]
    ]);
    ?>
</div>