$(document).ready(function () {

  $("body").tooltip({ selector: '[data-toggle=tooltip]' });

  $(function () {
    var start = $('#from').val() != '' ? moment($('#from').val()) : moment().startOf('week');
    var end = $('#to').val() != '' ? moment($('#to').val()) : moment().endOf('week');

    function cb(start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
      alwaysShowCalendars: true,
      startDate: start,
      endDate: end,
      linkedCalendars: false,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, cb);

    $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
      $('#dateFrom').val(picker.startDate.format('YYYY-MM-DD'));
      $('#dateTo').val(picker.endDate.format('YYYY-MM-DD'));

      table.draw();
    });

    cb(start, end);
  });

  function onint() {
    // take off all events from the searchfield
    $("#dt_binary_tree_report_filter input[type='search']").off();
    // Use return key to trigger search
    $("#dt_binary_tree_report_filter input[type='search']").on("keydown", function (evt) {
      if (evt.keyCode == 13) {
        $("#dt_binary_tree_report").DataTable().search($("input[type='search']").val()).draw();
      }
    });

    $("#dt_binary_tree_report_filter .glyphicon-search").on("click", function () {
      $("#dt_binary_tree_report")
        .DataTable()
        .search($("input[type='search']").val())
        .draw();
    });
  }

  var burl = $('#burl').text();

  var table = $('#dt_binary_tree_report').DataTable({
    serverSide: true,
    processing: true,
    scrollX: true,
    initComplete: function () {
      onint();
    },
    dom: '<prfl<t>ip>',
    searchDelay: 500,
    order: [[0, 'desc'], [1, 'asc']],
    ajax: {
      url: "datatables-api",
      data: function (data) {
        data.dateFrom = $('#dateFrom').val();
        data.dateTo = $('#dateTo').val();
        data.levelFrom = $('#levelFrom').val();
        data.levelTo = $('#levelTo').val();
        data.viewOption = $('#viewOption').val();
        data.endpoint = "/affiliate/reports/entire-organization-report-data";

        return data;
      }
    },
    columns: [
      { data: 'distid' },
      { data: 'level' },
      { data: 'firstname', searchable: true },
      { data: 'lastname' },
      // { data: 'username' },
      { data: 'enrollment_date' },
      { data: 'countrycode' },
      { data: 'stateprov' },
      { data: 'current_product_id' },
      // { data: 'sponsorid' },
      { data: 'sponser_name' },
      // { data: 'lifetime_rank', name: "rd_lifetime.rankdesc" },
      // { data: 'previous_month_rank' },
      { data: 'is_active' },
      // { data: 'binary_q_l' },
    ],
    columnDefs: [
      {
        targets: 7,
        render: function (data, type, full, meta) {
          var en_pack = {
            '1': { 'title': 'Basic Pack', 'icon': 'EOR_pack_icon_basic.png' },
            '2': { 'title': 'Visionary Pack', 'icon': 'EOR_pack_icon_visionary.png' },
            // '3': { 'title': 'Business Class', 'icon': 'business_class.png' },
            // '4': { 'title': 'First Class', 'icon': 'first_class_icon.png' },
            // '13': { 'title': 'Graduates', 'icon': 'graduate_class_icon.png' },
            // '14': { 'title': 'Traverus Grandfathering', 'icon': 'business_class.png' },
            // '16': { 'title': 'Premium First Class', 'icon': 'elite_class.png' },
            // '52': { 'title': 'Vibe Overdrive Class', 'icon': 'vibe_class_icon.png' }
          };
          if (typeof en_pack[data] === 'undefined') {
            return '';
          }
          
          return '<span data-toggle="tooltip" id="'+ en_pack[data].icon+'" data-placement="top" title="' + en_pack[data].title + '"><img src="' + burl + '/assets/images/' + en_pack[data].icon + '" /></span>';
        },
      },
      {
        targets: 9,
        render: function (data, type, full, meta) {
          var status = {
            1: { 'title': 'Yes', 'class': 'badge-success' },
            0: { 'title': 'No', 'class': ' badge-danger' },
            null: { 'title': 'No', 'class': ' badge-danger' },
          };
          if (typeof status[data] === 'undefined') {
            return data;
          }
          return '<span class="badge ' + status[data].class + '">' + status[data].title + '</span>';
        },
      },
      // {
      //   targets: 10,
      //   render: function (data, type, full, meta) {
      //     var r = `<div class='row'>`;
      //     if (full.binary_q_l > 1) {
      //       r += `<div class='col-6'>
      //                       <span>L</span>
      //                       <span data-toggle="tooltip" title="active binary">
      //                         <img data-toggle="tooltip" title="active binary" src="` + burl + `/assets/images/binary_active.png" width="15px"/>
      //                       </span>
      //                         </div>`;
      //     } else {
      //       r += `<div class='col-6'>
      //                       <span>L</span>
      //                       <span data-toggle="tooltip" title="inactive binary"><img data-toggle="tooltip" title="inactive binary" src="` + burl + `/assets/images/binary_inactive.png"  width="15px"/></span>
      //                         </div>`;
      //     }
      //     if (full.binary_q_r > 1) {
      //       r += `<div class='col-6'>
      //                       <span>R</span>
      //                       <span data-toggle="tooltip" title="active binary"><img data-toggle="tooltip" title="active binary" src="` + burl + `/assets/images/binary_active.png" width="15px"/> </span>
      //                       </div>`;
      //     } else {
      //       r += `<div class='col-6'">
      //                       <span>R</span>
      //                       <span data-toggle="tooltip" title="inactive binary"><img  src="` + burl + `/assets/images/binary_inactive.png" width="15px"/> </span>
      //                         </div>`;
      //     }
      //     r += `</div>`
      //     return r;
      //   },
      // },
      {
        targets: 0,
        searchable: false,
      }
    ],
    fnDrawCallback: function () {

      if (!$('#labelSortDiv #dt_binary_tree_report_length').length) {
        $('#dt_binary_tree_report_length label').addClass('col-form-label');
        let el = $('#dt_binary_tree_report_length').detach();
        $('#tableLengthDiv').append(el);

        let el3 = $('#dt_binary_tree_report_filter').detach();
        $('#divForSearch').append(el3);
        // $('#dt_binary_tree_report_filter, #dt_binary_tree_report_length').css('display', 'block');
        $('#dt_binary_tree_report_length select').addClass('col-lg-6 right');
        $('#controlsFormGroup').css('margin-bottom', '-20px');
        $('#dt_binary_tree_report_paginate').css('display', 'none');
      }

      $(".top-scroll").width($("#dt_binary_tree_report").width());

      $(".top-scroll-wrapper").scroll(function () {
        $(".dataTables_scrollBody")
          .scrollLeft($(".top-scroll-wrapper").scrollLeft());
      });

      $(".dataTables_scrollBody").scroll(function () {
        $(".top-scroll-wrapper")
          .scrollLeft($(".dataTables_scrollBody").scrollLeft());
      });

      var api = this.api();

      let jsonData = api.data().context[0].json;
      let levelContent = '';

      if ($('#viewOption').children("option:selected").val() == 'selected') {
        levelContent = ' - levels '
          + $('#levelFrom').children("option:selected").val() + ' to '
          + $('#levelTo').children("option:selected").val();
      }

      $('#recordsTotal div p').html('TOTAL AMBASSADORS' + levelContent);
      $('h4#recordsTotalValue').html(jsonData.recordsTotal);
      $('h4#countActiveUsers').html(jsonData.countActiveUsers);
      $('#ambassadorCounts').css('display', 'block');
    },
    drawCallback: function () {
      $('#dt_binary_tree_report_filter input[type"search"]').css({ width: "80%" });
    }
  });

  $("#dt_binary_tree_report_filter label").append('<div class="glyphicon glyphicon-search"></div>');
  $("#dt_binary_tree_report_filter").addClass('inner-addon right-addon');

  $('#viewByLevel').click(function () {
    table.draw();
  });

  $('#btnResetDateRange').on('click', function (e) {
    e.preventDefault();
    $('#dateFrom').val('');
    $('#dateTo').val('');
    $('#reportrange span').html('');
    table.draw();
  });
});
