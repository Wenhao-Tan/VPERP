<?php
$this->title = 'Create an order';

\common\modules\order\assets\CreateAsset::register($this);
?>

<div class="row">
    <div class="col-sm-8">
        <?php
        echo $this->render('_form', [
            'model' => $model,
        ]);
        ?>
    </div>
</div>