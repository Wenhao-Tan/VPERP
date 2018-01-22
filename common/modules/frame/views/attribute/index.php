<?php
use kartik\tabs\TabsX;
use common\modules\frame\Module;
/* @var $this yii\web\View */

$this->title = Module::t('frame', 'Attribute');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= \yii\bootstrap\Html::encode($this->title) ?></h1>
<hr>

<?php
echo TabsX::widget([
    'position' => 'left',
    'items' => [
        [
            'label' => Yii::t('frame', 'Material'),
            'content' => $this->render('material'),
        ],
        [
            'label' => Yii::t('frame', 'Rim Type'),
            'content' => 'Rim Type',
        ],
        [
            'label' => Module::t('frame', 'Shape'),
            'content' => 'Shape'
        ],
    ],
])
?>