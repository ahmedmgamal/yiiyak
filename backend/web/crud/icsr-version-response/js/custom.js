$('#responseType').change(function () {

var responseType = $('#responseType').val();
var replaceTag = '';

    if (responseType == 'file')
    {
         replaceTag = '<input type="file" id="icsrversionresponse-xmlfile" name="IcsrVersionResponse[xmlFile]">';

    }

    else if (responseType == 'id')
    {

         replaceTag = '<input type="text" id="icsrversionresponse-response" class="form-control" name="IcsrVersionResponse[response]" maxlength="255">';

    }
    else
    {
        replaceTag = '<input type="checkbox" id="icsrversionresponse-response" name="IcsrVersionResponse[response]" value="received" >';

    }

    $('#icsrversionresponse-response').replaceWith(replaceTag);
    $('#icsrversionresponse-xmlfile').replaceWith(replaceTag);
});