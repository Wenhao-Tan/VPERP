<?php

use kartik\grid\GridView;

$dataProvider = new \yii\data\ActiveDataProvider([
    'query' => $model->getAddresses(),
])
?>

<div class="address">
    <div id="grid-view">
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'columns' => [
                [
                    'class' => 'kartik\grid\SerialColumn',
                ],
                [
                        'attribute' => 'name',
                    'label' => 'Receiver\'s Name',
                ],
                'company',
                [
                    'label' => 'Street',
                    'value' => function ($model) {
                        return $model->street_1 . ' ' . $model->street_2;
                    },
                ],
                'city',
                'state',
                'country',
                'zip_code',
                'mobile_phone',
                'other_phone',
            ],
        ]);
        ?>
    </div>
    <?php
    echo $this->render('address_form');
    ?>
</div>
