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
