$('#drugprescription-use_date_start').datepicker({ dateFormat: 'yy-mm-dd',onSelect: function (dateText,inst){
    changeDurationUseAndUnit($(this).datepicker( 'getDate' ),$('#drugprescription-use_date_end').datepicker('getDate'));
}});


$('#drugprescription-use_date_end').datepicker({dateFormat: 'yy-mm-dd',onSelect: function (dateText,inst){
    changeDurationUseAndUnit($('#drugprescription-use_date_start').datepicker('getDate'),$(this).datepicker( 'getDate' ));
}});


function changeDates ()
{
     var duration_of_use = parseInt($("#drugprescription-duration_of_use").val());
     var duration_unit = $("#drugprescription-duration_of_use_unit option:selected").text();
     var now = new Date();

    if (duration_unit == "Day")
        {
            now.setDate(now.getDate() + duration_of_use);
        }

    else if (duration_unit == "Month")
    {
          now.setMonth(now.getMonth() + duration_of_use);
    }
   else
    {
       now.setFullYear(now.getFullYear() + duration_of_use);
    }

    $('#drugprescription-use_date_start').datepicker("setDate",new Date());
    $('#drugprescription-use_date_end').datepicker("setDate",now);

}


function changeDurationUseAndUnit ( start_date ,end_date)
{
   if ( start_date != null && end_date != null)
   {
       var duration_unit = $("#drugprescription-duration_of_use_unit option:selected").text();
       if (duration_unit == "Day")
       {
          var oneDay = 24*60*60*1000;
          duration = Math.round(Math.abs((end_date.getTime() - start_date.getTime())/(oneDay)));
       }

       else if (duration_unit == "Month")
       {
          duration = end_date.getMonth() - start_date.getMonth() + (12 * (end_date.getFullYear() - start_date.getFullYear()));
       }
       else
       {
         duration = end_date.getFullYear() - start_date.getFullYear();
       }

       $("#drugprescription-duration_of_use").val(duration);
   }


}