
$(document).ready(function(){
    $('.toggleIcsr').click(function () {
        $('.toggleIcsr').toggleClass('btn-success').toggleClass('btn-default');
        $('.toggleIcsrModel').toggle();
    });
});