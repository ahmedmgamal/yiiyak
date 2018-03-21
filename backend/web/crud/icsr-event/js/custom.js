$('#icsrevent-meddra_pt_text').on('input',function ()
{
    var url = window.location.href;
    url = url.substring(0,url.lastIndexOf("/"));

    var searchTerm = $(this).val();
    $.ajax(
        {
            'url' : url +'/search-pt?term='+searchTerm,
            'method' : 'GET',
            'success' : function (response)
            {
                if(response.ptTerms.length > 0){
                    $('#icsrevent-meddra_pt_text').autocomplete(
                        {
                            minLength: 5,
                            source: response.ptTerms,
                            select : function (event, ui) {
                                $(this).val(ui.item.label);
                                $('#meddra_pt_id').val(ui.item.value);
                                return false;
                            }
                        }).autocomplete( 'instance' )._renderItem = function( ul, item ) {
                        return $( '<li>' )
                            .append( '<div>' + item.label  +'</div>' )
                            .appendTo( ul );
                    };
                }


            }
        }
    );

});

$('#icsrevent-meddra_llt_text').on('input',function () {

    var pt = $('#icsrevent-meddra_pt_text').val();

    var url = window.location.href;
    url = url.substring(0,url.lastIndexOf("/"));

    var searchTerm = $(this).val();

    $.ajax(
        {
            'url': url + '/search-llt?ptTerm='+pt.trim()+'&searchTerm='+searchTerm,
            'method' : 'GET',
            'success' : function (response) {
                if(response.length > 0){
                    $('#icsrevent-meddra_llt_text').autocomplete(
                        {
                            minLength: 5,
                            source: response,
                            select : function (event, ui) {
                                $(this).val(ui.item.label);
                                $('#meddra_llt_id').val(ui.item.value);
                                return false;
                            }
                        }).autocomplete( 'instance' )._renderItem = function( ul, item ) {
                        return $( '<li>' )
                            .append( '<div>' + item.label  +'</div>' )
                            .appendTo( ul );
                    };
                }

            }
        }
    );


});



$('#icsrevent-meddra_llt_text').on('focusout',function () {

    var url = window.location.href;
    url = url.substring(0,url.lastIndexOf("/"));
$.ajax({
    'url' : url + '/get-pt-from-lt?lltTerm='+ $(this).val(),
    'method' : 'GET',
    'success' : function (response){
        if (response.ptTerm )
        {
            $('#icsrevent-meddra_pt_text').val(response.ptTerm.term);
            $('#meddra_pt_id').val(response.ptTerm.id);
        }
    }
});
});