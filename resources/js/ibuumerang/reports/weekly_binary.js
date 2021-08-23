$( document ).ready(function() {
  if ($('#dt_weekly_binary_view').length) {
    var from = $("#from").val();
    var to = $("#to").val();
    var burl = $('#burl').text();

    function onint(){
        // take off all events from the searchfield
        $("#dt_weekly_binary_view_filter input[type='search']").off();
        // Use return key to trigger search
        $("#dt_weekly_binary_view_filter input[type='search']").on("keydown", function(evt){
            if(evt.keyCode == 13){
                $("#dt_weekly_binary_view")
                  .DataTable()
                    .search($("input[type='search']").val())                
                    .draw();    
            }
        }); 
    
        $("#dt_weekly_binary_view_filter .glyphicon-search").on("click", function(){    
          $("#dt_weekly_binary_view")
            .DataTable()
              .search($("input[type='search']").val())                
              .draw();        
        });
            
    }

    var table = $('#dt_weekly_binary_view').DataTable({
        serverSide: true,
        processing: true,
        scrollX: true,
        initComplete:function(){
            onint();
        },
        searchDelay: 500,
        order: [[1, 'asc']],
        ajax: {
          url: "datatables-api",
          data: function (data) {
              data.from = $('#from').val();
              data.to = $('#to').val();
              data.endpoint = "/affiliate/reports/weekly-binary-view";
              return data;
          }
      },
        columns: [
            {data: 'distid'},
            {data: 'firstname'},
            {data: 'lastname'},
            {data: 'username'},
            {data: 'qv'},
            {data: 'cv'},
            {data: 'created_dt'},
            {data: 'current_product_id'},
            {data: 'direction'}
        ],
        columnDefs: [
            {
                targets: 0,
                searchable: true,
            },
            {
                targets: 7,
                render: function (data, type, full, meta) {
                  var en_pack = {
                    '1': {'title': 'Standby Class', 'icon': 'standby_class.png'},
                    '2': {'title': 'Coach Class', 'icon': 'coach_class.png'},
                    '3': {'title': 'Business Class', 'icon': 'business_class.png'},
                    '4': {'title': 'First Class', 'icon': 'first_class_icon.png'},
                    '13': {'title': 'Graduates', 'icon': 'graduate_class_icon.png'},
                    '14': {'title': 'Traverus Grandfathering', 'icon': 'business_class.png'},
                    '16': {'title': 'Premium First Class', 'icon': 'elite_class.png'},
                    '52': {'title': 'Vibe Overdrive Class', 'icon': 'vibe_class_icon.png'}
                  };
                  if (typeof en_pack[data] === 'undefined') {
                    return data;
                  }
                  return '<a href="#" data-toggle="tooltip" title="' + en_pack[data].title + '"><img src="' + burl + '/assets/images/' + en_pack[data].icon + '" /></a>';
                },
            }
        ],
        fnDrawCallback: function () {
            $(".top-scroll").width($("#dt_weekly_binary_view").width());
            $(".top-scroll-wrapper").scroll(function () {
                $(".dataTables_scrollBody")
                    .scrollLeft($(".top-scroll-wrapper").scrollLeft());
            });
            $(".dataTables_scrollBody").scroll(function () {
                $(".top-scroll-wrapper")
                    .scrollLeft($(".dataTables_scrollBody").scrollLeft());
            });
        },
        drawCallback: function () {
            $("#dt_weekly_binary_view_filter input[type='search']").css({width: "80%"});
        }
    });

    $("#dt_weekly_binary_view_filter label").append('<div class="glyphicon glyphicon-search"></div>');
    $("#dt_weekly_binary_view_filter").addClass('inner-addon right-addon');

    $(".dataTables_scroll").prepend(`
                <div class="top-scroll-wrapper">
                <div class="top-scroll"></div>
                </div>
            `);
    table.on('draw', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

  }
});