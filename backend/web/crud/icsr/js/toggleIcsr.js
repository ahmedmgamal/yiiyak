
$(document).ready(function(){
    $('.toggleIcsr').click(function () {
        $('.toggleIcsr').toggleClass('btn-success').toggleClass('btn-default');
        $('.toggleIcsrModel').toggle();
    });
    $(window).on('load', function(){
        var offset = new Date().getTimezoneOffset();
        var created_at = $('.toggleIcsrModel table tbody tr td:last-child');
        created_at.text(
            new  Date(created_at.text() + offset).toISOString()
        );
    });

});