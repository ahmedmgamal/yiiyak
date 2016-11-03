$( document ).ready(function() {



continueFlag = false;
$('#exportXml').on('click',function (e) {

    progressVal = 1;
    baseUrl = window.location.origin;
    targetUrl = $(this).attr('href');
    e.preventDefault();

    passedValidation = false;

    redirectUrl = false;

    progressBar = $('#progressbar');
    progressBar.progressbar({
        value: false
    }).show();
    $('#validating').show();
    $('#failedValidation').hide();

    $.ajax({
        'url' : baseUrl+targetUrl,
        'method':'GET',
        async: false,
        'success': function (response){

           if (response.fileUrl != undefined)
           {
               passedValidation = true;
               redirectUrl = response.fileUrl;
           }
           else {
               passedValidation = false;
           }

        },
        'error' : function (error){
            passedValidation = false;
        }
    });



    var startTime = new Date().getTime();
    var interval = setInterval(function(){
        if(new Date().getTime() - startTime > 10000){
            clearInterval(interval);
            if (passedValidation) {
                $(location).attr("href", baseUrl + redirectUrl);
            }

            else
            {
                $('#failedValidation').show();
                progressBar.hide();
                $('#validating').hide();
            }
            return;
        }
        $('#validating').show().fadeTo(1000, 0.5).fadeTo(500, 1.0);
        progressVal = progressVal +10;
        progressBar.progressbar({
            value: progressVal
        });

    }, 1000);


});



});

