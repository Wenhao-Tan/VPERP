"use strict";

/**
 * Order Grid View
 */
$(document).ready(function () {
    var btnDeleteAll = $('.order #btn-delete-orders');
    btnDeleteAll.on('click', function () {
        var keys = $('.grid-view').yiiGridView('getSelectedRows');

        $.post({
            url: 'delete',
            data: {keysList: keys},
            success: function () {
                $.pjax.reload({container: '.order-pjax-container'});
            }
        })
    });

    var btnUpdate = $('.a-update-order');
    btnUpdate.on('click', function (e) {
        $.colorbox({
            href: this.href + '&rnd=' + new Date().getTime(),
            width: 960
        });

        e.preventDefault();
    });
});