$("#txtSendSMS").intlTelInput({
  utilsScript: '/js/ibuumerang/utils.js',
  initialCountry: "auto",
  geoIpLookup: function(success, failure) {
      $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      var countryCode = (resp && resp.country) ? resp.country : "";
        success(countryCode);
      });
  },
});


$('#btnSendSMS').on('click', function () {
    $(this).html('Sending SMS...');
    $(this).prop('disabled',true);

    console.log($("#txtSendSMS").intlTelInput("getNumber"));

    $.ajax({
        url: '/api-request',
        data: {
            method: 'POST',
            endpoint: '/affiliate/binary-placement/placement-send-sms',
            data: {
                "txtSendSMS": $("#txtSendSMS").intlTelInput("getNumber"),
                "url": $('#url').val(),
                "m": $("#txtSendSMS").intlTelInput("getNumber"),
            }
        },
        success: function (res) {
            if (res.error === 1) {
                showPopupNotification('error','Whoops',res.msg)
                $('#btnSendSMS').html('Send as SMS');
                $('#btnSendSMS').prop('disabled',false);
                resetForm()
                return
            }
                $('#btnSendSMS').html('Send as SMS');
                $('#btnSendSMS').prop('disabled',false);
                showPopupNotification('success','Your enrollment link has been sent',res.msg)
                resetForm()
        },
        error : function(err){
            showPopupNotification('error','Oops!',"You Request Failed!")
            $('#btnSendSMS').html('Send as SMS');
            $('#btnSendSMS').prop('disabled',false);
            resetForm()
        }
    });
});

$('#btnSendEmail').on('click', function () {

    $(this).html('Sending Email...');
    $(this).prop('disabled',true);
    $.ajax({
        url: '/api-request',
        type: 'POST',
        data: {
            method: 'POST',
            endpoint: '/affiliate/binary-placement/placement-send-mail',
            data: {
                "email": $('#email').val(),
                "url": $('#url').val(),
                "e": $('#email').val(),
            }
        },
        success: function (res) {
            if (res.error === 1) {
                showPopupNotification('error','Whoops',res.msg)
                $('#btnSendEmail').html('Send as Email');
                $('#btnSendEmail').prop('disabled',false);
                resetForm()
                return
            }
                $('#btnSendEmail').html('Send as Email');
                $('#btnSendEmail').prop('disabled',false);
                showPopupNotification('success','Your enrollment link has been sent',res.msg)
                resetForm()
        },
        error : function(err){
            showPopupNotification('error','Oops!',"You Request Failed!")
            $('#btnSendEmail').html('Send as Email');
            $('#btnSendEmail').prop('disabled',false);
            resetForm()
        }
    });
})

$('#buttonClipboard').on('click',function(){

    var clipboard = new ClipboardJS('#buttonClipboard');

    clipboard.on('success', function(e) {
        console.log(e.text);
        if(e.text == ''){
            showPopupNotification('error','Whoops!',"Error on copy to clipboard");
            clipboard.destroy();
            return
        }
        showPopupNotification('success','Url copied to clipboard: ', e.text)

        e.clearSelection();
        clipboard.destroy();
    });
});

function setUrlToSend(url) {
    $('#url').val(url);
}

function resetForm() {
    $('#txtSendSMS').val('');
    $('#email').val('');
}

function drawList(url_image)
{

    $.ajax({
        url: "/api-request",
        data: {
            method: "GET",
            endpoint: '/affiliate/binary-placement/direct-line'
        }
    }).done(function(res) {
        var i = 0;

        $.each(res.data.tree, function (key, item) {
            i++;

            if (item.status_pqv == true) {
                color = '#0091d0';
                status_pqv = 'Active'
            } else  {
                color = '#f74827';
                status_pqv = 'Inactive'
            }



            html = "<tr style='color: "+color+"'>";
            html += "<td class='font-weight-bold'>"+item.distid+"</td>";
            html += "<td>"+item.firstname+"</td>";
            html += "<td>"+item.lastname+"</td>";
            html += "<td>"+item.binary_placement+"</td>";
            html += "<td>"+status_pqv+"</td>";
            html += "</tr>";

            $('#body_direct_line').append(html);
        });

        $('#tb_direct_line').DataTable({
            responsive: true,
            searching: true,
            retrieve: true,
            order: [[0, "asc"]],
            drawCallback: function () {
                $("#tb_direct_line_filter").remove();
            }
        });

        $("#placement-search").on("click", function(){
            $("#tb_direct_line")
              .DataTable()
                .search($("#search").val())
                .draw();
          });
    });

}

