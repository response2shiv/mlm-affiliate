$('#btnCloseSubscriptionModal').on('click', function () {
  $('#modalSubscription').modal('hide');
});

$('#btnCancelAddNewCard').on('click', function () {
  $('#modalAddNewCard').modal('hide');
  let gflag = $('#gflag').val();
  if ( !gflag ) {
    $('#modalSubscription #couponMessage').addClass('d-none').html('');
    $('#modalSubscription #errorMessage').addClass('d-none').html('');
    $('#modalSubscription').modal('show');
  }
});

$('#subscription_payment_method_type_id').on('change', function () {
  let paymentMethod = $('form#subscription select#subscription_payment_method_type_id').val();
  if (paymentMethod === "add_new_card" ){
    $('#modalAddNewCard').modal('show');
    $('input[data-product-id]').val('add_new_card_subscription');
  }
});

$('#btnSubscriptionAddNewCardThankYouReturnToDashboard').on('click', function () {
  location.reload();
});

$('#btnSubscriptionReactivatedReturnToDashboard').on('click', function () {
  location.reload();
});

$('#btnSubscriptionReturnToDashboard').on('click', function () {
  location.reload();
});

$('#btnOpenSubscriptionModal').on('click', function () {
  $('#modalSubscription #couponMessage').addClass('d-none').html('');
  $('#modalSubscription #errorMessage').addClass('d-none').html('');
  $('#modalSubscription #coupon').val('');
  $("#selectPayment").removeAttr('disabled', 'true');
  $('#modalSubscription').modal('show');
});

$('#btnOpenSubscriptionSeptemberModal').on('click', function () {
  $('#modalSubscription #couponMessage').addClass('d-none').html('');
  $('#modalSubscription #errorMessage').addClass('d-none').html('');
  $('#modalSubscription #coupon').val('');
  $("#selectPayment").removeAttr('disabled', 'true');
  $('#modalSubscriptionSeptember').modal('show');
});


$('#btnReactivateSubscriptionAddCouponCode').on('click', function (event) {
  event.preventDefault();

  let coupon = $('#coupon').val();

  $( this ).ladda();
  $( this ).ladda( 'start' );

  ajaxReq(
    '/affiliate/subscription/reactivate-subscription-add-coupon-code',
    'POST',
    {
      'coupon': coupon,
      'country': $('form#frmReactivateSubscription #country_code').val(),
      'locale': navigator.language.replace("-", "_")
    },
    function (res) {

      if (res['data'].error == 0) {

        $('form#frmReactivateSubscription #subscription_amount').html(res['data'].d.subscription_amount);
        $('form#frmReactivateSubscription #subscription_amount_display').html("$"+res['data'].d.subscription_amount+" USD / "+res['data'].d.subscription_amount_display);
        $('form#frmReactivateSubscription #subscription_fee').html(res['data'].d.subscription_fee);
        $('form#frmReactivateSubscription #total_display').html("$"+res['data'].d.total+" USD / "+res['data'].d.total_display);
        $('form#frmReactivateSubscription #total').html(res['data'].d.total);
        $('form#frmReactivateSubscription #order_conversion_id').val(res['data'].d.order_conversion_id);

        if ( res['data'].d.total === 0 ){
          $('#selectPayment option:contains("E-WALLET")').prop('selected', true);
          $("#selectPayment").attr('disabled', 'true');
        }else{
          $("#selectPayment").removeAttr('disabled', 'true');
        }

        $('#modalSubscription #errorMessage').addClass('d-none').html('');
        $('#modalSubscription #couponMessage').removeClass('d-none').html(res['data'].msg);

      } else {

        $("#selectPayment").removeAttr('disabled', 'true');
        $('#modalSubscription #couponMessage').addClass('d-none').html('');
        $('#modalSubscription #errorMessage').removeClass('d-none').html(res['data'].msg);

      }
      $.ladda( 'stopAll' );
    }
  );
});

$('#btnSubscriptionReactivateSubmitButton').on('click', function (event) {
  event.preventDefault();

  let paymentMethod = $('form#frmReactivateSubscription select#selectPayment').val();
  let amount = $('form#frmReactivateSubscription #subscription_amount').val();
  let discount_code = $('form#frmReactivateSubscription #coupon').val();
  let orderConversionId = $('form#frmReactivateSubscription #order_conversion_id').val();

  $( this ).ladda();
  $( this ).ladda( 'start' );

  if (paymentMethod === "add_new_card") {
    $('#modalSubscription').modal('hide');
    $('#modalAddNewCard').modal('show');
    $('input[data-product-id]').val('add_new_card_subscription_reactivate');
    $("html,body").css({"overflow":"hidden"});
    $('#modalAddNewCard').css({"overflow":"auto"});
  } else {
    ajaxReq('/affiliate/subscription/reactivate-subscription', 'POST', {
      'payment_method_id': paymentMethod,
      'amount': amount,
      'discount_code': discount_code,
      'order_conversion_id': orderConversionId
    }, function (res) {

      if (res.data.error == 0) {

        $('#modalSubscription').modal('hide');
        $('#modalSubscriptionReactivatedThankYou').attr("data-backdrop", "static");
        $('#modalSubscriptionReactivatedThankYou').attr("data-keyboard", "false");
        $('#modalSubscriptionReactivatedThankYou').modal('show');

      } else {
        $('#modalSubscription #couponMessage').addClass('d-none').html('');
        $('#modalSubscription #errorMessage').removeClass('d-none').html(res.data.msg);
      }

      $.ladda( 'stopAll' );
    });
  }
});

$('html,body').on('click', function () {
  $("html,body").css({"overflow":"auto"});
});



$('#btnSaveSubscription ').on('click',function(event) {

  event.preventDefault();

  // let paymentMethod = $('form#subscription select#subscription_payment_method_type_id').val();
  let paymentMethod = $('form#subscription input#subscription_payment_method_type_id').val();
  let nextSubscriptionDate = $('form#subscription #next-subscription-date').val();

  $( this ).ladda();
  $( this ).ladda( 'start' );
  $('#subscription #errorMessage').addClass('d-none').html('');
  if (paymentMethod === "add_new_card") {
    $('#modalSubscription').modal('hide');
    $('#modalAddNewCard').modal('show');
    $('input[data-product-id]').val('add_new_card_subscription_reactivate');
  }else{
    ajaxReq(
      '/affiliate/subscription/get-grace-period',
      'POST',
      {
        'next_subscription_date': nextSubscriptionDate
      },
      function (data) {
        if (data.data.alert == 1) {
          $('#gflag').val(1);
          $('#alert-title').html(data.data.title);
          $('#alert-message').html(data.data.text);
          $('#modalAlert').attr("data-backdrop", "static");
          $('#modalAlert').attr("data-keyboard", "false");
          $('#modalAlert').modal('show');
        } else {
          $('#gflag').val(0);
          ajaxReq(
            '/affiliate/subscription/save-now',
            'POST',
            {
              'next_subscription_date': nextSubscriptionDate,
              'subscription_payment_method_id': paymentMethod,
              'gflag': $('#gflag').val()
            },
            function (res) {
              console.log(res['data']);

              if (res['data'].error == 0) {
                $('#modalSubscription').modal('hide');
                $('#modalSuscriptionThankYou').attr("data-backdrop", "static");
                $('#modalSuscriptionThankYou').attr("data-keyboard", "false");
                $('#modalSuscriptionThankYou').modal('show');
              } else {
                $('#subscription #errorMessage').removeClass('d-none').html(res.data.msg);
              }
              $.ladda( 'stopAll' );
            }
          );
        }
      }
    );
  }
});

$('#btnYesAlert').on('click',function(event) {

  event.preventDefault();

  let paymentMethod = $('form#subscription input#subscription_payment_method_type_id').val();
  
  let nextSubscriptionDate = $('form#subscription #next-subscription-date').val();

  if (paymentMethod === "add_new_card") {
    $('#modalSubscription').modal('hide');
    $('#modalAddNewCard').modal('show');
    $('input[data-product-id]').val('add_new_card_subscription_reactivate');
  }else{
    ajaxReq(
      '/affiliate/subscription/save-now',
      'POST',
      {
        'next_subscription_date': nextSubscriptionDate,
        'subscription_payment_method_id': paymentMethod,
        'gflag': $('#gflag').val()
      },
      function (res) {
        console.log(res);
        if (res['data'].error == 0) {
          $('#modalSubscription').modal('hide');
          $('#modalAlert').modal('hide');
          $('#modalSuscriptionThankYou').attr("data-backdrop", "static");
          $('#modalSuscriptionThankYou').attr("data-keyboard", "false");
          $('#modalSuscriptionThankYou').modal('show');
        } else {
          $('#modalSubscription #errorMessage').removeClass('d-none').html(res.data.msg);
        }
      }
    );
  }
});

$(function() {
  var end = new Date($( "#next-subscription-date" ).val());
      end.setDate(end.getDate() + 30);

  $( "#next-subscription-date" ).datepicker({
      format: 'yyyy-mm-dd',
      startDate: new Date(),
      endDate: end,
      beforeShowDay: function (date) {
      //getDate() returns the day (0-31)
          if (date.getDate() >= 26) {
              return {enabled: false};
          }
          return [true, ''];
      }
  });
});
