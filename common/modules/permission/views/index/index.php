<?php
use yii\bootstrap\Tabs;

$this->title = "Permissions";
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
            'content' => $this->render('create',[
                'models' => $model,
                'assignModel' => $assignModel,
            ]),
        ],
    ],
]);
?>
