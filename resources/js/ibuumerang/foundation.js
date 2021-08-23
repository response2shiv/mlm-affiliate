$('#anchorFoundation').on('click', function () {
  $('#modalFoundation').modal('show');
  $('input[data-product-id]').val('39');
});

$('#btnCloseFoundationModal').on('click', function () {
  $('#modalFoundation').modal('hide');
});

$('form#foundation #amount').on('keyup', function(){
  clearTimeout(this.interval);
  this.interval = setTimeout(    
    function(){ 
      let amount = 0;
      amount = $('input[name="amount"]').val();
      $.ajax({
        url: 'api-request',
        method: 'POST',
        data: {
            endpoint: '/affiliate/product-currency',
            method: 'POST',
            data: {
                product_id: 39,
                country: $('input[name="country_code"]').val(),
                locale: navigator.language.replace("-", "_"),    
                amount: amount
            }
        },
        success: function (res) {
            if (res.success == 1){
              $('#amount_convert').html(res.display_amount);             
            }            
            $('form#foundation #order_conversion_id').val(res.order_conversion_id);
        }
      });      
    },
    1500
  );  
});

$('#btnSubmitFoundation').on('click', function (event) {
  event.preventDefault();

  $(this).html('Processing...').attr('disabled', 'disabled');

  let paymentMethod = $('form#foundation select#payment_method').val();
  let amount = parseFloat($('form#foundation #amount').val()).toFixed(2);
  let orderConversionId = $('form#foundation #order_conversion_id').val();

  if (paymentMethod === "0") {
    $('#modalFoundation').modal('hide');
    $('#modalAddNewCard').modal('show');
  } else if (orderConversionId.length > 0) {
    ajaxReq('/affiliate/purchase/foundation', 'POST', {
      'product_id': 39,
      'amount': amount,
      'payment_method_id': paymentMethod,
      'order_conversion_id': orderConversionId
    }, function (res) {
      if (res.error === 0) {
        $('#modalFoundation').modal('hide');
        $('#modalFoundationThankYou').modal('show');
        $('#modalFoundation #amount').val('');
        $('#modalFoundation #payment_method').val('');
      } else {
        resetSubmitButtonState();
      }

      $('#modalFoundation #errorMessage').removeClass('d-none').html(res.msg);
    });
  }
});

$('#modalFoundation').on('hidden.bs.modal', function () {
  resetSubmitButtonState();
});

$('#btnFoundationReturnToDashboard').on('click', function () {
  location.reload();
});

const resetSubmitButtonState = function () {
  $('#btnSubmitFoundation').html('Submit').removeAttr('disabled');
};
