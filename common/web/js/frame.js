/**
 * Created by Paul on 2016/7/27.
 */
(function ($) {
    $('.eyeglass-frames .update').on('click', function (e) {
            $.colorbox({
            href: this.href,
            innerHeight: '125px',
            overlayClose: false,
            onClosed: function () {
                location.reload(true);
            }
        });

        e.preventDefault();
        return false;
    });

    $('.btn-delete-frames').on('click', function () {
        var keys = $('.grid-view').yiiGridView('getSelectedRows');

        $.post({
            url: 'delete',
            data: {keysList: keys},
            success: function () {
                $.pjax.reload({container: '.frame-pjax-container', timeout:false});
            }
        })
    });
})(jQuery);
