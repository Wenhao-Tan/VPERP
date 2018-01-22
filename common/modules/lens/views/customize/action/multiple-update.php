<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


$updateColumns = ArrayHelper::getColumn($updateContents, 'column');
$updateColumns = array_combine($updateColumns, $updateColumns);

$updateValues = ArrayHelper::map($updateContents, 'column', 'value');
?>

<form class="form-inline">
    <div class="form-group">
        <?= Html::button('Update', ['id' => 'btn-update', 'class' => 'btn btn-primary']) ?>
    </div>

    <div id="update-form" class="form-group" style="display: none;">
        <div class="form-group">
            <?= Html::dropDownList('updateColumn', '', $updateColumns, ['id' => 'update-column', 'class' => 'form-control', 'prompt' => '--- Select ---']) ?>
            =>
            <?= Html::dropDownList('updateValue', '', [], ['id' => 'update-value', 'class' => 'form-control', ]) ?>
        </div>

        <div class="form-group">
            <?= Html::button('Confirm', ['id' => 'confirm-update', 'class' => 'btn btn-primary']) ?>
        </div>
        <div class="form-group">
            <?= Html::button('Cancel', ['id' => 'cancel-update', 'class' => 'btn btn-default']) ?>
        </div>
    </div>
</form>


<script type="text/javascript">
    $(document).ready(function () {
        /* --- Click button 'update' --- */
        $('button#btn-update').on('click', function () {
            $(this).css('display', 'none');
            $('#update-form').fadeIn('slow');
        });

        /* --- Click button 'cancel' --- */
        $('button#cancel-update').on('click', function () {
            $('#update-form').css('display', 'none');
            $('button#btn-update').fadeIn('slow');
        });

        /**
         * Select Column and refresh the Options of Select
         */
        var updateValues = <?php echo json_encode($updateValues) ?>;

        $('#update-column').on('change', function () {
            var column = this.value;

            $('#update-value').find('option').remove();
            for (updateValue in updateValues[column]) {
                $('<option />', {value : updateValue}).text(updateValue).appendTo($('#update-value'));
            }
        })

        /**
         * Click button 'Confirm'
         */
        $('button#confirm-update').on('click', function () {
            var primaryKeys = $('.grid-view').yiiGridView('getSelectedRows');
            var updateColumn = $('#update-column').val();
            var updateValue = $('#update-value').val();

            console.log(updateValue);

            $.post({
                url: 'custom-update',
                data: {pks: primaryKeys, column: updateColumn, value: updateValue},
                success: function (data) {
                    $.pjax.reload({container: '.lens-pjax-container', timeout: false})
                }
            });
        })
    })
</script>