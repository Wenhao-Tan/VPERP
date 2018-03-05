// $.pjax.reload({container: '#pjax-frame-grid'});


/* --- Frame Price GridView --- */

    $('#frame-price-grid .update-price').on('click', function (e) {
        e.preventDefault();

        $.colorbox({
            href: this.href
        });
    });

    $('.price-multiple-updates').on('click', function (e) {
        e.preventDefault();

        var keys = $('#frame-price-grid').yiiGridView('getSelectedRows');

        $.colorbox({
            href: this.href + '?keyList=' + keys.join(',')
        });
    });

