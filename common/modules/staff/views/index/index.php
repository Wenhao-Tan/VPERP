<?php
use yii\bootstrap\Tabs;

\common\modules\staff\assets\StaffAsset::register($this);

$this->title = 'Staff Information';
?>

<?php
echo Tabs::widget([
    'items' => [
        [
            'label' => 'View',
            'content' => $this->render('view'),
        ],
        [
            'label' => 'Create',
            'content' => $this->render('create', [
                'scenario' => $scenario,
                'models' => $model,
            ])
        ],
    ],
]);
?>


