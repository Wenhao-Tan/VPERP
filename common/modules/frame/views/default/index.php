<?php
use yii\bootstrap\Tabs;
use common\modules\frame\Module;
use yii\bootstrap\Html;
use common\modules\frame\assets\FrameAsset;

FrameAsset::register($this);

$this->title = Module::t('frame', 'Eyeglass Frames');
?>

<h1><?= Html::encode($this->title) ?></h1>
<hr>

<?php
var_dump(Yii::$app->user->can('sales'));

echo Tabs::widget([
    'items' => [
        [
            'label' => Yii::t('frame', 'Parameters'),
            'content' => $this->render('../parameter/_gridview'),
        ],
        [
            'label' => Yii::t('frame', 'Prices'),
            'content' => $this->render('../price/_GridView'),
        ],
    ],
])
?>