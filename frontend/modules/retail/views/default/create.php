<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\retail\models\Retail */

$this->title = Yii::t('retail', 'Create Retail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('retail', 'Retails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
