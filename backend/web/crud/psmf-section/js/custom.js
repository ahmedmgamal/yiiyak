$('#addSection').on('click',function () {

    var section= $('.psmf-section').first().clone();
    section.find('input').val("");
    section.find('textarea').val("");
    $('.psmf-sections').append('<hr>');
    $('.psmf-sections').append(section);
});