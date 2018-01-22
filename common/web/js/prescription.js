/**
 * Created by Administrator on 2016-07-30.
 */
(function ($) {
    var selectMaterial = $('#lenscustomform-material');
    var selectDiopterType = $('#lenscustomform-diopter_type');
    var selectColorType = $('#lenscustomform-color_type');

    var rightCYL = $('#lenscustomform-r_cyl');
    var rightAXS = $('#lenscustomform-r_axs');
    var rightADD = $('#lenscustomform-r_add');

    var leftCYL = $('#lenscustomform-l_cyl');
    var leftAXS = $('#lenscustomform-l_axs');
    var leftADD = $('#lenscustomform-l_add');

    function init()
    {
        updatePrescription();
    }

    function updateRefractiveIndex()
    {
        var selectRefractiveIndex = $('#lenscustomform-refractive_index');

        $.ajax({
            url: 'ajax',
            type: 'POST',
            data: {material: selectMaterial.val()},
            dataType: 'json'
        }).done(function (data) {
            selectRefractiveIndex.find('option').remove();
            $.each(data, function (key, value) {
                selectRefractiveIndex.append('<option value="' + value + '">' + value + '</option>');
            })
        })
    }

    function updateDiopterLensType(diopterType)
    {
        var selectDiopterLensType = $('#lenscustomform-diopter_lens_type');

        if(diopterType != 'Single Vision') {
            selectDiopterLensType.prop('disabled', false);
        } else {
            selectDiopterLensType.prop('disabled', true);
        }

        $.ajax({
            url: 'ajax',
            type: 'post',
            data: {diopter_type: selectDiopterType.val()},
            dataType: 'json'
        }).done(function (data) {
            selectDiopterLensType.find('option').remove();
            $.each(data, function (key, value) {
                selectDiopterLensType.append('<option value="' + value + '">' + value + '</option>');
            } )
        })
    }

    function updateColors()
    {
        var selectColors = $('#lenscustomform-color');

        if(selectColorType.val() != 'Clear') {
            selectColors.prop('disabled', false);
        } else {
            selectColors.prop('disabled', true);
        }
    }

    function updatePrescription(diopterTypeValue)
    {

        if(!diopterTypeValue) {
            diopterTypeValue = $('#lenscustomform-diopter_type').val();
        }

        if(diopterTypeValue == 'Single Vision') {
            rightADD.prop('disabled', true);
            leftADD.prop('disabled', true);
        } else {
            rightADD.prop('disabled', false);
            leftADD.prop('disabled', false);
        }

        if(rightCYL.val() == 0.00) {
            rightAXS.prop('disabled', true);
        } else {
            rightAXS.prop('disabled', false);
        }
        if(leftCYL.val() == 0.00) {
            leftAXS.prop('disabled', true);
        } else {
            leftAXS.prop('disabled', false);
        }
    }

    /*--- Process Functions ---*/
    $(document).ready(function () {
        init();
    });

    selectMaterial.change(function () {
        updateRefractiveIndex();
    });

    selectDiopterType.change(function () {
        var diopterTypeValue = selectDiopterType.val();

        updateDiopterLensType(diopterTypeValue);
        updatePrescription(diopterTypeValue);
    });

    selectColorType.change(function() {
        updateColors();
    });

    rightCYL.change(function () {
        updatePrescription();
    });
    leftCYL.change(function () {
        updatePrescription();
    });
})(jQuery);