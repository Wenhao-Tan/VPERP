<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>

<div class="set-password">
    <?php
    $model->username = $user->username;

    $form = ActiveForm::begin([
        'id' => 'form-set-password'
    ]);
    ?>

    <?= $form->field($model, 'username')->textInput(['readonly'=>true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['id' => 'password']) ?>

    <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary', 'id' => 'btn-set-password']) ?>

    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    var btnSetPassword = $('#btn-set-password');
    btnSetPassword.on('click', function () {
        var password = $('#password');
        $.ajax({
            type: 'POST',
            url: 'set-password' + '?id=<?= $_GET['id'] ?>',
            data: $('#form-set-password').serialize()
        })
            .done(function () {
                parent.$.colorbox.close();
                parent.location.reload();
            });
    });
</script>