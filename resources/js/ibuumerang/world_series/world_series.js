$('.top-100 a').on('click', function () {
    // Clear modal to show binary details
    $('#top_teams').empty();
    $('.top-100 a').removeClass('text-secondary');
    $(this).addClass('text-secondary');

    if($(this).attr("id") == 'season'){
        month = 06;
    }

    if($(this).attr("id") == 'playoffs'){
        month = 07;
    }

    if($(this).attr("id") == 'world-series'){
        month = 08;
    }

    $.ajax({
        url: "api-request",
        data: { 
            method: "get", 
            endpoint: '/join/top-teams-world-series?limit=100&month='+month 
        }

    }).done(function(res) {
        var i = 0;

        $.each(res.data.resume, function (key, item) {
            i++;

            html = "<tr>";
            html += "<td>"+i+"</td>";
            html += "<td>"+item.sponsor.firstname+' ' +item.sponsor.lastname+"</td>";
            html += "<td>"+item.runs+"</td>";
            html += "<td>"+item.hits+"</td>";
            html += "<td>"+item.errors+"</td>";
            html += "</tr>";

            $('#top_teams').append(html);
        });

          $('#dt_top_team').DataTable({
            responsive: true,
            searching: true,
            retrieve: true,
            order: [[0, "asc"]],
            drawCallback: function () {
                $("#dt_top_teams input[type='search']").css({width: "80%"});
            }
        });
        $('#modalTopTeam').modal('show');
    }); 
        
});