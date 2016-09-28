/**
 * Created by te7a on 16/08/16.
 */


   if ($('#icsr-is_serious').checked)
       $( "#showSeriousBoxes" ).show( "drop", { direction: "up" }, "slow" );
   else
       $( "#showSeriousBoxes" ).hide();

   $('#icsr-is_serious').click(function() {
       if(this.checked)
           $( "#showSeriousBoxes" ).show( "drop", { direction: "up" }, "slow" );

       else
       $( "#showSeriousBoxes" ).hide( "drop", { direction: "up" }, "slow" );
   });


function changeDates ()
{
      var patient_age = parseInt($("#icsr-patient_age").val());
      var patient_age_unit = $("#icsr-patient_age_unit option:selected").text();
      var now = new Date();

    if (patient_age_unit == "Day")
    {

        now.setDate(now.getDate() - patient_age);

        $("#icsr-patient_birth_date").datepicker('option',{ minDate: now , maxDate: new Date()});
        $("#icsr-patient_birth_date").datepicker("setDate",now);
    }

    else if (patient_age_unit == "Month")
    {

        now.setMonth(now.getMonth() - patient_age);

       $("#icsr-patient_birth_date").datepicker('option',{ minDate: now , maxDate: new Date()});
        $("#icsr-patient_birth_date").datepicker("setDate",now);
    }
    else
    {

        now.setFullYear(now.getFullYear() - patient_age);

        $("#icsr-patient_birth_date").datepicker('option',{ minDate: now , maxDate: new Date()});
        $("#icsr-patient_birth_date").datepicker("setDate",now );

    }
}




$('#Icsr').on('beforeSubmit', function(e)
{
    var form = $(this);

    if ($(form).find('.has-error').length) {
        return false;
    }

    var url = form.attr('action');
    var actionWithQueryParams = url.substr(url.lastIndexOf('/')+1);
    var actionName = actionWithQueryParams.substring(0,actionWithQueryParams.indexOf('?'));

    if (actionName == 'create') {
        var urlToController = url.substr(0, url.lastIndexOf('/'));

        $.ajax({
            url: urlToController + '/check-duplicate-icsr',
            type: 'post',
            data: form.serialize(),
            success: function (data) {
                if (data.status == 'duplicate') {
                    alert(data.message);
                }
            },
            error: function (err)
            {
                alert('something went wrong please try again');

            }
        });
    }
});