<?php

use yii\helpers\Html;

\frontend\modules\order\assets\OrderAsset::register($this);

?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="title-header row">
    <div class="col-xs-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
</div>

<hr/>

<div class="Content">
    <?= $content ?>
</div>
<?php $this->endContent(); ?>
