<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\frame\models\ParameterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parameters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameter-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['models' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Parameter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'reference',
            'front_material',
            'temple_material',
            'rim_type',
            'shape',
            // 'lens_width',
            // 'bridge_width',
            // 'temple_length',
            // 'frame_width',
            // 'lens_height',
            // 'spring_hinge',
            // 'clip_on',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
