<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>


<h2>Create User</h2>
<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
<div class="row">
    <?= $form->field($model, 'username', ['options' => ['class' => 'col-sm-2']])
        ->textInput() ?>

    <?= $form->field($model, 'email', ['options' => ['class' => 'col-sm-2']])
        ->textInput(['readonly' => true, 'onfocus' => 'this.removeAttribute("readonly")']) ?>

    <?= $form->field($model, 'password', ['options' => ['class' => 'col-sm-2']])
        ->passwordInput() ?>
</div>


<div class="form-group">
    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
</div>

<?php ActiveForm::end(); ?>


