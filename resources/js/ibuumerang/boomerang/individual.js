$( document ).ready(function() {
    function onint(){
        // take off all events from the searchfield
        $("#boom_ind_filter input[type='search']").off();
        // Use return key to trigger search
        $("#boom_ind_filter input[type='search']").on("keydown", function(evt){
            if(evt.keyCode == 13){
                $("#boom_ind")
                  .DataTable()
                    .search($("input[type='search']").val())                
                    .draw();    
            }
        }); 
    
        $("#search_button").on("click", function(){    
          $("#boom_ind")
            .DataTable()
              .search($("input[type='search']").val())                
              .draw();        
        });
            
    }
    var table = $('#boom_ind').DataTable({
        serverSide: false,
        processing: true,
        scrollX: true,
        initComplete:function(){
            onint();
        },
        searchDelay: 500,
        language: { search: '', searchPlaceholder: "Search..." },
        order: [[5, 'desc']],
        ajax: {
          url: "api-request",
          data: function (data) {
              data.method = "GET"
              data.endpoint   = "/affiliate/boomerangs-ind";
              return data;
          }
      },
      columns: [
        {data: 'lead_firstname'},
        {data: 'lead_lastname'},
        {data: 'lead_email'},
        {data: 'lead_mobile'},
        {data: 'boomerang_code'},
        {data: 'date_created'},
        {data: 'exp_dt'},
        {data: 'is_used'}
      ],
      columnDefs: [
          {
              targets: 7,
              render: function (data, type, full, meta) {
                  var status = {
                      1: {'title': 'Yes', 'class': 'badge-success'},
                      0: {'title': 'No', 'class': ' badge-danger'},
                  };
                  if (typeof status[data] === 'undefined') {
                      return data;
                  }
                  return '<span class="badge ' + status[data].class + '">' + status[data].title + '</span>';
              },
          },
      ],

    fnDrawCallback: function () {
        if ($('#boom_ind_filter').length) {
            $('#boom_ind_filter').addClass('input-group');
            $('#search_button').detach();
            $('#boom_ind_filter label').empty();
            $('.input-group-prepend').detach();
            $('#boom_ind_filter').prepend('<div class="input-group-prepend"><span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><i class="fa fa-search"></i></font></font></span><input type="search" class="form-control form-control-sm" id="boom_ind_filter" placeholder="Search..." aria-controls="boom_ind" style="margin-left: 0px;border-radius: 0px;height: 32.5px;"></div>');
            $('#boom_ind_filter').append('<button class="btn btn-primary" type="submit" style="height: 50%;" id="search_button" onclick="search()">Submit</button');
            $('.input-group-addon').css('background-color', '#eee');
        }

    }
    });

  $("#boom_ind_filter").on("keydown", function(evt){
    if(evt.keyCode == 13){
        table.search($("input[type='search']").val()).draw();
        }
    }); 
});


function search(){
    $("#boom_ind")
    .DataTable()
    .search($("input[type='search']").val())                
    .draw(); 
}
