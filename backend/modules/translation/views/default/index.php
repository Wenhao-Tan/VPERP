<?php
use yii\bootstrap\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use backend\modules\translation\models\Message;


$this->title = 'Translation';

$query = Message::find();
$dataProvider = new ActiveDataProvider([
    'query' => $query,
])
?>

<h1><?= Html::encode($this->title) ?></h1>
<hr>

<p>
    <?= Html::a(Yii::t('translation', 'Create Translation'), ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?php Pjax::begin([
    'id' => 'pjax-translation-grid',
]) ?>
<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'sourceMessage.category',
        'sourceMessage.message',
        'language',
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'translation',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ],
    ],
])
?>
<?php Pjax::end() ?>
