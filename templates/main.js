$(function () {

    var container = $('.container');
    var md_bl_bg = $("<div class='modal-billing-bg'></div>");
    var md_bl = $("<div class='modal-billing'></div>");

    function loader() {

        $(container).append("<p class='loader'>Загрузка...</p>");
    }

    $('body').on('click', '.modal-billing-bg', function (e) {

        if ($(e.target).is('.modal-billing-bg')) {

            $(this).fadeOut(function () {
                $(this).remove();
            });
        }
    });

    $('#agency_list').on('submit', function (e) {

        e.preventDefault();

        loader();

        $.post('', {form_data: $(this).serialize() || {}}, function (data_html) {

            $(container).html($(data_html).filter('.container').html() || data_html);

        }, 'html');
        return false;
    });

    $('body').on('reset', 'form', function () {

        $(this).find("input:not([type='checkbox'])").attr('value', '')
                .filter(':checked').attr('checked', false);
    });

    $(".date-pick").datepicker({
        dateFormat: "dd.mm.yy"
    });

    $('body').on('click', 'table.agency tr:not(.no-billing)', function () {

        var id = $(this).data('billing-id');

        loader();
        var mb_cl_bg = md_bl_bg.clone();
        var mb_cl = md_bl.clone();
        var x = $(this).offset().left;
        var y = $(this).offset().top;

        mb_cl_bg.append(mb_cl);
        $('body').append(mb_cl_bg);

        mb_cl.offset({top: y, left: x});


        $.post('add_edit/' + id, function (data_html) {

            $('.loader').remove();
            mb_cl.html(data_html);

        }, 'html');

        return false;
    });

    $('.button.add-billing').on('click', function () {

        loader();
        var mb_cl_bg = md_bl_bg.clone();
        var mb_cl = md_bl.clone();

        mb_cl_bg.append(mb_cl);
        $('body').append(mb_cl_bg);

        $.post('add_edit', function (data_html) {

            $('.loader').remove();
            mb_cl.html(data_html);

        }, 'html');
    });

    $('body').on('submit', '#billing_add', function (e) {

        e.preventDefault();

        loader();

        $.post($(this).attr('action'), {form_data: $(this).serialize()}, function (h) {

            window.location.href = '/';

        }, 'html');
        return false;
    })
});
