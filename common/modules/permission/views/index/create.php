<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

use common\modules\permission\models\AuthItem;
use common\models\User;

$roles = AuthItem::find()
    ->select('name')
    ->where(['type' => \yii\rbac\Item::TYPE_ROLE])
    ->indexBy('name')
    ->column();
$userIds = User::find()->select('username')->indexBy('id')->column();
foreach ($userIds as $id => $username) {
    $userIds[$id] = $id . ' - ' . $username;
}
?>

<div class="row">
    <div class="col-sm-6">
        <h2><?= Yii::t('app', 'Create Permission & Role') ?></h2>
        <?php $form = ActiveForm::begin([
            'id' => 'form-create-permission'
        ]) ?>

        <?= $form->field($model, 'permission') ?>
        <?= $form->field($model, 'role') ?>

        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

        <?php ActiveForm::end() ?>

        <hr class="clear">

        <h2><?= Yii::t('app', 'Assign Role') ?></h2>
        <?php $form = ActiveForm::begin([
            'id' => 'form-assign-role'
        ]) ?>

        <div class="row">
            <?= $form->field($assignModel, 'role', ['options' => ['class' => 'col-sm-6']])->dropDownList($roles) ?>
            <?= $form->field($assignModel, 'userId', ['options' => ['class' => 'col-sm-6']])->dropDownList($userIds) ?>
        </div>

        <?= Html::submitButton('Assign', ['class' => 'btn btn-primary']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>