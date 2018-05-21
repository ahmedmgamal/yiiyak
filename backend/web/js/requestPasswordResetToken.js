$(document).ready(function () {
    $("#passwordresetrequestform-email").focus(function(){
        $("button").removeAttr("disabled").addClass('btn-primary');
    });
});