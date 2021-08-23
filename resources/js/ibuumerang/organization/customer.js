function onint(){    
    $("#customerData_filter .glyphicon-search").on("click", function(){    
        $("#customerData")
            .DataTable()
            .search($("input[type='search']").val())                
            .draw();        
    });
 }


var table = $('#customerData').DataTable({
    serverSide: true,
    processing: true,
    responsive: true,
    initComplete:function(){onint();},
    order: [[0, "desc"]],
    ajax: {
      url: "datatables-api",
      data: function (data) {
          data.endpoint   = '/affiliate/organization/customer-data';          
          return data;
      }

  },
  columns: [
      {data: 'custid',  orderable: true},
      {data: 'name'},
      {data: 'email'},
      {data: 'mobile'},
      {data: 'boomerang_code'},
      {data: 'created_date'},
  ],
  drawCallback: function () {
    $('#dt_dlg_transfer_history_filter input[type="search"]').css({width: "85%"});
  }
});

$("#customerData_filter label").append('<div class="glyphicon glyphicon-search"></div>');  
$("#customerData_filter").addClass('inner-addon right-addon'); 

$('#customerData_filter input').unbind();
$('#customerData_filter input').keyup(function (e) {
    if (e.keyCode == 13) /* if enter is pressed */ {
        table.search($(this).val()).draw();
    }
});



