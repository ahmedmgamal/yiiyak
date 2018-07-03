
$(document).ready(function(){
    $('.toggleIcsr').click(function () {
        $('.toggleIcsr').toggleClass('btn-success').toggleClass('btn-default');
        $('.toggleIcsrModel').toggle();
    });

    var cells = [];
    function convertUTCDateToLocalDate(date) {
        var newDate = new Date(date.getTime()+date.getTimezoneOffset()*60*1000);

        var offset = date.getTimezoneOffset() / 60;
        var hours = date.getHours();

        newDate.setHours(hours - offset);

        return newDate;
    }
    $('.toggleIcsrModel table tbody tr  td:last-of-type').each(function() {

        cells.push($(this).html());
    });
    $.each(cells , function(index,val) {
        var date = convertUTCDateToLocalDate(new Date(val));
        cells[index]= date.toLocaleString();
        $('.toggleIcsrModel table tbody tr  td:last-of-type').eq( index ).html(cells[index]);
    });

});