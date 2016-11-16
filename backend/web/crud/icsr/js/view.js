$( document ).ready(function() {

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
               $('#failedValidation').text(response.failedMessage);
           }

        },
        'error' : function (error){
            passedValidation = false;
            //in case internal server error
            $('#failedValidation').text('can\'t export xml now please try again later');
        }
    });



    var startTime = new Date().getTime();
    var interval = setInterval(function(){

        if(new Date().getTime() - startTime > 5000)
        {
            $('#validating').hide();
            $('#dtdValidating').show().fadeTo(1000, 0.5).fadeTo(500, 1.0);
        }
        else
            {
                $('#validating').show().fadeTo(1000, 0.5).fadeTo(500, 1.0);
            }

        if(new Date().getTime() - startTime > 10000){
            clearInterval(interval);
            if (passedValidation) {
                controllerUrl = targetUrl.substr(0,(targetUrl.lastIndexOf('/')+1));

                //this will get the path from /files to the end
                filePathFromSlashFile = redirectUrl.substr(redirectUrl.lastIndexOf('/web')+4);

                $('#dtdValidating').hide();
                progressBar.hide();
                $('#validating').hide();
                $('#downloadFileAnchorTag').attr('href',baseUrl+controllerUrl+'download-xml-file?path='+filePathFromSlashFile);
                $('#downloadFile').show();
            }

            else
            {
                $('#dtdValidating').hide();
                progressBar.hide();
                $('#validating').hide();
                $('#failedValidation').show();
            }
            return;
        }

        progressVal = progressVal +10;
        progressBar.progressbar({
            value: progressVal
        });

    }, 1000);


});



});

