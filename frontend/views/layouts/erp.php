<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2016/5/27
 * Time: 7:35
 */

use yii\helpers\Html;

?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="title-header row">
    <div class="col-xs-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
</div>

<hr />

<div class="Content">
    <?= $content ?>
</div>
<?php $this->endContent(); ?>
