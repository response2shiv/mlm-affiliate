$( document ).ready(function() {
  if ($('#dt_order_completed').length) {

    function onint(){
        // take off all events from the searchfield
        $("#dt_order_completed_filter input[type='search']").off();
        // Use return key to trigger search
        $("#dt_order_completed_filter input[type='search']").on("keydown", function(evt){
            if(evt.keyCode == 13){
                $("#dt_order_completed")
                  .DataTable()
                    .search($("input[type='search']").val())                
                    .draw();    
            }
        }); 
    
        $("#dt_order_completed_filter .glyphicon-search").on("click", function(){    
          $("#dt_order_completed")
            .DataTable()
              .search($("input[type='search']").val())                
              .draw();        
        });
            
    }

    var table = $('#dt_order_completed').DataTable({
        serverSide: true,
        processing: true,
        scrollX: true,
        initComplete:function(){
            onint();
        },
        searchDelay: 500,
        order: [[3, 'desc']],
        ajax: {
          url: "datatables-api",
          data: function (data) {
              data.endpoint = "/affiliate/reports/orders-completed";
              return data;
          }
        },
        columns: [
            {data: 'order_id'},
            {data: 'trasnactionid'},
            {data: 'status_desc'},
            {data: 'created_date'},
            {data: 'ordertotal'},
            {data: 'id'}                 
        ], 
        columnDefs: [
            {
                targets: 4,
                render: function (data, type, full, meta) {
                    return 'USD$ ' + parseFloat(Math.round(data * 100) / 100).toFixed(2);
                },
            },
            {
                targets: 5,
                render: function (data, type, full, meta) {
                    return '<a href="/report/invoice/view/'+full['order_id']+'" target="_blank" class="text-decoration-none"><i class="fa fa-eye fa-lg" title="View Invoice"></i></a>  <a href="/report/invoice/download/'+full['order_id']+'" target="_blank" class="text-decoration-none"><i class="fa fa-download fa-lg" title="Download Invoice"></i></a>';
                },
            },
        ],       
        fnDrawCallback: function () {
            $(".top-scroll").width($("#dt_order_completed").width());
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
            $("#dt_order_completed_filter input[type='search']").css({width: "80%"});
        }
    });

    $("#dt_order_completed_filter label").append('<div class="glyphicon glyphicon-search"></div>');
    $("#dt_order_completed_filter").addClass('inner-addon right-addon');

    $(".dataTables_scroll").prepend(`
                <div class="top-scroll-wrapper">
                <div class="top-scroll"></div>
                </div>
            `);
    table.on('draw', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

  }

  if ($('#dt_order_pending').length) {

    function onint(){
        // take off all events from the searchfield
        $("#dt_order_pending_filter input[type='search']").off();
        // Use return key to trigger search
        $("#dt_order_pending_filter input[type='search']").on("keydown", function(evt){
            if(evt.keyCode == 13){
                $("#dt_order_pending")
                  .DataTable()
                    .search($("input[type='search']").val())                
                    .draw();    
            }
        }); 
    
        $("#dt_order_pending_filter .glyphicon-search").on("click", function(){    
          $("#dt_order_pending")
            .DataTable()
              .search($("input[type='search']").val())                
              .draw();        
        });
            
    }

    var table = $('#dt_order_pending').DataTable({
        serverSide: true,
        processing: true,
        scrollX: true,
        initComplete:function(){
            onint();
        },
        searchDelay: 500,
        order: [[3, 'desc']],
        ajax: {
          url: "datatables-api",
          data: function (data) {
              data.endpoint = "/affiliate/reports/orders-pending";
              return data;
          }
        },
        columns: [
            {data: 'order_id'},
            {data: 'trasnactionid'},
            {data: 'status_desc'},
            {data: 'created_date'},
            {data: 'ordertotal'},
            {data: 'id'}
        ],  
        columnDefs: [
            {
                targets: 4,
                render: function (data, type, full, meta) {
                    return 'USD$ ' + parseFloat(Math.round(data * 100) / 100).toFixed(2);
                },
            },
            {
                targets: 5,
                render: function (data, type, full, meta) {
                    return '<a href="/report/pre-order/view/'+full['order_id']+'" target="_blank" class="text-decoration-none"><i class="fa fa-eye fa-lg" title="View Invoice"></i></a>  <a href="/report/pre-order/download/'+full['order_id']+'" target="_blank" class="text-decoration-none"><i class="fa fa-download fa-lg" title="Download Invoice"></i></a>';
                },
            },
           
        ],         
        fnDrawCallback: function () {
            $(".top-scroll").width($("#dt_order_pending").width());
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
            $("#dt_order_pending_filter input[type='search']").css({width: "80%"});
        }
    });

    $("#dt_order_pending_filter label").append('<div class="glyphicon glyphicon-search"></div>');
    $("#dt_order_pending_filter").addClass('inner-addon right-addon');

    $(".dataTables_scroll").prepend(`
                <div class="top-scroll-wrapper">
                <div class="top-scroll"></div>
                </div>
            `);
    table.on('draw', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

  }
  $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
    $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
} );
});