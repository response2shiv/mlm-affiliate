$('#pdfButton').on('click',function(e) {
    e.preventDefault();
    var modal = $('#2FactorDialog');
    var endpoint = '/affiliate/e-wallet/vitals';
    var method = 'POST';
    modal.modal();
    // return
    $.ajax({
      url: '/api-request',
      type: 'POST',
      data: {
        endpoint,
        method,
      },
      dataType: "JSON",
      success: function (data) {
        console.log(data)
        if (data.success === false) {
          showPopupNotification('error','Whoops',"There was an error with the code to send.");
        } else {
          showPopupNotification('success','Yeah!','Please enter the code that was sent ')
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
  
  $('#btnResend2FAEWallet').on('click', function() {
    resendCode();
    showPopupNotification('success','Yeah','Verification Code has resend');
  });
  
   function resendCode() {
    var resendButton = $('#btnResend2FA');
  
    resendButton.prop('disabled', true);
    resendButton.text('Resending code...');
  
    var endpoint = '/affiliate/authy/request';
    var method = 'POST';
  
    $.ajax({
      url: 'api-request',
      method: 'POST',
      data: {
        method,
        endpoint,
      },
      success: function() {
        showPopupNotification('success','Ok','Code has been resent successfully.');
        resendButton.prop('disabled', false);
        resendButton.text('Resend Code')
      }
    });
  };