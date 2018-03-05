<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

use kartik\editable\Editable;
use kartik\grid\GridView;
use kartik\grid\CheckboxColumn;
use kartik\grid\SerialColumn;


$status = [
    'Created' => 'Created',
    'Ordered' => 'Ordered',
    'Finished' => 'Finished',
];


$gridColumn = [
    ['class' => CheckboxColumn::className()],
    ['class' => SerialColumn::className()],
    [
        'attribute' => 'created_at',
        'format' => ['date', 'php:Y-m-d'],
    ],
    'ref_number',
    [
        'attribute' => 'refractive_index',
        'label' => 'Index',
    ],
    'prescription_type',
    [
        'attribute' => 'prescription_lens_type',
        'label' => 'Lens Type',
    ],
    'color_type',
    'function',
    'diameter',
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'supplier',
        'filter' => Html::activeDropDownList($searchModel, 'supplier', $suppliers, ['class' => 'form-control', 'prompt' => '-- Select --']),
        'editableOptions' => [
            'inputType' => Editable::INPUT_DROPDOWN_LIST,
            'data' => $suppliers,
            'placement' => 'left',
        ],
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'status',
        'filter' => Html::activeDropDownList($searchModel, 'status', $status, ['class' => 'form-control', 'prompt' => '']),
        'editableOptions' => [
            'inputType' => Editable::INPUT_DROPDOWN_LIST,
            'data' => $status,
        ]
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'template' => '{update} {delete}',
        'updateOptions' => ['class' => 'update'],
        'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
        'urlCreator' => function($action, $model) {
            $url = '';
            if($action == 'delete') {
                $url = Url::toRoute(['customize/delete', 'customNumber' => $model->custom_number]);
            }
            if($action == 'update') {
                $url = Url::toRoute(['customize/update', 'customNumber' => $model->custom_number]);
            }
            return $url;
        }
    ],
    [
        'class' => '\kartik\grid\ExpandRowColumn',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function($model, $key, $index, $column) {
            return $this->render('detail', [
                'model' => $model,
                'key' => $key,
            ]);
        }
    ],
];

$btnUpdate = Html::button('<i class="glyphicon glyphicon-pencil"></i> Update', [
    'type' => 'button',
    'title' => 'Update',
    'class' => 'btn btn-primary btn-multi-update',
]);
?>

<?php Pjax::begin() ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'rowOptions' => function ($model) {
        $status = strtolower($model->status);
        switch ($status) {
            case 'created':
                $class = 'created warning';
                break;
            case 'ordered':
                $class = 'ordered success';
                break;
            case 'finished':
                $class = 'finished';
                break;
            default:
                $class = '';
        }
        return ['class' => $class];
    },
    'columns' => $gridColumn,
    'hover' => true,
    'pjax' => true,
    'containerOptions' => ['class' => 'lens-pjax-container'],
    'panel' => [
        'type' => 'default',
    ],
    'toolbar' => [
        ['content' => $this->render('action/multiple-update', [
            'updateContents' => $updateContents,
        ])],
        '{export}',
    ],
    'pjax' => true,
]);
?>
<?php Pjax::end() ?>
