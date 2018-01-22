<?php
$this->title = Yii::t('lens', 'Update Lens Customization') . $model->ref_number;
?>

<div class="lens-customization-update col-xs-12">
    <h1><?= $this->title ?></h1>

    <hr />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>


