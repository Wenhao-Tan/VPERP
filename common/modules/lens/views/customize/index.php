<?php
use kartik\tabs\TabsX;
use common\modules\lens\assets\LensAsset;

LensAsset::register($this);

// Page Title
$this->title = 'Lens Customization';

?>

<div class="lens-custom">
    <?php
    echo TabsX::widget([
        'position' => 'top',
        'items' => [
            [
                'label' => 'View',
                'content' => $this->render('view', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'suppliers' => $suppliers,
                    'updateContents' => $updateContents,
                ]),
                'active' => true,
            ],
            [
                'label' => 'Create',
                'content' => $this->render('create', [
                        'model' => $model,
                    ]
                ),
            ],
        ],
    ])
    ?>
</div>