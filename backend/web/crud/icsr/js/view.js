$( document ).ready(function() {
    function render(data){
        var versions = data.versions;
        var rendered = '';
        $.each(versions,function(key, value){

            rendered +=
                '<tr>' +
                    '<td>' +
                        '<a href=download-xml-file?path=' +
                            value.file_url
                                .substring(value.file_url.indexOf('/files'), value.file_url.length) +
                        '>Download</a>'+
                    '</td>'+
                    '<td>' +
                        '<a target="_blank" href=open-pdf?path=' +
                        value.file_url
                            .substring(value.file_url.indexOf('/files'), value.file_url.length) +
                        '>Open</a>'+
                    '</td>'+
                    '<td>' +
                        value.version_no+
                    '</td>'+
                    '<td>' +
                        '<a class="versionDiff btn btn-default" href="get-diff-before-date?icsrId='+
                            value.icsr_id+'&date='+value.export_date+'&versionNo='+value.version_no+
                        '"><span class="glyphicon glyphicon-retweet"></span></a>'+
                    '</td>'+
                    '<td>' +
                        value.export_date+
                    '</td>'+
                '<td>'+value.username+'</td>'+
                '<td>'+value.response+'</td>'+
                '<td>'+value.response_date+'</td>'+
                '<td>' +
                '<a class="btn btn-primary" href="+ value.send_href+"><span class="glyphicon glyphicon-envelope"></span></a>'+
                '</td>'+
                '</tr>';
        });
        var html = $.parseHTML( rendered );
        $('#pjax-IcsrVersions table.table-bordered tbody').html(html);

        var version = $('a[href="#relation-tabs-tab7"] small span');
        version.text(parseInt(data.versionsCount));
    }
    function changeValidations(){
        var url = window.location.href;
        $.ajax({
            'url': url,
            'method':'GET',
            'success': function (response) {
                render(response);
            }
        });
    }
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

                    filePathFromSlashFile = redirectUrl.substr(redirectUrl.lastIndexOf('/files')+1);
                    //this will get the path from /files to the end

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
                changeValidations();
                return;
            }

            progressVal = progressVal +10;
            progressBar.progressbar({
                value: progressVal
            });

        }, 1000);


    });


    $('.versionDiff').on('click', function (event){
        event.preventDefault();
        ajaxUrl = $(this).attr('href');

        $.ajax({
            'url' : ajaxUrl,
            'method' : 'GET',
            'success' : function (response) {

                $('#fromVer').html(response.fromVer);
                $('#toVer').html(response.toVer);

                var diffs = response.diffs;



                $('#diffTable').find("tr:gt(0)").remove();

                var htmlRows = '';
                for (var i=0; i<diffs.length ; i++)
                {
                    var field = (diffs[i].field || false) ? diffs[i].field.replace(/,/g,'<br>') : '';
                    var old_value = (diffs[i].old_value || false) ? diffs[i].old_value.replace(/,/g,'<br>') : '';
                    var new_value = (diffs[i].new_value || false) ? diffs[i].new_value.replace(/,/g,'<br>') : '';


                    htmlRows += '<tr>'

                    htmlRows += "<td>" + diffs[i].user_id+ "</td>"
                    htmlRows += "<td>" +diffs[i].action+ "</td>"
                    htmlRows += "<td>" +diffs[i].model+ "</td>"
                    htmlRows += "<td>" + field + "</td>"
                    htmlRows += "<td>" +old_value+ "</td>"
                    htmlRows += "<td>" +new_value+ "</td>"
                    htmlRows += "<td>" +diffs[i].created+ "</td>"

                    htmlRows += '</tr>'
                }


                $('#diffTable').append(htmlRows);

                $('#myModal').modal('show');
            }
        });
    });



});