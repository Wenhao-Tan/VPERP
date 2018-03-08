<?php

use kartik\grid\GridView;
use frontend\modules\frame\models\ParameterSearch;
use yii\bootstrap\Html;
use yii\helpers\Url;

if (!isset($dataProvider)) {
    $searchModel = new ParameterSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
}
?>

    <p>
        <?= Html::a(Yii::t('frame', 'Create Model'), ['parameter/create'], ['class' => 'btn btn-success']) ?>
    </p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\CheckboxColumn'],

        'reference',
        [
            'attribute' => 'front_material',
            'value' => function ($model) {
                return Yii::t('frame', $model->front_material);
            }
        ],
        [
            'attribute' => 'temple_material',
            'value' => function ($model) {
                return Yii::t('frame', $model->temple_material);
            }
        ],
        [
            'attribute' => 'rim_type',
            'value' => function ($model) {
                return Yii::t('frame', $model->rim_type);
            }
        ],
        [
            'attribute' => 'shape',
            'value' => function ($model) {
                return Yii::t('frame', $model->shape);
            }
        ],
        'lens_width',
        'bridge_width',
        'temple_length',
        'frame_width',
        'lens_height',
        [
            'attribute' => 'spring_hinge',
            'format' => 'boolean',
        ],
        [
            'attribute' => 'clip_on',
            'format' => 'boolean',
        ],

        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{update} {delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action == 'update') {
                    $url = Url::to(['parameter/update', 'reference' => $model->reference]);
                    return $url;
                }

                if ($action == 'delete') {
                    $url = Url::to(['parameter/delete', 'reference' => $model->reference]);
                    return $url;
                }
            },
            'visibleButtons' => [
                'update' => true,
                'delete' => Yii::$app->user->can('admin'),
            ],
        ],

        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'value' => function () {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return $this->render('stock', [
                    'key' => $key,
                ]);
            },

        ],
    ],
    'summary' => '',
    'pjax' => true,
]); ?>