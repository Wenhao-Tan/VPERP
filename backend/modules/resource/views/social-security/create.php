<?php

use yii\helpers\Html;
use backend\modules\resource\Module;

/* @var $this yii\web\View */
/* @var $model backend\modules\resource\models\SocialSecurity */

$this->title = Yii::t('socialSecurity', 'Create Social Security');
$this->params['breadcrumbs'][] = ['label' => Yii::t('socialSecurity', 'Social Securities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$socialSecurity = new \backend\modules\resource\models\SocialSecurity();

$default = $socialSecurity->getDefault();

$model->base_value = $default->base_value;
$model->pension_c = $default->pension_c;
$model->pension_p = $default->pension_p;
$model->medical_c = $default->medical_c;
$model->medical_p = $default->medical_p;
$model->critical_illness_c = $default->critical_illness_c;
$model->critical_illness_p = $default->critical_illness_p;
$model->employment_injury_c = $default->employment_injury_c;
$model->employment_injury_p = $default->employment_injury_p;
$model->maternity_c = $default->maternity_c;
$model->maternity_p = $default->maternity_p;
$model->unemployment_c = $default->unemployment_c;
$model->unemployment_p = $default->unemployment_p;

?>
<div class="social-security-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
