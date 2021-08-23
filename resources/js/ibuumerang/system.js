//Function to execute ajax calls
var arrayParams = Array();
var jsonParams = {};
var display2 = {};
function ajaxRequest(url, type, params, successCallback, failCallback, returnResponse) {
  params = (params == null) ? jsonParams[""] = "" : jsonParams;
  returnResponse = (returnResponse == null) ? returnResponse = false : returnResponse;
  successCallback = (successCallback == null) ? successCallback = "" : successCallback;
  failCallback = (failCallback == null) ? failCallback = "" : failCallback;
  //Getting token from views/layout/default.blade.php
  //This is required when making post requests
  var system_token = $('#system_token').val();
  //Appending token to the oject
  params["_token"] = system_token;
  //transforming object into json
  //var json = JSON.stringify(params);
  //console.log("Ready to send "+json); //use the console for debugging, F12 in Chrome, not alerts
  //console.log("before send");
  //console.log(params);
  //console.log(url);
  $.ajax({
    url: url,
    type: type,
    timeout: 20000,
    data: params,
    dataType: "json",
    success: function (data, textStatus, jqXHR) {
      if (returnResponse) {
        data.status = 200;
        return data;
      } else {
        data.status = 200;
        successCallback(data, textStatus, jqXHR);
      }
    },
    error: function (errorThrown, textStatus, jqXHR) {
      //redirecting user to the login when we receive 401 from laravel
      if (errorThrown.status == 401) {
        window.location = "/";
        return false;
      }
      if (returnResponse) {
        return data;
      } else {
        failCallback(errorThrown, textStatus, jqXHR);
      }
    }
  });
}

function updateCartBadge() {
  $.get('/get-total-items-cart', function (data) {
    $("#cart-items-badge").html(data);
  })
}

//Setting menu preferences
$(document).ready(function () {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).on('click', '.navbar-minimalize', function (e) {
    e.preventDefault();
    return;
    var classname = document.body.className;
    var check = classname.includes("mini-navbar");

    if (check) {
      jsonParams["class"] = "mini-navbar";
    } else {
      jsonParams["class"] = "";
    }
    var url = "/user/set-menu";
    showLoading();
    ajaxRequest(url, "POST", jsonParams, limboFunction, limboFunction);
    //console.log("ready! classname="+classname+" Class exists? "+check);
  });

  //Change store on top bar drop down
  $("#store-selector").change(function () {
    var store_selected = $('#store-selector').val();
    jsonParams["store"] = store_selected;
    var url = "/stores/set-default";
    showLoading();
    ajaxRequest(url, "POST", jsonParams, reloadCurrentUrl, reloadCurrentUrl);
  });

  loadPopupNotification();

  //This button add product to shopping cart by api.
  $(document).on('click', '.btnAddToCart', function (e) {

    var product_id = $(this).data('product');
    var modal = $(this).data('modal');
    var amount = $('#amount').val();

    $(modal).modal('hide');

    $.ajax({
      url: '/shopping-cart/add-to-cart',
      method: 'POST',
      data: {
        product_id: product_id,
        quantity: 1,
        amount
      },
      success: function (res) {

        if(res.data.error == 0){
          updateCartBadge();
          showPopupNotification('success', 'Success', res.data.msg)
          if (modal == 'REDIRECT') {
            return window.location.href = '/shopping-cart'
          }
          //udpate qty on bagde in topbar
          $('#cart-items').text(res.data.cartItems)
          return
        }else{
          showPopupNotification('warning','Attention',res.data.msg)
          return
        }
      },
      error: function (error) {
        console.log(error)
      }
    });
  })
});

//After user selects a different store, reload the same url he is in
function reloadCurrentUrl() {
  //Every end of ajax function should call this
  //console.log("reloadCurrentUrl called");
  location.reload();
}

//Just because we need to send the callback function
function limboFunction() {
  //Every end of ajax function should call this
  loadPopupNotification();
  hideLoading();
}

//Popup Notification from the database
function loadPopupNotification() {
  // var url="/notifications/popup"
  // ajaxRequest(url, "GET", null, printNotification, printNotification);
}

function printNotification(data) {
  //console.log("Data received "+data.data);
  var json = data.data;
  if (json != null) {
    if (json.length > 0) {
      for (var i = 0; i < json.length; i++) {
        var row = json[i];

        showPopupNotification(row.type, row.title, row.message);
      }
    }
  }
}

//Function to load popup notification
function showPopupNotification(type, title, message, timeout, position) {
  type = (type == null) ? 'success' : type;
  message = (message == null) ? '' : message;
  timeout = (timeout == null) ? 4000 : timeout;
  position = (position == null) ? "toast-top-center" : position;
  title = (title == null) ? "EBT Notification" : title;

  toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: timeout,
    positionClass: position
  };
  switch (type) {
    case 'success':
      toastr.success(message, title);
      break;
    case 'info':
      toastr.info(message, title);
      break;
    case 'warning':
      toastr.warning(message, title);
      break;
    case 'error':
      toastr.error(message, title);
      break;
    default:
      toastr.success(message, title);
  }
}

//Function to parse serialized data from form
function parseSerialized(data) {
  for (i = 0; i < data.length; i++) {
    var row = data[i];
    jsonParams[row.name] = row.value
  }
  return jsonParams;
}

//Functions to show/hide loading element
//Under breadcrumb.blade.php
function showLoading() {
  $('.loading').fadeIn(500);
}
function hideLoading() {
  $('.loading').fadeOut(500);
}

function showContainerLoading(element) {
  var spinner = '<div class="sk-spinner sk-spinner-cube-grid">' +
    '<div class="sk-cube"></div>' +
    '<div class="sk-cube"></div>' +
    '<div class="sk-cube"></div>' +
    '<div class="sk-cube"></div>' +
    '<div class="sk-cube"></div>' +
    '<div class="sk-cube"></div>' +
    '<div class="sk-cube"></div>' +
    '<div class="sk-cube"></div>' +
    '<div class="sk-cube"></div>' +
    '</div>';
  $(element).html(spinner);
}

function syncUserSession() {
  var url = "/user-update-session";
  //var url="/dashboard/store-ranking/04-01-2017/04-30-2017";
  ajaxRequest(url, "GET", null, updateSideMenu, updateSideMenu);
}

function updateSideMenu(data, textStatus, jqXHR) {
  // console.log(data);
  if (data.firstname.length > 1) {
    $('.full-name-avatar').html(data.firstname + "<br>" + data.lastname);
    $('.name-line').animate({width: data.pv+'%'}, 3000);
    $('#rank-profile-description').html(data.achieved_rank_desc);
    $('#profile-avatar').hide();
    $('#profile-avatar').attr("src", data.profile_image_url);
    $('#profile-avatar').fadeIn();
  }
}

$(document).ready(function () {
  updateCartBadge();
});
