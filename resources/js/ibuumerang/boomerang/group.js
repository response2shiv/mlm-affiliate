$( document ).ready(function() {
  function onint(){
    // take off all events from the searchfield
    $("#dt_boomerangs_group_filter input[type='search']").off();
    // Use return key to trigger search
    $("#dt_boomerangs_group_filter input[type='search']").on("keydown", function(evt){
        if(evt.keyCode == 13){
            $("#dt_boomerangs_group")
              .DataTable()
                .search($("input[type='search']").val())                
                .draw();    
        }
    }); 

    $("#search_button").on("click", function(){    
      $("#dt_boomerangs_group")
        .DataTable()
          .search($("input[type='search']").val())                
          .draw();        
    });
        
  }
  var table = $('#dt_boomerangs_group').DataTable({
    
    serverSide: false,
    processing: true,
    responsive: true,
    searchDelay: 500,
    initComplete:function(){
      onint();
    },
    order: [[4, 'desc']],
    ajax: {
      url: "api-request",
      data: function (data) {
          data.method = "GET"
          data.endpoint   = "/affiliate/boomerangs-group";
          return data;
      }
    },
    columns: [
        {data: 'group_campaign'},
        {data: 'group_no_of_uses'},
        {data: 'group_available'},
        {data: 'boomerang_code'},
        {data: 'date_created'},
        {data: 'exp_dt'}
    ],
    fnDrawCallback: function () {
      if ($('#dt_boomerangs_group_filter').length) {
          $('#dt_boomerangs_group_filter').addClass('input-group');
          $('#search_button').detach();
          $('#dt_boomerangs_group_filter label').empty();
          $('.input-group-prepend').detach();
          $('#dt_boomerangs_group_filter').prepend('<div class="input-group-prepend"><span class="input-group-addon"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><i class="fa fa-search"></i></font></font></span><input type="search" class="form-control form-control-sm" placeholder="Search..." aria-controls="boom_ind" style="margin-left: 0px;border-radius: 0px;height: 32.5px;"></div>');
          $('#dt_boomerangs_group_filter').append('<button class="btn btn-primary" type="submit" style="height: 50%;" id="search_button" onclick="filter()">Submit</button');
          $('.input-group-addon').css('background-color', '#eee');
      }
    }

  });

  $("#dt_boomerangs_group_filter").on("keydown", function(evt){
    if(evt.keyCode == 13){
        table.search($("input[type='search']").val()).draw();
        }
    });
});
  function filter () {
    $("#dt_boomerangs_group")
    .DataTable()
    .search($("input[type='search']").val())                
    .draw(); 
  }
