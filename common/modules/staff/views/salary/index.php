<?php
use kartik\grid\GridView;
use yii\bootstrap\Html;

\common\modules\staff\assets\StaffAsset::register($this);

$this->title = 'Staff Salary';
?>

<div class="row">
    <div class="grid-salary col-sm-12">
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => \kartik\grid\SerialColumn::className()],
                'staff_id',
                'month',
                'working_days',
                'basic_salary',
                'commission',
                'total_salary',
                'medical',
                'pension',
                'unemployment',
                'net_pay',
                ['class' => \kartik\grid\ActionColumn::className()]
            ],
            'panel' => [
                'type' => 'default'
            ],
            'toolbar' => [
                [
                    'content' => Html::a('<i class="glyphicon glyphicon-plus"></i>',
                        \yii\helpers\Url::to(['salary/multiple-add']),
                        ['class' => 'btn btn-success btn-add-salary']),
                ]
            ]
        ])
        ?>
    </div>
</div>



