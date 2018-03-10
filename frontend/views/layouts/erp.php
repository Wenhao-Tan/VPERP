<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 2016/5/27
 * Time: 7:35
 */

use yii\helpers\Html;

$controller_id = Yii::$app->controller->id;
$action_id = Yii::$app->controller->action->id;
$page_name = $controller_id . '-' . $action_id;

$module_id = Yii::$app->controller->module->id;
if ($module_id) {
    $page_name = $module_id . '-' . $page_name;
}
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="title-header row">
    <div class="col-xs-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
</div>

<hr />

<div id="<?= $page_name ?>" class="Content">
    <?= $content ?>
</div>
<?php $this->endContent(); ?>
