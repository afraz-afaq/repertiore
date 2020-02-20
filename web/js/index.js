// Shorthand for $( document ).ready()
$(function() {
    $(document).on('click', '.onCollapse', function () {

        var collapse_id = $(this).attr('href');
        var check = $(collapse_id).attr('aria-expanded');
        if (check == "true") {
            window.alert(check);
            $(this).children().first().attr('src', 'web/images/close.png');
        } else if (check == "false") {
            window.alert(check);
            $(this).children().first().attr('src', 'web/images/expand.png');
        }

    });

});