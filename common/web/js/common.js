$('.colorbox').on('click', function (e) {
    e.preventDefault();

    $.colorbox({
        href: this.href,
        width: 960
    })
});