$( document ).ready(function() {

  function onint(){
    // take off all events from the searchfield
    $("#dt_dlg_transfer_history_filter input[type='search']").off();
    // Use return key to trigger search
    $("#dt_dlg_transfer_history_filter input[type='search']").on("keydown", function(evt){
        if(evt.keyCode == 13){
            $("#dt_dlg_transfer_history").DataTable().search($("input[type='search']").val()).draw();
        }
    });    
    
    $("#dt_dlg_transfer_history_filter .glyphicon-search").on("click", function(){    
        $("#dt_dlg_transfer_history")
            .DataTable()
            .search($("input[type='search']").val())                
            .draw();        
    });
  }
    var table = $('#dt_dlg_transfer_history').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        initComplete:function(){onint();},
        searchDelay: 500,
        ordering: false,
        ajax: {
            url: "/e-wallet/datatables-api",
            data: function (data) {
                data.endpoint   = "/affiliate/e-wallet/transfer-history";

                return data;
            }
        },
        columns: [
            {data: 'date'},
            {data: 'type'},
            {data: 'opening_balance'},
            {data: 'closing_balance'},
            {data: 'amount'},
            {data: 'type'},
            {data: 'remarks'},
        ],
        columnDefs: [
            {
                targets: 1,
                render: function (data, type, full, meta) {

                    var status = {
                        "DEPOSIT": {'title': 'In', 'class': 'm-badge--success'},
                        "COUP_CODE_REFUND": {'title': 'In', 'class': 'm-badge--success'},
                        "REFUND": {'title': 'In', 'class': 'm-badge--success'},
                        "ADJUSTMENT_ADD": {'title': 'In', 'class': 'm-badge--success'},
                        "TYPE_OUT": {'title': 'Out', 'class': ' m-badge--danger'},
                    };
                    if (typeof status[data] === 'undefined') {
                        return '<span class="m-badge ' + status['TYPE_OUT'].class + ' m-badge--wide">' + status['TYPE_OUT'].title + '</span>';
                    }
                    return '<span class="m-badge ' + status[data].class + ' m-badge--wide">' + status[data].title + '</span>';
                },
            },
            {
                targets: 2,
                render: function (data, type, full, meta) {
                    return '$' + parseFloat(Math.round(data * 100) / 100).toFixed(2);
                },
            },
            {
                targets: 3,
                render: function (data, type, full, meta) {
                    return '$' + parseFloat(Math.round(data * 100) / 100).toFixed(2);
                },
            },
            {
                targets: 4,
                render: function (data, type, full, meta) {
                    return '$' + parseFloat(Math.round(data * 100) / 100).toFixed(2);
                },
            },
        ],
        createdRow: function( row, data, dataIndex){  

          if (data.type == 'DEPOSIT' || data.type == 'ADJUSTMENT_ADD') {
              $(row).addClass('pvm_failed_row');
          }
        },
        drawCallback: function () {
          $('#dt_dlg_transfer_history_filter input[type="search"]').css({width: "85%"});
        }
    });

    $("#dt_dlg_transfer_history_filter label").append('<div class="glyphicon glyphicon-search"></div>');  
    $("#dt_dlg_transfer_history_filter").addClass('inner-addon right-addon'); 
});

function submitTransfer(){

  var amount = $('#transferAmt').val();

  if(amount == ''){
    showPopupNotification('error', 'Warning','Transfer Amount cannot be empty');
    return
  }

  if(amount <= 0){
    showPopupNotification('error','Warning','Transfer Amount has be greater 0');
    return
  }

  $(this).prop('disabled',true);
  $(this).html('Please wait...');

  //check iPayout user
  let response = checkIpayoutUser()
                            .then(res => res )
                            .catch(error => error);


  var endpoint = '/affiliate/e-wallet/transfer-to-ipayout';
  var method = 'POST';

  $.ajax({
    url: "/api-request",
    method: "POST",
    data: {
      endpoint,
      method,
      data: {
        amount
      }
    },
    success: (data) => {
      if (data.error == 0) {
        console.log(data);
        showPopupNotification('success', 'Great!', 'Your transfer was successful');
        setTimeout(()=>{
            location.reload()
        },2000)    
        return;   
      }
      showPopupNotification('error', 'Whoops', 'You Request has Failed');
      $(this).html('Transfer');
      $(this).prop('disabled',false);      
    },
    error: err => {
      showPopupNotification('error', 'Whoops', 'You Request has failed');
      $(this).html('Transfer');
      $(this).prop('disabled',false);
    }
  });

};

$('#openModalSendType').on('click', function(){
  var amount = $('#transferAmt').val();

    if(amount == ''){
      showPopupNotification('error', 'Warning','Transfer Amount cannot be empty');
      return
    }else{
      $('#modalSendType').modal();
    }

});

$('#btnTranfer').on('click',function(e) {

  var modalSendType = $('#modalSendType');
  
  var amount = $('#transferAmt').val();
  var sendType = $("input[type=radio][name=options]:checked").val();
  var email = $('#txtSendEmail').val();
  var phone = $('#txtSendSMS').val();
  var countryCode = $("#txtSendSMS").intlTelInput("getSelectedCountryData").dialCode;
  
    if(amount == ''){
      showPopupNotification('error', 'Warning','Transfer Amount cannot be empty');
      return
    }

    if(email === ''){
      showPopupNotification('warning','Attention','E-mail is Invalid.')
      return
    }

    if(phone  === ''){
      showPopupNotification('warning','Attention','Phone number is Invalid.')
      return
    }
    
    let hasCountryCode = $("#txtSendSMS").intlTelInput("getNumber").charAt(0);
    
    if( hasCountryCode !== '+') {
      showPopupNotification('warning','Attention','Mobile Phone or Country Code is Invalid.')
      return
    }

  $(this).html('Waiting...');
  $(this).prop('disabled',true);
  
  e.preventDefault();
  var modalEmail = $('#2FactorDialogEmail');
  var modalSms = $('#2FactorDialog');
  var endpoint = '/affiliate/e-wallet/vitals';
  var method = 'POST';
  // return
  $.ajax({
    url: '/api-request',
    type: 'POST',
    data: {
      endpoint,
      method,
      data:{
        sendType,
        email,
        phone,
        countryCode
      }
    },
    dataType: "JSON",
    success: function (data) {
      $('#btnTranfer').html('Submit');
      $('#btnTranfer').prop('disabled',false);
      console.log(data);
      if (data.success === false) {
        showPopupNotification('error','Whoops',"There was an error with the code to send.");
      }
      if(data.success === true && data.email === true) {
        $('#authyUserId').val(data.authyUserId);
        modalEmail.modal();
        modalSendType.modal('hide');
        showPopupNotification('success','Yeah!','Please enter the code that was sent ')
      }
      if(data.success === true && data.email === false && data.sms === true) {
        modalSms.modal();
        modalSendType.modal('hide');
        showPopupNotification('success','Yeah!','Please enter the code that was sent ')
      }
      if(data.success === true && data.email === false && data.sms === false) {
        submitTransfer();
      }
      $('#btnSubmit2FAEWallet').hide();
    }
  });
});


$('#openModalSendTypePDF').on('click', function(){
  $('#modalSendTypePDF').modal();
});

$('#pdfButton').on('click',function(e) {
  
  var modalSendType = $('#modalSendTypePDF'); 
  modalSendType.modal('hide');

  var sendType = $("input[type=radio][name=options]:checked").val();
  var email = $('#txtSendEmailPDF').val();
  var phone = $('#txtSendPDFSMS').val();
  var countryCode = $("#txtSendPDFSMS").intlTelInput("getSelectedCountryData").dialCode;

  e.preventDefault();
  var modalEmail = $('#2FactorDialogEmailPDF');
  var modalSms = $('#2FactorDialogPDF');
  var endpoint = '/affiliate/e-wallet/vitals';
  var method = 'POST';

  let hasCountryCode = $("#txtSendPDFSMS").intlTelInput("getNumber").charAt(0);

  if( hasCountryCode !== '+') {
    showPopupNotification('warning','Attention','Mobile Phone or Country Code is Invalid.')
    return
  }
  
  // return
  $.ajax({
    url: '/api-request',
    type: 'POST',
    data: {
      endpoint,
      method,
      data:{
        sendType,
        email,
        phone,
        countryCode
      }
    },
    dataType: "JSON",
    success: function (data) {
      console.log(data)      
      if (data.success === false) {
        showPopupNotification('error','Whoops',"There was an error with the code to send.");
      } 
      if(data.success === true && data.email === true) {
        $('#authyUserId').val(data.authyUserId);
        showPopupNotification('success','Yeah!','Please enter the code that was sent ');
        modalEmail.modal();
      }
      if(data.success === true && data.email === false && data.sms === true) {
        showPopupNotification('success','Yeah!','Please enter the code that was sent ');
        modalSms.modal();
      }
    }
  });
});

//send code for verification api
$('#btnSubmit2FAEWallet').click(function() {

  var verification_code = $('#2FactorDialog #verificationCode').val();

  if (!verification_code.length) {
    showPopupNotification('warning','Whoops','You must enter the verification code.');
    return;
  }

  $(this).html('Please Wait...')
  $(this).prop('disabled',true)

  var endpoint = '/affiliate/authy/verify';
  var method = 'POST';

  $.ajax({
    url: '/api-request',
    type: 'POST',
    data: {
      endpoint,
      method,
      data:{
        verification_code
      }
    },
    dataType: "JSON",
    success: function (data) {
      
      if (data.success === false) {
        
        showPopupNotification('error','Whoops',data.msg);       
        
        $('#btnSubmit2FAEWallet').html('submit')
        $('#btnSubmit2FAEWallet').prop('disabled',false)
        
        return

      } else {

        $('#btnSubmit2FAEWallet').html('submit...')
        $('#btnSubmit2FAEWallet').prop('disabled',false)
        $('#2FactorDialog').modal('hide');
        
        $('#verificationCode').val("");
        
        console.log(data.url);
        
        window.open(data.url,"_blank");
      }
    }
  });
});

//send code for verification api
$('#btnSubmit2FAEWalletEmailPDF').click(function() {

  var verification_code = $('#2FactorDialogEmailPDF #verificationCode').val();  
  var authy_id = $('#2FactorDialogEmail #authyUserId').val();

  if (!verification_code.length) {
    showPopupNotification('warning','Whoops','You must enter the verification code.');
    return;
  }

  $(this).html('Please Wait...')
  $(this).prop('disabled',true)

  var endpoint = '/affiliate/authy/email/pdf/verify/'+verification_code+'/'+authy_id;
  var method = 'GET';

  $.ajax({
    url: '/api-request',
    type: 'POST',
    data: {
      endpoint,
      method,
    },
    dataType: "JSON",
    success: function (data) {
      console.log(data);
      if (data.success === false) {
        
        showPopupNotification('error','Whoops',data.msg);       
        
        $('#btnSubmit2FAEWalletEmailPDF').html('submit')
        $('#btnSubmit2FAEWalletEmailPDF').prop('disabled',false)
        
        return

      } else {

        $('#btnSubmit2FAEWalletEmailPDF').html('submit...')
        $('#btnSubmit2FAEWalletEmailPDF').prop('disabled',false)
        $('#2FactorDialogEmailPDF').modal('hide');
        
        $('#verificationCode').val("");       
        
        window.open(data.url,"_blank");
      }
    },
    error:function (data) {
      console.log(data);
      $('#btnSubmit2FAEWalletEmailPDF').html('submit...')
      $('#btnSubmit2FAEWalletEmailPDF').prop('disabled',false)
      
    }
  });
});

$('#btnSubmit2FAEPDF').click(function() {
  var email = $('#txtSendEmailPDF').val();
  var phone = $('#txtSendPDFSMS').val();
  var countryCode = $("#txtSendPDFSMS").intlTelInput("getSelectedCountryData").dialCode;
  var verification_code = $('#2FactorDialogPDF #verificationCode').val();

  if (!verification_code.length) {
    showPopupNotification('warning','Whoops','You must enter the verification code.');
    return;
  }

  $(this).html('Please Wait...')
  $(this).prop('disabled',true)

  var endpoint = '/affiliate/authy/verify';
  var method = 'POST';

  $.ajax({
    url: '/api-request',
    type: 'POST',
    data: {
      endpoint,
      method,
      data:{
        verification_code,
        email,
        countryCode,
        phone
      }
    },
    dataType: "JSON",
    success: function (data) {
      
      if (data.success === false) {
        
        showPopupNotification('error','Whoops',data.msg);       
        
        $('#btnSubmit2FAETransfer').html('submit')
        $('#btnSubmit2FAETransfer').prop('disabled',false)
        
        return

      } else {

        $('#btnSubmit2FAETransfer').html('submit...')
        $('#btnSubmit2FAETransfer').prop('disabled',false)
        $('#2FactorDialog').modal('hide');
        
        $('#verificationCode').val("");
        
        window.open(data.url,"_blank");
      }
    }
  });
});

$('#btnSubmitEmail2FAETransfer').click(function() {

  var verification_code = $('#2FactorDialogEmail #verificationCode').val();
  var authy_id = $('#2FactorDialogEmail #authyUserId').val();

  if (!verification_code.length) {
    showPopupNotification('warning','Whoops','You must enter the verification code.');
    return;
  }

  $(this).html('Please Wait...')
  $(this).prop('disabled',true)

  var endpoint = '/affiliate/authy/email/verify/'+verification_code+'/'+authy_id;
  var method = 'GET';

  $.ajax({
    url: '/api-request',
    type: 'POST',
    data: {
      endpoint,
      method
    },
    dataType: "JSON",
    success: function (data) {
      if (data.success === false) {
        
        showPopupNotification('error','Whoops',data.msg);       
        
        $('#btnSubmitEmail2FAETransfer').html('submit')
        $('#btnSubmitEmail2FAETransfer').prop('disabled',false)
        
      } else {

        $('#btnSubmitEmail2FAETransfer').html('submit...')
        $('#btnSubmitEmail2FAETransfer').prop('disabled',false)
        $('#2FactorDialog').modal('hide');
        
        $('#verificationCode').val("");
        
        submitTransfer();
      }
    }
  });
});

$('#btnSubmit2FAETransfer').click(function() {
  var email = $('#txtSendEmail').val();
  var phone = $('#txtSendSMS').val();
  var countryCode = $("#txtSendSMS").intlTelInput("getSelectedCountryData").dialCode;
  var verification_code = $('#2FactorDialog #verificationCode').val();

  if (!verification_code.length) {
    showPopupNotification('warning','Whoops','You must enter the verification code.');
    return;
  }

  $(this).html('Please Wait...')
  $(this).prop('disabled',true)

  var endpoint = '/affiliate/authy/verify';
  var method = 'POST';

  $.ajax({
    url: '/api-request',
    type: 'POST',
    data: {
      endpoint,
      method,
      data:{
        verification_code,
        email,
        countryCode,
        phone
      }
    },
    dataType: "JSON",
    success: function (data) {
      
      if (data.success === false) {
        
        showPopupNotification('error','Whoops',data.msg);       
        
        $('#btnSubmit2FAETransfer').html('submit')
        $('#btnSubmit2FAETransfer').prop('disabled',false)
        
        return

      } else {

        $('#btnSubmit2FAETransfer').html('submit...')
        $('#btnSubmit2FAETransfer').prop('disabled',false)
        $('#2FactorDialog').modal('hide');
        
        $('#verificationCode').val("");
        
        submitTransfer();
      }
    }
  });
});

$('#btnResend2FAEWallet').on('click', function() {
  resendCode();
  showPopupNotification('success','Yeah','Verification Code has resend');
});

 function resendCode() {
  var sendType = $("input[type=radio][name=options]:checked").val();
  var email = $('#txtSendEmail').val();
  var phone = $('#txtSendSMS').val();
  var countryCode = $("#txtSendSMS").intlTelInput("getSelectedCountryData").dialCode;

  var resendButton = $('#btnResend2FA');

  resendButton.prop('disabled', true);
  resendButton.text('Resending code...');

  var endpoint = '/affiliate/e-wallet/vitals';
  var method = 'POST';

  $.ajax({
    url: 'api-request',
    method: 'POST',
    data: {
      method,
      endpoint,
      data:{
        sendType,
        email,
        phone,
        countryCode
      }
    },
    success: function() {
      showPopupNotification('success','Ok','Code has been resent successfully.');
      resendButton.prop('disabled', false);
      resendButton.text('Resend Code')
    }
  });
};

$('#btnResendEmail2FAEWallet').on('click', function() {
  resendEmailCode();
  showPopupNotification('success','Yeah','Verification Code has resend');
});

function resendEmailCode() {
  var sendType = $("input[type=radio][name=options]:checked").val();
  var email = $('#txtSendEmail').val();
  var phone = $('#txtSendSMS').val();
  var countryCode = $("#txtSendSMS").intlTelInput("getSelectedCountryData").dialCode;

  var resendButton = $('#btnResendEmail2FAEWallet');

  resendButton.prop('disabled', true);
  resendButton.text('Resending code...');

  var endpoint = '/affiliate/e-wallet/vitals';
  var method = 'POST';

  $.ajax({
    url: 'api-request',
    method: 'POST',
    data: {
      method,
      endpoint,
      data:{
        sendType,
        email,
        phone,
        countryCode
      }
    },
    success: function(data) {
      $('#authyUserId').val(data.authyUserId);
      showPopupNotification('success','Ok','Code has been resent successfully.');
      resendButton.prop('disabled', false);
      resendButton.text('Resend Code')
    }
  });
};

$('#checkIpayoutUser').on('click', async function() {
    event.preventDefault();

    $(this).prop('disabled',true);
    $(this).html('Please wait...');

    //check iPayout User
    let response = await checkIpayoutUser()
                            .then(res => res )
                            .catch(error => error)

    $(this).prop('disabled',false);
    $(this).html('Launch iPayout Account');
    
    window.open(response.url,'_blank');
});

async function checkIpayoutUser(){
   
  return $.ajax({
    url: '/checkIpayoutUser',
    method: 'GET',      
    success: function(data) {
     return data
    },
    error: function(error){
      return error
    }
  });
 
}

$('#btnResend2FAEWalletPDF').on('click', function() {
  resendCode();
  showPopupNotification('success','Yeah','Verification Code has resend');
});

 function resendCode() {
  var sendType = $("input[type=radio][name=options]:checked").val();
  var email = $('#txtSendEmailPDF').val();
  var phone = $('#txtSendPDFSMS').val();
  var countryCode = $("#txtSendPDFSMS").intlTelInput("getSelectedCountryData").dialCode;

  var resendButton = $('#btnResend2FAEWalletPDF');

  resendButton.prop('disabled', true);
  resendButton.text('Resending code...');

  var endpoint = '/affiliate/e-wallet/vitals';
  var method = 'POST';

  $.ajax({
    url: 'api-request',
    method: 'POST',
    data: {
      method,
      endpoint,
      data:{
        sendType,
        email,
        phone,
        countryCode
      }
    },
    success: function() {
      showPopupNotification('success','Ok','Code has been resent successfully.');
      resendButton.prop('disabled', false);
      resendButton.text('Resend Code')
    }
  });
};

$('#btnResendEmail2FAEWalletPDF').on('click', function() {
  resendEmailCode();
  showPopupNotification('success','Yeah','Verification Code has resend');
});

function resendEmailCode() {
  var sendType = $("input[type=radio][name=options]:checked").val();
  var email = $('#txtSendEmailPDF').val();
  var phone = $('#txtSendPDFSMS').val();
  var countryCode = $("#txtSendPDFSMS").intlTelInput("getSelectedCountryData").dialCode;

  var resendButton = $('#btnResendEmail2FAEWalletPDF');

  resendButton.prop('disabled', true);
  resendButton.text('Resending code...');

  var endpoint = '/affiliate/e-wallet/vitals';
  var method = 'POST';

  $.ajax({
    url: 'api-request',
    method: 'POST',
    data: {
      method,
      endpoint,
      data:{
        sendType,
        email,
        phone,
        countryCode
      }
    },
    success: function(data) {
      $('#authyUserId').val(data.authyUserId);
      showPopupNotification('success','Ok','Code has been resent successfully.');
      resendButton.prop('disabled', false);
      resendButton.text('Resend Code')
    }
  });
};