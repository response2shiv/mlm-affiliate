$('#anchorBillGenius').on('click', function () {
    $.ajax({
        url: 'api-request',
        method: 'POST',
        data: {
            endpoint: '/affiliate/billgenius/sso',
            method: 'POST',
            data: {
                user_id: $('input[id="BillGenius_user_id"]').val(),
            }
        },
        success: function (res) {
            console.log(res);
            if(res.error==="1"){
                showPopupNotification('error','Error',res.msg);
            }else{
                window.open(res,'_blank');
            }            
        }
    });

});

