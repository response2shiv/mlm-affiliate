$( document ).ready(function() {

    function onint(){

        // take off all events from the searchfield
        $("#weekly_enrollment_table_filter input[type='search']").off();
        // Use return key to trigger search
        $("#weekly_enrollment_table_filter input[type='search']").on("keydown", function(evt){
            if(evt.keyCode == 13){
                $("#weekly_enrollment_table")
                  .DataTable()
                    .search($("input[type='search']").val())
                    .draw();
            }
        });

        $("#weekly_enrollment_table_filter .glyphicon-search").on("click", function(){

          $("#weekly_enrollment_table")
            .DataTable()
              .search($("input[type='search']").val())
              .draw();
        });

    }

    $('#weekly_enrollment_table').DataTable({
        responsive: true,
        initComplete:function(){
            onint();
        },
        searching: true,
        order: [[0, "desc"]],
        drawCallback: function () {
            $("#weekly_enrollment_table_filter input[type='search']").css({width: "80%"});
        }
    });

    $("#weekly_enrollment_table_filter label").append('<div class="glyphicon glyphicon-search"></div>');
    $("#weekly_enrollment_table_filter").addClass('inner-addon right-addon');
});
