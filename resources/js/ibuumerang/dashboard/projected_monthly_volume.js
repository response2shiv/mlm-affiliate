$('#projectedMonthlyVolume, #btnDetailsProjectedMonthlyVolume').on('click', function () {

  function onint(){
    // take off all events from the searchfield
    $("#dt_projected_monthly_volume_filter input[type='search']").off();
    // Use return key to trigger search
    $("#dt_projected_monthly_volume_filter input[type='search']").on("keydown", function(evt){
      if(evt.keyCode == 13){
        $("#dt_projected_monthly_volume")
          .DataTable()
          .search($("input[type='search']").val())
          .draw();
      }
    });

  }

  if (!$.fn.DataTable.isDataTable('#dt_projected_monthly_volume')){

    $('#dt_projected_monthly_volume').DataTable({
      serverSide: true,
      processing: true,
      responsive: true,
      initComplete:function(){onint();},
      searchDelay: 500,
      order: [[5, 'asc'], [1, 'asc']],
      ordering: true,
      ajax: {
        url: "/dashboard/datatables-api",
        data: function (data) {
          data.endpoint   = "/affiliate/dashboard/monthly-projected-details-datatable";

          return data;
        }
      },
      columns: [
        {data: 'distid'},
        {data: 'full_name'},
        {data: 'qv'},
        {data: 'cv'},
        {
          data: 'qc',
          render: $.fn.dataTable.render.number( ',', '.', 2 )
        },
        {data: 'date_processed'},
        {data: 'processed'},
      ],
      columnDefs: [
        { targets: [1,6], searchable: true },
        { targets: '_all', searchable: false }
      ],
      createdRow: function( row, data, dataIndex){
        if (data.processed == '---') {
          $(row).addClass('pvm_failed_row');
        }
      },
      fnDrawCallback: function () {
        $('#dt_projected_monthly_volume').find('tr').removeClass('odd');
        $('#dt_projected_monthly_volume').find('tr').removeClass('even');
      }
    });
  } else {
    $('#dt_projected_monthly_volume').DataTable().draw();
  }

  $('#dt_projected_monthly_volume').removeAttr( "style" )
  $('#modalProjectedMonthlyVolume').modal('show');

});