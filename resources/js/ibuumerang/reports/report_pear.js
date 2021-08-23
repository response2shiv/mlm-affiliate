$( document ).ready(function() {
  
  var parts = window.location.href.split('/');
  var id = parts.pop() || null;
  var history = null;

  if (isNaN(id)) {
      id = null;
  }

  function onint(){
    // take off all events from the searchfield
    $("#pearData_filter input[type='search']").off();
    // Use return key to trigger search
    $("#pearData_filter input[type='search']").on("keydown", function(evt){
        if(evt.keyCode == 13){
            $("#pearData")
              .DataTable()
                .search($("input[type='search']").val())                
                .draw();    
        }
    }); 

    $("#pearData_filter .glyphicon-search").on("click", function(){    
      $("#pearData")
        .DataTable()
          .search($("input[type='search']").val())                
          .draw();        
    });

    $("#selectHistory").on("change", function(){
      history = $("#selectHistory").val();
      loadPear();
      $("#pearData")
        .DataTable()
        .draw();
    });
        
  }
  //load data pear
  loadPear();

  $('#pearData').DataTable({
    serverSide: true,
    processing: true,
    responsive: true,
    initComplete:function(){
      onint();
    },
    searching: true,
    order: [[2, "desc"]],
    ajax: {
      url: "datatables-api",
      data: function (data) {
          data.id = id
          data.history = history
          data.endpoint   = '/affiliate/reports/pear';
          return data;
      }
    },
    columns: [
        {data: 'distid',  orderable: false, searchable: true},
        {data: 'name',  orderable: true, searchable: true},
        {data: 'monthly_qv', orderable: true},
        {data: 'qv_contribution'},
        {data: 'monthly_cv'},
        {data: 'pqv'},
        {data: 'monthly_rank_desc'},
    ],
    columnDefs: [
      {
        targets: 1,
        render: function (data, type, full, meta) {
          if (full['account_status']=='APPROVED'){
            return '<a href="/report/pear/'+ full['id'] +'" data-toggle="tooltip">'+ full['name'] +'</a>';
          }else{
            return '<a href="/report/pear/'+ full['id'] +'" style="color: red" data-toggle="tooltip">'+ full['name'] +'</a>';
          }
          
        },
      },
      {
        targets: 2,
        render: function (data, type, full, meta) {
          if(data == null){
            return 0;
          }else{
            return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
          }
        },
      },
      {
        targets: 3,
        render: function (data, type, full, meta) {
          if(data == null){
            return 0;
          }else{
            return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
          }
        },
      },
      {
        targets: 4,
        render: function (data, type, full, meta) {
          if(data == null){
            return 0;
          }else{
            return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
          }
        },
      },
    ],
    drawCallback: function () {
      $("#pearData_filter input[type='search']").css({width: "80%"});
    }
  });

  $("#pearData_filter label").append('<div class="glyphicon glyphicon-search"></div>');  
  $("#pearData_filter").addClass('inner-addon right-addon');

  function loadPear()
  {
    history = $("#selectHistory").val();

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: "POST",
      url: "json/pear",
      data: { history: history, id: id }
     }).done(function(resposta) {
      
       let rank_qv = resposta.rank_history.qualified_qv.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
       let monthly_qv = resposta.rank_history.monthly_qv.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
       let monthly_rank_desc = resposta.rank_history.monthly_rank_desc;
       let pqv = resposta.pqv;
  
      $('#monthly_qv_user').hide();
      $('#monthly_qv_add').remove();
      $("#monthly_qv").append('<span id="monthly_qv_add" class="header-pear-report">'+monthly_qv+'</span>');
  
      $('#rank_qv_user').hide();
      $('#rank_qv_add').remove();
      $("#rank_qv").append('<span id="rank_qv_add" class="header-pear-report">'+rank_qv+'</span>');
  
      $('#monthly_rank_desc_user').hide();
      $('#monthly_rank_desc_add').remove();
      $("#monthly_rank_desc").append('<span id="monthly_rank_desc_add" class="header-pear-report">'+monthly_rank_desc+'</span>');
      
      $('#monthly_pqv_user').hide();
      $('#monthly_pqv_add').remove();
      $("#monthly_pqv").append('<span id="monthly_pqv_add" class="header-pear-report">'+pqv+'</span>');
  
      });
  }

});

