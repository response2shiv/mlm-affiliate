$( document ).ready(function() {

    $('#upgrade-prospects').DataTable({
        responsive: true,
        searching: true,
        order: [[3, "desc"]],
        drawCallback: function () {
            $("#upgrade-prospects_filter input[type='search']").css({width: "80%"});
          }
    });

    $("#upgrade-prospects_filter label").append('<div class="glyphicon glyphicon-search"></div>');
    $("#upgrade-prospects_filter").addClass('inner-addon right-addon');
});
