$("#txtSendSMS").intlTelInput({
  utilsScript: '/js/ibuumerang/utils.js',
  initialCountry: "auto",
  geoIpLookup: function (success, failure) {
    $.get("https://ipinfo.io", function () { }, "jsonp").always(function (resp) {
      var countryCode = (resp && resp.country) ? resp.country : "";
      success(countryCode);
    });
  },
});

$(document).ready(function () {
  $('div[data-type="group"]').addClass('d-none');
});
// vibe-rider or vibe-driver or igo
$('#type').on('change', function () {
  let opttype = $(this).val();
  if (opttype === 'igo') {
    $('#group').removeClass('d-none');
    $('input[name="igoType"]').val('individual');

  } else if (opttype === 'vibe-driver') {
    $('#group').addClass('d-none');
    $('input[name="igoType"]').val('individual');
    showInputsIndividual();
    activeButtons();
    // input[name="igoType"] = maintained the name for compatibility reasons

  } else if (opttype === 'vibe-rider') {
    $('#group').addClass('d-none');
    $('input[name="igoType"]').val('individual');
    showInputsIndividual();
    activeButtons();

  } else if ($(this).val() === 'bill-genius') {
    $('#group').removeClass('d-none');

    $('input[name="igoType"]').val('individual');
    showInputsIndividual();
    activeButtons();

  } else {
    $('#group').addClass('d-none');

    showInputsIndividual();
    activeButtons();

    $('input[name="igoType"]').val('individual');
  }

  changeWidgetImage($(this).val());
});

$('#btnGroup').on('click', function () {

  showInputsGroup();
  disableButtons();

  $('input[name="igoType"]').val('group');
});

$('#btnIndividual').on('click', function () {
  showInputsIndividual();
  activeButtons();

  $('input[name="igoType"]').val('individual');
});

let changeWidgetImage = function (val) {
  let widgetImage = $('#widgetImage');
  let logoWidgetImage = $('#logoWidgetImage');

  if (val === 'igo') {
    widgetImage.attr('src', 'assets/images/igo_bg.png');
    logoWidgetImage.attr('src', 'assets/images/igo_logosm.png')
      .css({
        "margin-top": "0",
        "height": "60px"
      })
      .show()
  } else if (val === 'vibe-rider') {
    widgetImage.attr('src', 'assets/images/viberides_bg.png');
    logoWidgetImage.attr('src', 'assets/images/vibe_logotext.png')
      .css({
        "height": "100px",
        "margin-top": "100px"
      })
      .show()

  } else if (val === 'vibe-driver') {
    widgetImage.attr('src', 'assets/images/vibedriver_bg.png');
    logoWidgetImage.attr('src', 'assets/images/vibe_logotext.png')
      .css({
        "height": "100px",
        "margin-top": "100px"
      })
      .show()

  } else if (val === 'bill-genius') {
    widgetImage.attr('src', 'assets/images/bg_bill_genius.jpg');
    logoWidgetImage.hide()

  } else {
    widgetImage.attr('src', 'assets/images/generic_bg.png');
    logoWidgetImage.attr('src', 'assets/images/ibuum_gen_logo.png')
      .css({
        "margin-top": "0",
        "height": "60px"
      })
  }
};

const activeButtons = function () {
  $('#btnSendSMS').prop('disabled', false);
  $('#btnSendEmail').prop('disabled', false);
};

const disableButtons = function () {
  $('#btnSendSMS').prop('disabled', true);
  $('#btnSendEmail').prop('disabled', true);
};

const showInputsIndividual = function () {
  $('div[data-type="group"]').addClass('d-none');
  $('div[data-type="individual"]').removeClass('d-none');
  $('#btnIndividual').removeClass('btn-outline-primary').addClass('btn-primary');
  $('#btnGroup').removeClass('btn-primary').addClass('btn-outline-primary');
};

const showInputsGroup = function () {
  $('div[data-type="individual"]').addClass('d-none');
  $('div[data-type="group"]').removeClass('d-none');
  $('#btnIndividual').removeClass('btn-primary').addClass('btn-outline-primary');
  $('#btnGroup').removeClass('btn-outline-primary').addClass('btn-primary');
};

$('#btnReloadBuumerangs').on('click', function () {
  $.ajax({
    url: 'api-request',
    method: 'POST',
    data: {
      endpoint: '/affiliate/product-currency',
      method: 'POST',
      data: {
        product_id: 15,
        country: $('input[name="country_code"]').val(),
        locale: navigator.language.replace("-", "_")
      }
    },
    success: function (res) {
      if (res.success == 1) {
        $('p[data-product-price]').text("$" + res.price + " USD / " + res.display_amount);

      } else {
        $('p[data-product-price]').text(res.price);
      }
      $('input[name="order_conversion_id"]').val(res.order_conversion_id);
      $('p[data-product-name]').text(res.productname);
      $('p[data-product-desc]').text(res.productdesc);
      $('input[data-product-id]').val(res.id);
      $('#product_cart_id').val(res.id);
      $('#productName').text(res.num_boomerangs);
      $('#modalReloadBuumerangs').modal('show');
      $('.btnAddToCart').data('product', res.id).data('modal', '#modalReloadBuumerangs');
    }
  });
});

$('#buttonClipboard').on('click', function () {

  var clipboard = new ClipboardJS('#buttonClipboard');

  clipboard.on('success', function (e) {
    console.log(e.text);
    if (e.text == '') {
      showPopupNotification('error', 'Whoops!', "First Generate Buumerang Code");
      clipboard.destroy();
      return
    }
    showPopupNotification('success', 'Buumerang code copied to clipboard: ', e.text)

    e.clearSelection();
    clipboard.destroy();
  });
});

$('#btnGenerateCode').on('click', function () {

  $(this).html('Please Wait...');
  $(this).prop('disabled', true);

  let type = $('input[name="igoType"]').val();
  let endpoint;
  let data;

  //console.log("number is "+$("#txtSendSMS").intlTelInput("getNumber"));

  if (type === 'individual') {

    let hasCountryCode = $("#txtSendSMS").intlTelInput("getNumber").charAt(0);

    if (hasCountryCode !== '+') {
      showPopupNotification('warning', 'Attention', 'Mobile Phone or Country Code is Invalid.')
      resetGenerateButton()
      $('#btnGenerateCode').prop('disabled', false);
      return
    }

    endpoint = '/affiliate/gem-boom-ind';

    data = {
      "buumerang_product": $('select[name="type"] option:selected').val(),
      "firstname": $('input[name="firstname"]').val(),
      "email": $('input[name="email"]').val(),
      "lastname": $('input[name="lastname"]').val(),
      "mobile": $("#txtSendSMS").intlTelInput("getNumber"),
      "exp_date": $('select[name="exp_date"] option:selected').val()
    }
  } else {
    endpoint = '/affiliate/gem-boom-group';

    data = {
      "buumerang_product": $('select[name="type"] option:selected').val(),
      "exp_date": $('select[name="exp_date"] option:selected').val(),
      "no_of_uses": $('#number_of_uses').val(),
      "campaign_name": $('input[name="campaign_name"]').val()
    }
  }

  $.ajax({
    url: 'api-request',
    type: 'POST',
    data: {
      method: 'POST',
      endpoint: endpoint,
      data: data
    },
    success: function (res) {
      let buumerang_clipboard = "";

      // if ($('#type').val() == 'bill-genius') {
      //   buumerang_clipboard = 'https://www.billgenius.com?c1=' + res.code;
      // } else {
      buumerang_clipboard = res.code;
      // }

      $("#buttonClipboard").attr("data-clipboard-text", buumerang_clipboard);
      $('input[name="buumerang_code"]').val(res.code);

      //$('input[name="buumerang_code"]').after(`<input type="hidden" id="buumerang_clipboard" name="buumerang_clipboard" value="${buumerang_clipboard}">`);

      if (res.error === 1) {
        showPopupNotification('error', 'Whoops', res.msg)
        resetGenerateButton()
        $('#btnGenerateCode').prop('disabled', false);
        return
      }
      showPopupNotification('success', 'Great', 'Ibuumerang Code Generated');
      updateWidgetValues(res)
      resetGenerateButton()
      $('#btnGenerateCode').prop('disabled', false);
    }
  });
});

$('#btnSendSMS').on('click', function () {
  $(this).html('Sending SMS...');
  $(this).prop('disabled', true);

  console.log("number is " + $("#txtSendSMS").intlTelInput("getNumber"));
  $.ajax({
    url: 'api-request',
    type: 'POST',
    data: {
      method: 'POST',
      endpoint: '/affiliate/boom-send-sms',
      data: {
        "buumerang_product": $('select[name="type"] option:selected').val(),
        "firstname": $('input[name="firstname"]').val(),
        "email": $('input[name="email"]').val(),
        "lastname": $('input[name="lastname"]').val(),
        "mobile": $("#txtSendSMS").intlTelInput("getNumber"),
        "exp_date": $('select[name="exp_date"] option:selected').val(),
        "m": $("#txtSendSMS").intlTelInput("getNumber"),
        "c": $('input[name="buumerang_code"]').val()
      }
    },
    success: function (res) {
      if (res.error === 1) {
        showPopupNotification('error', 'Whoops', res.msg)
        $('#btnSendSMS').html('Send as SMS');
        $('#btnSendSMS').prop('disabled', false);
        resetForm()
        return
      }
      $('#btnSendSMS').html('Send as SMS');
      $('#btnSendSMS').prop('disabled', false);
      showPopupNotification('success', 'Great', res.msg)
      resetForm()
    },
    error: function (err) {
      showPopupNotification('error', 'Oops!', "You Request Failed!")
      $('#btnSendSMS').html('Send as SMS');
      $('#btnSendSMS').prop('disabled', false);
      resetForm()
    }
  });
});

$('#btnSendEmail').on('click', function () {

  $(this).html('Sending Email...');
  $(this).prop('disabled', true);
  $.ajax({
    url: 'api-request',
    type: 'POST',
    data: {
      method: 'POST',
      endpoint: '/affiliate/boom-send-mail',
      data: {
        "buumerang_product": $('select[name="type"] option:selected').val(),
        "firstname": $('input[name="firstname"]').val(),
        "email": $('input[name="email"]').val(),
        "lastname": $('input[name="lastname"]').val(),
        "mobile": $("#txtSendSMS").intlTelInput("getNumber"),
        "exp_date": $('select[name="exp_date"] option:selected').val(),
        "e": $('input[name="email"]').val(),
        "c": $('input[name="buumerang_code"]').val()
      }
    },
    success: function (res) {
      if (res.error === 1) {
        showPopupNotification('error', 'Whoops', res.msg)
        $('#btnSendEmail').html('Send as Email');
        $('#btnSendEmail').prop('disabled', false);
        resetForm()
        return
      }
      $('#btnSendEmail').html('Send as Email');
      $('#btnSendEmail').prop('disabled', false);
      showPopupNotification('success', 'Great', res.msg)
      resetForm()
    },
    error: function (err) {
      showPopupNotification('error', 'Oops!', "You Request Failed!")
      $('#btnSendEmail').html('Send as SMS');
      $('#btnSendEmail').prop('disabled', false);
      resetForm()
    }
  });
})



function updateWidgetValues(res) {
  const {
    available,
    pending
  } = res;

  $('#pending_buumerangs').text(pending);
  $('#available_buumerangs').text(available)

}

function resetGenerateButton() {
  var html = `<img src="assets/images/white-icon.png" width="15" height="15" alt="white-icon"> Generate`
  $('#btnGenerateCode').html(html);
}

function resetForm() {
  $('select[name="type"]').val(''),
    $('input[name="firstname"]').val(''),
    $('input[name="email"]').val(''),
    $('input[name="lastname"]').val(''),
    $('select[name="exp_date"]').val(''),
    $("#txtSendSMS").val(''),
    $('input[name="buumerang_code"]').val('')

  //reset default image/logo
  $('#widgetImage').attr('src', 'assets/images/generic_bg.png');
  $('#logoWidgetImage').attr('src', 'assets/images/ibuum_gen_logo.png')
    .css({
      "margin-top": "0",
      "height": "60px"
    })
}
