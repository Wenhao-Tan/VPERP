<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use backend\modules\resource\Module;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\resource\models\SocialSecuritySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('socialSecurity', 'Social Securities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-security-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['models' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('socialSecurity', 'Create Social Security'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'month',
            'base_value',
            'pension_c',
            'pension_p',
            'medical_c',
            'medical_p',
            'critical_illness_c',
            'critical_illness_p',
            'employment_injury_c',
            'employment_injury_p',
            'maternity_c',
            'maternity_p',
            'unemployment_c',
            'unemployment_p',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
