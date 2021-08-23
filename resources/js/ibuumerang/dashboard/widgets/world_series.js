$( document ).ready(function() {
    var now = new Date;
    var run_owner = 0;
    var hit_owner = 0;
    var error_owner = 0;
    var total_owner = 0;
    var month = 06;
    $('.loading').hide();
    //get worldseries data
    $('.ws-toogle a').click(function(){

        $('.ws-toogle a').removeClass('active');
        $(this).addClass('active');

        if($(this).attr("id") == 'season'){
            month = 06;
        }

        if($(this).attr("id") == 'playoffs'){
            month = 07;
        }

        if($(this).attr("id") == 'world-series'){
            month = 08;
        }

        var serie_date = now.getFullYear() + '-'+month+'-01';

        $.ajax({
        url : "/api-request",
        type : 'post',
        data : {
            endpoint : "/join/resume-owner-world-series",
            method: 'POST',
                data:{
                    sponsorId: $('#sponsorId').val(),
                    date: serie_date
                }
        },
        beforeSend : function(){
            $('.loading').show();
            $('.green-zone').hide();
        }
        })
        .done(function(resposta){
            $('.green-zone').show();
            run_owner = resposta.data.resume.runs;
            hit_owner = resposta.data.resume.hits;
            error_owner = resposta.data.resume.errors;
            total_owner = resposta.data.resume.total;

            $(".run-owner-back p").empty().html(run_owner);
            $(".hit-owner-back p").empty().html(hit_owner);
            $(".error-owner-back p").empty().html(error_owner);
            $(".total-owner-back p").empty().html(total_owner);
            
        })
        .fail(function(jqXHR, textStatus, msg){
            alert(msg);
        });

        $.ajax({
        url : "/api-request",
        type : 'post',
        data : {
            endpoint : "/join/resume-owner-world-series",
            method: 'POST',
                data:{
                    sponsorId: $('#sponsorIdPlayer').val(),
                    date: serie_date
                }
        },
        beforeSend : function(){
            $('.green-zone').hide();
            $('.loading').show();
        }
        })
        .done(function(resposta){
            $('.green-zone').show();
            $('.loading').hide();
            run_player = resposta.data.resume.runs;
            hit_player = resposta.data.resume.hits;
            error_player = resposta.data.resume.errors;
            total_player = resposta.data.resume.total;
            
            $(".run-player-back p").empty().html(run_player);
            $(".hit-player-back p").empty().html(hit_player);
            $(".error-player-back p").empty().html(error_player);
            $(".total-player-back p").empty().html(total_player);
        })
        .fail(function(jqXHR, textStatus, msg){
            alert(msg);
        });
    });
});