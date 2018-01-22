/**
 * Created by Paul on 2016/8/4.
 */
(function ($) {
    $('.lens-custom .update').on('click', function (e) {
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
})(jQuery);
