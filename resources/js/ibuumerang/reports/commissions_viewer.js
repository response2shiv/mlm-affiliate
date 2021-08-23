function getCommission(year) {

    var myResponse = [];

    $.ajax({
        async: false,
        url: "api-request",
        data: { 
            data: {
                year: year
            },
            method: "POST", 
            endpoint: '/affiliate/commission-viewer'  
        }
        }).done(function(res) {

        var total_fsb = total_tsb = total_leadership = total_unilevel = total_dual_team = total = 0;

        // Fill tables
        $.each(res.data.graphs, function (key, item) {
            total_fsb += Number(item.fsb ? item.fsb : 0);
            total_tsb += Number(item.tsb ? item.tsb : 0);
            total_leadership += Number(item.leadership ? item.leadership : 0);
            total_unilevel += Number(item.unilevel ? item.unilevel : 0);
            total_dual_team += Number(item.dual_team ? item.dual_team : 0);
        });

        totalComission = total_unilevel + total_leadership + total_tsb + total_fsb + total_dual_team;
        
        totalLifetime = parseFloat(totalComission);
        totalLifetime = totalLifetime.toLocaleString('en-US', { style: 'currency', currency: 'USD' });

        // Clear Graphs
        $("#commission-tracking-donut-chart").empty();
        $("#commission-tracking-area-chart").empty(); 
        
        // Fill the title for Lifetime Earnings
        $("#lifetime_total").text(totalLifetime);

        // Fill the Graphs
        Morris.Donut({
            element: 'commission-tracking-donut-chart',
            data: [
                { label: "FSB", value: total_fsb },
                { label: "TSB", value: total_tsb },
                { label: "LIB", value: total_leadership },
                { label: "Unilevel", value: total_unilevel } ,
                { label: "Dual-Team", value: total_dual_team } 
            ],
            resize: true,
            formatter: function (value, data) {
                return Number(value).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) + '\n' + (Number(value)/Number(totalComission) *100).toFixed(2) + '%'; 
            },
            colors: ['#7ad7ff', '#1dbcfe','#0192d1', '#0673d0', '#0055b2'], 
        });

        Morris.Area({
            element: 'commission-tracking-area-chart',
            data: res.data.graphs,
            xkey: 'period',
            xLabels: 'month',
            ykeys: ['fsb', 'tsb', 'leadership', 'unilevel', 'dual_team'],
            labels: ['FSB', 'TSB', 'LIB', 'Unilevel', 'Dual-Team'],
            yLabelFormat: function (value) { return value ? Number(value).toLocaleString('en-US', { style: 'currency', currency: 'USD' }) : '-'; },
            pointSize: 2,
            hideHover: 'auto',
            resize: true,
            lineColors: ['#7ad7ff', '#1dbcfe','#0192d1', '#0673d0', '#0055b2'],
            lineWidth:2, 
            pointSize:1,
        });
        
        // Clear tab monthly
        $('#monthly_commission').html('');
        $('#total_monthly_commission').html('');

        // Fill tables

        var total_fsb = total_tsb = total_leadership = total_unilevel = total = total_header = total_header_unilevel = total_header_leadership = total_header_tsb = 0;

        $.each(res.data.resume, function (key, item) {

            total_fsb = Number(item.fsb ? item.fsb : 0);
            total_tsb = Number(item.tsb ? item.tsb : 0);
            total_leadership = Number(item.leadership ? item.leadership : 0);
            total_unilevel = Number(item.unilevel ? item.unilevel : 0);
            total = parseFloat(total_unilevel + total_leadership + total_tsb);

            total_header += total; 
            total_header_unilevel += total_unilevel; 
            total_header_leadership += total_leadership;
            total_header_tsb += total_tsb;

            // Array of objects to the combined tab
            total_monthly = {
                total: total,
                period: item.name +' '+year,
            };

            myResponse.push(total_monthly);

            // Apply the mask
            total_fsb = total_fsb.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
            total_tsb = total_tsb.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
            total_leadership = total_leadership.toLocaleString('en-US', { style: 'currency', currency: 'USD' }); 
            total_unilevel = total_unilevel.toLocaleString('en-US', { style: 'currency', currency: 'USD' }); 
            total = total.toLocaleString('en-US', { style: 'currency', currency: 'USD' });

            html = "<tr>";
            html += "<th class='font-weight-bold'>"+item.name +' '+year+"</th>";
            html += "<td class='font-weight-bold' style='color: #36a3f7' id='monthly_"+year+"_"+item.month+"'>"+total+"</td>";
            html += "<td><a class='font-weight-bold' style='color: #36a3f7' href='/commission-viewer/monthly?type=unilevel&period="+item.period+"'>"+total_unilevel+"</a></td>";
            html += "<td><a class='font-weight-bold' style='color: #36a3f7' href='/commission-viewer/monthly?type=leadership&period="+item.period+"'>"+total_leadership+"</a></td>";
            html += "<td><a class='font-weight-bold' style='color: #36a3f7' onclick=\"getPayoutByLevel('tsb', '"+item.period+"')\">"+total_tsb+"</a</td>";
            html += "<td><a class='font-weight-bold'>0.00</a></td>";
            html += "</tr>";
           
            $('#monthly_commission').append(html);
        });

        // Format
        total_header = total_header.toLocaleString('en-US', { style: 'currency', currency: 'USD' }); 
        total_header_unilevel = total_header_unilevel.toLocaleString('en-US', { style: 'currency', currency: 'USD' }); 
        total_header_leadership = total_header_leadership.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
        total_header_tsb = total_header_tsb.toLocaleString('en-US', { style: 'currency', currency: 'USD' });

        html_total_header = "<tr class='table-info'>";
        html_total_header += "<th class='font-weight-bold'>YTD</th>";
        html_total_header += "<td class='font-weight-bold'>"+total_header+"</td>";
        html_total_header += "<td><a class='font-weight-bold'>"+total_header_unilevel+"</a></td>";
        html_total_header += "<td><a class='font-weight-bold'>"+total_header_leadership+"</a></td>";
        html_total_header += "<td><a class='font-weight-bold'>"+total_header_tsb+"</a</td>";
        html_total_header += "<td><a class='font-weight-bold'>0.00</a></td>";
        html_total_header += "</tr>";
   
        $('#total_monthly_commission').append(html_total_header);

    });

    return myResponse;

//    return jqXHR.responseJSON;
}

function getCommissionWeekly(year) {

    var myResponse = [];

    $.ajax({
        async: false,
        url: "api-request",
        data: { 
            data: {
                year: year
            },
            method: "POST", 
            endpoint: '/affiliate/commission-weekly' 
        }

    }).done(function(res) {

        // Clear tabs weekly and combined
        $('#weekly_commission').html('');
        $('#combined_commission').html('');
        $('#total_weekly_commission').html('');
        $('#total_combined_commission').html('');

        // Initializa the calc
        var total_header = total_header_volume_left = total_header_volume_right = total_header_dual_team = total_header_fsb = 0;

        // Fill table
        $.each(res.data.resume, function (key, item) {

            var total_volume_left = total_volume_right = total_dual_team = total_fsb = total = 0;

            total_fsb += Number(item.fsb ? item.fsb : 0);
            total_dual_team += Number(item.dual_team ? item.dual_team : 0);
            total_volume_left += Number(item.volume_left ? item.volume_left : 0);
            total_volume_right += Number(item.volume_right ? item.volume_right : 0);
            total = parseFloat(total_dual_team + total_fsb);

            total_header += total;
            total_header_volume_left += total_volume_left;
            total_header_volume_right += total_volume_right;
            total_header_dual_team += total_dual_team;
            total_header_fsb += total_fsb;

            // Array of objects to the combined tab
            total_weekly = {
                total: total,
                month: item.month
            };

            myResponse.push(total_weekly);

            month = item.month;

            // Apply the mask
            total_fsb = total_fsb.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
            total_dual_team = total_dual_team.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
            total_volume_left = total_volume_left.toLocaleString('en-US'); 
            total_volume_right = total_volume_right.toLocaleString('en-US'); 
            total = total.toLocaleString('en-US', { style: 'currency', currency: 'USD' });

            html = "<tr class='accordion-toggle collapsed' id='accordion"+month+"' data-toggle='collapse' data-parent='#accordion"+month+"' href='#collapseOne"+month+"' style='cursor: pointer;'>";
            html += "<th class='font-weight-bold' width='25%'>"+item.name +' '+year+"</th>";
            html += "<td class='font-weight-bold' style='color: #36a3f7'>"+total+"</td>";
            html += "<td><a class='font-weight-bold' style='color: #36a3f7'>"+total_volume_left+"</a></td>";
            html += "<td><a class='font-weight-bold' style='color: #36a3f7'>"+total_volume_right+"</a></td>";
            html += "<td><a class='font-weight-bold' style='color: #36a3f7'>"+total_dual_team+"</a</td>";
            html += "<td><a class='font-weight-bold' style='color: #36a3f7' href='/commission-viewer/monthly?type=fsb&period="+item.period+"'>"+total_fsb+"</a</td>";
            html += "</tr>";
         
            $('#weekly_commission').append(html);

            getCommissionWeeklyDetails(month, year);

        });

        // Format currency
        total_header = total_header.toLocaleString('en-US', { style: 'currency', currency: 'USD' }); 
        total_header_dual_team = total_header_dual_team.toLocaleString('en-US', { style: 'currency', currency: 'USD' }); 
        total_header_fsb = total_header_fsb.toLocaleString('en-US', { style: 'currency', currency: 'USD' });

        total_header_volume_left = total_header_volume_left.toLocaleString('en-US'); 
        total_header_volume_right = total_header_volume_right.toLocaleString('en-US'); 

        html_total_header = "<tr class='table-info'>";
        html_total_header += "<th class='font-weight-bold'>YTD</th>";
        html_total_header += "<td class='font-weight-bold'>"+total_header+"</td>";
        html_total_header += "<td><a class='font-weight-bold'>"+total_header_volume_left+"</a></td>";
        html_total_header += "<td><a class='font-weight-bold'>"+total_header_volume_right+"</a></td>";
        html_total_header += "<td><a class='font-weight-bold'>"+total_header_dual_team+"</a</td>";
        html_total_header += "<td><a class='font-weight-bold'>"+total_header_fsb+"</a></td>";
        html_total_header += "</tr>";
   
        $('#total_weekly_commission').append(html_total_header);

    });        

    return myResponse;

}

function getCommissionWeeklyDetails(month, year) {

    $.ajax({
        url: "api-request",
        data: { 
            data: {
                month: month,
                year: year,
            },
            method: "POST", 
            endpoint: '/affiliate/commission-weekly-details' 
        }

    }).done(function(res) {
        
        $.each(res.data.resume, function (key, item) {

            var total_volume_left = total_volume_right = total_amount_earned = total_fsb = total = 0;

            total_fsb += Number(item.fsb ? item.fsb : 0);
            total_amount_earned = Number(item.amount_earned ? item.amount_earned : 0);
            total_volume_left += Number(item.volume_left ? item.volume_left : 0);
            total_volume_right += Number(item.volume_right ? item.volume_right : 0);
            total = parseFloat(total_amount_earned + total_fsb);

            // Apply the mask
            total_fsb = total_fsb.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
            total_amount_earned = total_amount_earned.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
            total_volume_left = total_volume_left.toLocaleString('en-US'); 
            total_volume_right = total_volume_right.toLocaleString('en-US'); 
            total = total.toLocaleString('en-US', { style: 'currency', currency: 'USD' });

            html = "<tr id='collapseOne"+month+"' class='collapse in p-3'>";
            html += "  <td width='25%'>Week Ending "+item.week_ending+"</td>";
            html += "  <td>"+total+"</td>";
            html += "  <td>"+total_volume_left+"</td>";
            html += "  <td>"+total_volume_right+"</td>";
            html += "  <td> <a href='#' onclick=\"getBinaryDetails('"+item.week_ending+"')\"> "+total_amount_earned+"</a></td>";
            //html += "  <td>"+total_fsb+"</td>";
            html += "  <td> <a href='/commission-viewer/monthly?type=fsb&week="+item.week_ending+"'>"+total_fsb+"</a</td>"; 
            html += "</tr>";

            $("#accordion"+month).closest('tr').after(html);
        });
    }); 
}

function getCommissionCombined(monthly, weekly) {

    total_header = total_header_monhtly = total_header_weekly = 0;

    $.each(monthly, function (key, item) {

        total = item.total + weekly[key]['total'];

        total_header += total
        total_header_monhtly += item.total;
        total_header_weekly += weekly[key]['total'];

        total = total.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
        

        total_monthly = item.total.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
        total_weekly  = weekly[key]['total'].toLocaleString('en-US', { style: 'currency', currency: 'USD' });

        html = "<tr>";
        html += "<th class='font-weight-bold' width='25%'>"+item.period+"</th>";
        html += "<td class='font-weight-bold' style='color: #36a3f7'>"+total+"</td>";
        html += "<td class='font-weight-bold' style='color: #36a3f7'>"+total_monthly+"</td>";
        html += "<td class='font-weight-bold' style='color: #36a3f7'>"+total_weekly+"</td>";
        html += "<td class='font-weight-bold' style='color: #36a3f7'>0.00</td>";
        html += "</tr>";         

        $('#combined_commission').append(html);
    });

    // Format
    total_header = total_header.toLocaleString('en-US', { style: 'currency', currency: 'USD' }); 
    total_header_monhtly = total_header_monhtly.toLocaleString('en-US', { style: 'currency', currency: 'USD' }); 
    total_header_weekly = total_header_weekly.toLocaleString('en-US', { style: 'currency', currency: 'USD' });

    html_total_header = "<tr class='table-info'>";
    html_total_header += "<th class='font-weight-bold'>YTD</th>";
    html_total_header += "<td class='font-weight-bold'>"+total_header+"</td>";
    html_total_header += "<td><a class='font-weight-bold'>"+total_header_monhtly+"</a></td>";
    html_total_header += "<td><a class='font-weight-bold'>"+total_header_weekly+"</a></td>";
    html_total_header += "<td><a class='font-weight-bold'>0.00</a></td>";
    html_total_header += "</tr>";

    $('#total_combined_commission').append(html_total_header);

}


function getBinaryDetails(week) {

    // Clear modal to show binary details
    $('#binary_commission').html('');

    $.ajax({
        url: "api-request",
        data: { 
            data: {
                week: week,
            },
            method: "POST", 
            endpoint: '/affiliate/commission-weekly-binary-details' 
        }

    }).done(function(res) {
        
        $.each(res.data.resume, function (key, item) {

            var total_volume_left = total_volume_right = total_amount_earned = carryover_left = carryover_right =  gross_volume = total = 0;

            total = Number(item.amount_earned ? item.amount_earned : 0);

            carryover_left += Number(item.carryover_left ? item.carryover_left : 0);
            carryover_right += Number(item.carryover_right ? item.carryover_right : 0);
            total_volume_left += Number(item.total_volume_left ? item.total_volume_left : 0);
            total_volume_right += Number(item.total_volume_right ? item.total_volume_right : 0);
            gross_volume += Number(item.gross_volume ? item.gross_volume : 0);

            carryover_left = carryover_left.toLocaleString('en-US'); 
            carryover_right = carryover_right.toLocaleString('en-US'); 
            total_volume_left = total_volume_left.toLocaleString('en-US'); 
            total_volume_right = total_volume_right.toLocaleString('en-US'); 
            gross_volume = gross_volume.toLocaleString('en-US'); 

            total = total.toLocaleString('en-US', { style: 'currency', currency: 'USD' });

            html = "<tr>";
            html += "<th>"+carryover_left+"</th>";
            html += "<td>"+carryover_right+"</td>";
            html += "<td>"+total_volume_left+"</td>";
            html += "<td>"+total_volume_right+"</td>";
            html += "<td>"+gross_volume+"</td>";
            html += "<td>"+item.commission_percent+"</td>";
            html += "<td>"+total+"</td>";
            html += "</tr>";

            $('#binary_commission').append(html);
        });
    }); 
    
    $('#modalCommissionWeekly').modal('show');
}


function getPayoutByLevel(type, period) {

    var data = {};

    if (type != '')
        data['type'] = type;

    if (period != '')
        data['period'] = period;

    $.ajax({ 
        url: "commission-viewer/commission-details-level",
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
    showLoading();

    monthly = getCommission($('#year').val());
    weekly  = getCommissionWeekly($('#year').val());
    getCommissionCombined(monthly, weekly);

    $('#year').on('change', function() {
        monthly = getCommission($('#year').val());
        weekly  = getCommissionWeekly($('#year').val());
        getCommissionCombined(monthly, weekly);
    });

    hideLoading();
   
});
