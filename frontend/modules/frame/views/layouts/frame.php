<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2018/3/5
 * Time: 8:54
 */

\frontend\modules\frame\assets\FrameAsset::register($this);
?>

<?php $this->beginContent('@frontend/views/layouts/erp.php'); ?>
<div class="Content">
    <?= $content ?>
</div>
<?php $this->endContent(); ?>

