<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\modules\frame\Module;
/* @var $this yii\web\View */
/* @var $model common\modules\frame\models\Parameter */

$this->title = $model->reference;
$this->params['breadcrumbs'][] = ['label' => Module::t('frame', 'Parameters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameter-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('frame', 'Update'), ['update', 'id' => $model->reference], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('frame', 'Delete'), ['delete', 'id' => $model->reference], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('frame', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'models' => $model,
        'attributes' => [
            'reference',
            'front_material',
            'temple_material',
            'rim_type',
            'shape',
            'lens_width',
            'bridge_width',
            'temple_length',
            'frame_width',
            'lens_height',
            'spring_hinge',
            'clip_on',
        ],
    ]) ?>

</div>
