/**
 * Created by Administrator on 2016-07-30.
 */
(function ($) {
    var selectMaterial = $('#customize-material');
    var selectPrescriptionType = $('#customize-prescription_type');
    var selectColorType = $('#customize-color_type');

    var rightCYL = $('#customize-r_cyl');
    var rightAXS = $('#customize-r_axs');
    var rightADD = $('#customize-r_add');

    var leftCYL = $('#customize-l_cyl');
    var leftAXS = $('#customize-l_axs');
    var leftADD = $('#customize-l_add');

    function init()
    {
        updatePrescription();
    }

    function updateRefractiveIndex()
    {
        var selectRefractiveIndex = $('#customize-refractive_index');

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

    function updatePrescriptionLensType(PrescriptionType)
    {
        var selectPrescriptionLensType = $('#customize-prescription_lens_type');

        if(PrescriptionType != 'Single Vision') {
            selectPrescriptionLensType.prop('disabled', false);
        } else {
            selectPrescriptionLensType.prop('disabled', true);
        }

        $.ajax({
            url: 'ajax',
            type: 'post',
            data: {prescription_type: selectPrescriptionType.val()},
            dataType: 'json'
        }).done(function (data) {
            console.log(data);
            selectPrescriptionLensType.find('option').remove();
            $.each(data, function (key, value) {
                selectPrescriptionLensType.append('<option value="' + value + '">' + value + '</option>');
            } )
        })
    }

    function updateColors()
    {
        var selectColors = $('#customize-color');

        if(selectColorType.val() != 'Clear') {
            selectColors.prop('disabled', false);
        } else {
            selectColors.prop('disabled', true);
        }
    }

    function updatePrescription(PrescriptionTypeValue)
    {

        if(!PrescriptionTypeValue) {
            PrescriptionTypeValue = $('#customize-prescription_type').val();
        }

        if(PrescriptionTypeValue == 'Single Vision') {
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

    selectPrescriptionType.change(function () {
        var PrescriptionTypeValue = selectPrescriptionType.val();

        updatePrescriptionLensType(PrescriptionTypeValue);
        updatePrescription(PrescriptionTypeValue);
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