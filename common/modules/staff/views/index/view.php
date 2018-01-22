<?php
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use common\modules\staff\models\StaffGeneralInfo;

$query = StaffGeneralInfo::find()->joinWith('staffJobInfo');
$dataProvider = new ActiveDataProvider([
    'query' => $query,
]);
$columns = [
    ['class' => 'yii\grid\CheckboxColumn'],
    ['class' => 'yii\grid\SerialColumn'],
    'staff_id',
    [
        'attribute' => 'id_card_number',
        'label' => Yii::t('app', 'ID Card Number'),
    ],
    [
        'attribute' => 'family_name_zh',
        'label' => Yii::t('app', 'Family Name'),
    ],
    [
        'attribute' => 'given_name_zh',
        'label' => Yii::t('app', 'Given Name'),
    ],
    [
        'attribute' => 'gender',
        'label' => Yii::t('app', 'Gender'),
    ],
    [
        'attribute' => 'age',
        'label' => Yii::t('app', 'Age'),
    ],
    [
        'attribute' => 'education',
        'label' => Yii::t('app', 'Education'),
    ],
    [
        'attribute' => 'mobile_phone',
        'label' => Yii::t('app', 'Mobile Phone'),
    ],
    [
        'attribute' => 'other_phone',
        'label' => Yii::t('app', 'Other Phone'),
    ],
    [
        'attribute' => 'address',
        'label' => Yii::t('app', 'Address'),
    ],
    [
        'class' => \kartik\grid\ActionColumn::className(),
        'template' => '{salary}{update}{delete}',
        'buttons' => [
            'salary' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-money"></i>', $url, ['class' => 'a-add-salary colorbox']);
            },
            'update' => function ($url, $model, $key) {
                return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'a-update-staff colorbox']);
            }
        ],
        'urlCreator' => function ($action, $model, $key) {
            switch ($action) {
                case 'salary':
                    $url = Url::toRoute(['salary/add', 'staffId' => $model->staff_id]);
                    return $url;
                case 'update':
                    $url = Url::toRoute(['index/update', 'staffId' => $model->staff_id, 'rnd' => '1']);
                    return $url;
            }
        }
    ],
    [
        'class' => \kartik\grid\ExpandRowColumn::className(),
        'value' => function ($model, $key, $index) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index, $column) {
            $jobInfoProvider = new ActiveDataProvider([
                'query' => \common\modules\staff\models\StaffJobInfo::find()->where(['staff_id' => $model->staff_id])
            ]);
            return $this->render('detail/job_info', [
                'jobInfoProvider' => $jobInfoProvider,
            ]);
        },

    ],
];
?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $columns,
]);
?>