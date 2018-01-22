/*
var btnAddSalary = $('.btn-add-salary');
btnAddSalary.on('click', function (e) {
    e.preventDefault();

    $.colorbox({
        href: 'add',
        width: 960
    })
});
    */

$('.colorbox').on('click', function (e) {
    e.preventDefault();

    $.colorbox({
        href: this.href,
        width: 960
    });
});