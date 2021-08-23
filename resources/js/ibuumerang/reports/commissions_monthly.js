function getPayoutByLevel(type, period, week, level) {

    var data = {};

    if (type != '')
        data['type'] = type;

    if (period != '')
        data['period'] = period;

    if (week != '')
        data['week'] = week;

    if (level != '')
        data['level'] = level;

    $.ajax({ 
        url: "commission-details-level",
        data: data,
    }).done(function(body) {
        $('#tableDetails').html(body);
        $('#table_details').DataTable({
            responsive: true,
            searching: true,  
            order: [[0, "desc"]],
            drawCallback: function () {
                $("#tableDetails input[type='search']").css({width: "80%"});
            }
        });
        $('#modalCommissionMonthly').modal('show');
        
    });
}
 
$(document).ready(function() {
    array = [];

    for ( var i = 0; i < resume.length; i++ ){

        var oItem = {};

        oItem.label = type + resume[i].level;
        oItem.value = parseFloat(resume[i].amount).toFixed(2);
        array.push(oItem);
    }

    showLoading();

    $('#fast-start-bonus-table').DataTable({
    
    });

    $('#montly-commissions-table').DataTable({
    
    });

    Morris.Donut({
        element: 'monthly-donut-chart',
        data: array,
        formatter: function (value, data) { return Number(value).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) + '\n' + (value/total *100).toFixed(2) + '%'; },
        resize: true,
        colors: ['#7ad7ff', '#1dbcfe','#0192d1', '#0673d0', '#398dd6', '#2a5983', '#4889c2'],
    });
});