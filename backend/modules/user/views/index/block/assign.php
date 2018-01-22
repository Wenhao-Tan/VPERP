<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

$columnUsername = $query->select(['user.username'])
    ->where('`assigned` IS NULL OR `assigned` = 0')
    ->column();
$users = [];
foreach ($columnUsername as $username) {
    $users[$username] = $username;
}
?>

<h2>Assign User</h2>

<?php $form = ActiveForm::begin([
    'id' => 'form-assign-user',
]); ?>
<div class="row">
    <?= $form->field($modelAssignForm, 'username', ['options' => ['class' => 'col-sm-4']])
        ->dropdownList($users)
    ?>
</div>
<div class="row">
    <?= $form->field($modelAssignForm, 'staffId', ['options' => ['class' => 'col-sm-4']]) ?>
</div>
<div class="form-group">
    <?= Html::submitButton('Assign', ['class' => 'btn btn-primary', 'name' => 'assign-button']) ?>
</div>
<?php ActiveForm::end() ?>

<div class="row">
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'username',
            [
                'attribute' => 'userAssigned.assigned',
                'label' => Yii::t('app', 'Assigned'),
            ],
            [
                'attribute' => 'userAssigned.staff_id',
                'label' => Yii::t('app', 'Staff ID'),
            ],

        ],
        'options' => [
            'class' => 'col-sm-6',
        ],
    ]);
    ?>
</div>
