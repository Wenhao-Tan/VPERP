<?php

use yii\helpers\Html;

\common\modules\customer\assets\CustomerAsset::register($this);

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
