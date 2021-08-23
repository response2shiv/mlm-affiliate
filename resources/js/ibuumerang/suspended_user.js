
$('#reactivate-subscription-suspended-user').on('click',function(event) {   
    window.location.href = $(this).data('href');    
});

$(document).ready(function() {  
    $('#modalSubscriptionReactivate').attr("data-backdrop", "static");
    $('#modalSubscriptionReactivate').attr("data-keyboard", "false");
    $('#modalSubscriptionReactivate').modal('show');

});

$('#btnSubscriptionReactivateCloseButton').on('click',function(event) {   
    window.location.href = $(this).data('href');    
});

$('#btnReactivateSubscriptionAddCouponCode').on('click', function (event) {
  event.preventDefault();

  let coupon = $('#coupon').val();

  ajaxReq(
    '/affiliate/subscription/reactivate-subscription-add-coupon-code', 
    'POST', 
    {      
      'coupon': coupon,
      'country': $('form#frmReactivateSuspendedSubscription #country_code').val(),
      'locale': navigator.language.replace("-", "_")
    }, 
    function (res) {    
      
      if (res['data'].error == 0) {  
        
        $('#subscription_amount_display').html("$"+res['data'].d.subscription_amount+" USD / "+res['data'].d.subscription_amount_display);
        $('#subscription_amount').html(res['data'].d.subscription_amount);
        $('#subscription_fee').html(res['data'].d.subscription_fee);
        $('#total').html("$"+res['data'].d.total+" USD / "+res['data'].d.total_display);
        $('form#frmReactivateSuspendedSubscription #order_conversion_id').val(res['data'].d.order_conversion_id);
        

        if ( res['data'].d.total === 0 ){
          $('#subscription_payment_method_type_id option:contains("E-WALLET")').prop('selected', true);          
          $("#subscription_payment_method_type_id").attr('disabled', 'true');
        }else{
          $("#subscription_payment_method_type_id").removeAttr('disabled', 'true');
        }

        $('#modalSubscriptionReactivate #errorMessage').addClass('d-none').html('');
        $('#modalSubscriptionReactivate #couponMessage').removeClass('d-none').html(res['data'].msg);

      } else {
        $("#subscription_payment_method_type_id").removeAttr('disabled', 'true');
        $('#modalSubscriptionReactivate #couponMessage').addClass('d-none').html('');
        $('#modalSubscriptionReactivate #errorMessage').removeClass('d-none').html(res['data'].msg);

      }
    }
  );

});

$('#btnSubscriptionReactivateSubmitButton').on('click', function (event) {
    event.preventDefault();
  
    let subscription_payment_method_type_id = $('form#frmReactivateSuspendedSubscription select#subscription_payment_method_type_id').val();
    let amount = $('form#frmReactivateSuspendedSubscription #subscription_amount').val();
    let discount_code =  $('input#coupon').val();
  
    if (subscription_payment_method_type_id === "add_new_card") {
      $('#modalSubscription').modal('hide');
      $('#modalAddNewCard').modal('show');
      $('input[data-product-id]').val('add-new-card-subscription-reactivate-suspended-user');

      $("html,body").css({"overflow":"hidden"});
      $('#modalAddNewCard').css({"overflow":"auto"});
    } else {          
      ajaxReq('/affiliate/subscription/reactivate-suspended-subscription', 'POST', {
  
        'subscription_payment_method_type_id': subscription_payment_method_type_id,
        'discount_code': discount_code,
        'amount': amount,
        'order_conversion_id' : $('form#frmReactivateSuspendedSubscription #order_conversion_id').val()
      }, function (res) {   
  
        if (res['data'].error == 0) {
  
          $('#modalSubscriptionReactivate').modal('hide');
          $('#modalSubscriptionReactivatedSuspendedThankYou').attr("data-backdrop", "static");
          $('#modalSubscriptionReactivatedSuspendedThankYou').attr("data-keyboard", "false");
          $('#modalSubscriptionReactivatedSuspendedThankYou').modal('show');
  
        } else {
          $('#modalSubscriptionReactivate #errorMessage').removeClass('d-none').html(res.data.msg);
        }
      });
    }
  });

  $('#redirectDashboard').on('click',function(event) {   
    window.location.href = '/'    
  });  

  $('html,body').on('click', function () {        
    $("html,body").css({"overflow":"auto"});        
  });