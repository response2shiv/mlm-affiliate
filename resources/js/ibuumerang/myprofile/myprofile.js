var usePrimaryAddress = false;

$(document).ready(function() {
  // alert("Ready");
  hideLoading();
  toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: "slideDown",
    timeOut: 3000
  };

  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });
});

$("body").on("click", "#btnSaveForm", function(e) {
  e.preventDefault();

  showLoading();

  var request = getFormData();
  console.log(request);
  $.ajax({
    url: "/api-request",
    method: "POST",
    data: request,
    success: ({ data }) => {
      
      if (data.error == 1) {
        // toastr.warning(`${data.msg}`, "Notification");
        showPopupNotification("error", "My Profile", data.msg);
        hideLoading();
        return;
      }
      showPopupNotification(
        "success",
        "My Profile",
        "Information saved successfully"
      );
      // toastr.success("Information saved successfully!", "Notification");
      syncUserSession();
      hideLoading();
    },
    error: err => {
      // console.log(err);
      showPopupNotification("error", "My Profile", "Update failed");
      // toastr.error("Update failed!", "Notification");
      hideLoading();
    }
  });
});

function getFormData() {
  var request = {};
  var ObjData = {};

  //parse form data to array;
  var formData = $("#postForm").serializeArray();

  //parse array of data to Object
  $.each(formData, function(i, item) {
    ObjData[item.name] = item.value;
  });

  //return the request data
  request.data = ObjData;
  request.method = $("#postForm").data("method");
  request.endpoint = $("#postForm").data("endpoint");

  return request;
}

$("body").on("click", ".btnIdecideSavePassword", function(e) {
  var idecide_new_pass = $("#idecide_new_pass").val();

  if (idecide_new_pass == "") {
    alert("password input is required!");
    return;
  }

  var method = $(this).data("method");
  var endpoint = $(this).data("endpoint");

  $.ajax({
    url: "/api-request",
    method: "POST",
    dataType: "json",
    data: {
      method,
      endpoint,
      data: {
        idecide_new_pass
      }
    },
    success: ({ data }) => {
      if (data.error == 1) {
        // toastr.warning(`${data.msg}`, "Notification");
        showPopupNotification("error", "My Profile", data.msg);
        hideLoading();
        return;
      }
      // toastr.success("Information saved successfully!", "Notification");
      showPopupNotification(
        "success",
        "My Profile",
        "Information saved successfully"
      );
      hideLoading();
    },
    error: err => {
      // console.log(err);
      // toastr.error("Update failed!", "Notification");
      showPopupNotification("error", "My Profile", "Update failed");
      hideLoading();
    }
  });
});

$("body").on("click", ".btnIdecideSaveEmail", function(e) {
  var idecide_email = $("#idecide_email").val();

  if (idecide_email == "") {
    alert("email input is required!");
    return;
  }

  var method = $(this).data("method");
  var endpoint = $(this).data("endpoint");

  $.ajax({
    url: "/api-request",
    method: "POST",
    dataType: "json",
    data: {
      method,
      endpoint,
      data: {
        idecide_email
      }
    },
    success: ({ data }) => {
      if (data.error == 1) {
        // toastr.warning(`${data.msg}`, "Notification");
        showPopupNotification("error", "My Profile", data.msg);
        hideLoading();
        return;
      }
      // toastr.success("Information saved successfully!", "Notification");
      showPopupNotification(
        "success",
        "My Profile",
        "Information saved successfully"
      );
      hideLoading();
    },
    error: err => {
      // console.log(err);
      // toastr.error("Update failed!", "Notification");
      showPopupNotification("error", "My Profile", "Update failed");
      hideLoading();
    }
  });
});

$("#billingAddressSelect").change(function() {
  var value = $(this)
    .find(":selected")
    .val();

  if (value == -1) {
    $("#addressForm").show();
    $("#btnAddCard").text("Add card & address");
  } else {
    $("#addressForm").hide();
    $("#btnAddCard").text("Add card");
  }
});

$("body").on("click", ".deletePaymentMethodButton", function() {
  $(this).prop("disabled", true);
  $(this).text("Deleting...");

  const payment_method_id = $(this).data("payment");
  var endpoint = $(this).data("endpoint");
  var method = $(this).data("method");

  var row = $(this)
    .parent()
    .parent();

  $.ajax({
    url: "/api-request",
    method: "POST",
    data: {
      endpoint,
      method,
      data: {
        payment_method_id
      }
    },
    success: ({ data }) => {
      if (data.error == 1) {
        // toastr.warning(`${data.msg}`, "Notification");
        showPopupNotification("error", "My Profile", data.msg);
        hideLoading();
        return;
      }
      // toastr.success("Payment Method has been Deleted!", "Notification");
      showPopupNotification(
        "success",
        "My Profile",
        "Payment Method has been Deleted"
      );
      row.hide();
      hideLoading();
    },
    error: err => {
      // console.log(err);
      // toastr.error("You Request has failed!", "Notification");
      showPopupNotification("error", "My Profile", "You Request has failed");
      hideLoading();
    }
  });
});

/*
    Get Payment Method
*/

$("body").on("click", "#btnEditPaymentMethod", function(e) {
  e.preventDefault();

  const payment_method = $(this).data("payment");
  $("#update_payment_method_id").val(payment_method);

  console.log(payment_method);
  $.ajax({
    url: "/api-request",
    method: "POST",
    data: {
      endpoint: "/affiliate/user/payment-methods/get-card/" + payment_method,
      method: "GET"
    },
    success: res => {
      if (res.response_code == 200) {
        $("#first_name").val(res.data.first_name);
        $("#last_name").val(res.data.last_name);
        $("#number")
          .val(res.data.card_number)
          .attr("readonly", true);
        $("#expiry_date").val(res.data.expiry_date);

        $("#address1").val(res.data.address1);
        $("#city").val(res.data.city);
        $("#apt").val(res.data.apt);
        $("#postal_code").val(res.data.zipcode);
        $("#countrycode").val(res.data.country_code);

        getStates(res.data.state);
        $("#stateprov").val(res.data.state);
        $("#modalAddNewCardShoppingCart").modal("show");
      } else {
        showPopupNotification("warning", "Oops!", res.data);
        $("#modalAddNewCardShoppingCart").modal("hide");
      }
    },
    error: err => {
      //console.log(err)
      showPopupNotification("error", "Oops!", res.message[0]);
      hideLoading();
    }
  });
});

/*
  Set PaymentMethod as Primary
 */
$("body").on("click", ".setPrimary", function(e) {
  e.preventDefault();

  const payment_method = $(this).data("id");
  showLoading();

  $.ajax({
    url: "/api-request",
    method: "POST",
    data: {
      endpoint: "/affiliate/user/payment-methods/setPrimary",
      method: "POST",
      data: {
        payment_method: payment_method
      }
    },
    success: res => {
      if (res.response_code == 200) {
        showPopupNotification("success", "Yeah", res.data);
      } else {
        showPopupNotification("warning", "Oops!", res.data);
      }
      hideLoading();
      window.location.reload();
    },
    error: err => {
      //console.log(err)
      showPopupNotification("error", "Oops!", res.message[0]);
      hideLoading();
    }
  });
});

function showLoading() {
  $(".loading").fadeIn(500);
}
function hideLoading() {
  $(".loading").fadeOut(500);
}

$uploadCrop = $("#upload-demo").croppie({
  enableExif: true,
  viewport: {
    width: 200,
    height: 200,
    circle: false
  },
  boundary: {
    width: 300,
    height: 300
  }
});

$("#upload").on("change", function() {
  var reader = new FileReader();
  reader.onload = function(e) {
    $uploadCrop
      .croppie("bind", {
        url: e.target.result
      })
      .then(function() {
        // console.log('jQuery bind complete');
      });
  };
  $(".upload-result").attr("disabled", false);
  reader.readAsDataURL(this.files[0]);
});

$(".upload-result").on("click", function(ev) {
  $(this).html("Uploading...");
  $(this).attr("disabled", true);

  $uploadCrop
    .croppie("result", {
      type: "canvas",
      size: "viewport"
    })
    .then(function(resp) {
      showLoading();
      $.ajax({
        url: "/profile/upload",
        type: "POST",
        data: { image: resp },
        success: function(data) {
          hideLoading();
          toastr.success("You Profile Image has been Updated!", "Notification");
          $("#collapseUpload").collapse("hide");
          location.reload();
        }
      });
    });
});

$(".custom-file-input").on("change", function() {
  let fileName = $(this)
    .val()
    .split("\\")
    .pop();
  $(this)
    .next(".custom-file-label")
    .addClass("selected")
    .html(fileName);
});

$("#primary-address").on("click", function(ev) {
  var checkbox = $("#primary-address input[type='checkbox']");

  if (checkbox.prop("checked") == true) {
    $uploadCrop
      .croppie("result", {
        type: "canvas",
        size: "viewport"
      })
      .then(function(resp) {
        showLoading();
        $.ajax({
          url: "/get-primary-address",
          type: "GET",
          data: { primary_address: resp },
          success: function(data) {
            hideLoading();
            $("#address1").val(data.primary_address.address1);
            $("#address2").val(data.primary_address.address2);
            $("#apt").val(data.primary_address.apt);
            $("#city").val(data.primary_address.city);
            $("#stateprov").val(data.primary_address.stateprov);
            $("#postalcode").val(data.primary_address.postalcode);
            $("#countrycode").val(data.primary_address.countrycode);
          }
        });
      });
  }
});

$("#scroll-target").click(function(event) {
  topoHt = $("#scroll-target").height();

  $("html, body").animate(
    {
      scrollTop: $("#target").offset().top - topoHt
    },
    200
  );
});

$("#btnCancelAddNewCard").on("click", function() {
  $("#modalAddNewCardShoppingCart").modal("hide");
});

$("#btnAddAddNewCard").on("click", function() {
  clearFormAddNewCard();
  getStates();
  $("#modalAddNewCardShoppingCart").modal("show");
});

/*
Get Countries
 */
$.ajax({
  url: "/api-request",
  method: "POST",
  data: {
    endpoint: "/affiliate/get-countries",
    method: "GET"
  },
  success: function(res) {
    $.each(res.data, function(index, country) {
      $("#countrycode").append(`
                            <option value="${country.countrycode}">${country.country}</option>
                        `);
    });
  }
});

/*
  Set Primary Address
 */
$("#primary_address").on("click", function() {
  usePrimaryAddress = !usePrimaryAddress;

  //console.log(usePrimaryAddress)
  if (usePrimaryAddress) {
    $(".address").val("Loading...");
    $.ajax({
      url: "/api-request",
      method: "POST",
      data: {
        endpoint: "/affiliate/user/primary-address",
        method: "GET"
      },
      success: ({ data }) => {
        //console.log(data.address1);
        //console.log(data.address1);
        $("#address1").val(data.address1);
        $("#city").val(data.city);
        $("#apt").val(data.apt);
        $("#postal_code").val(data.postalcode);
        $("#countrycode").val(data.countrycode);
        $("#stateprov").append(
          `<option value="${data.stateprov}" selected>${data.stateprov}</option>`
        );
      },
      error: err => {
        //console.log(err)
      }
    });
  } else {
    $("#address1").val("");
    $("#city").val("");
    $("#apt").val("");
    $("#postal_code").val("");
    $("#countrycode").val("");
    $("#stateprov").val("");
  }
});

/*
  Country Code Select
*/

$("#countrycode").on("change", function() {
  getStates();
});

/*
  GET STATES
*/
function getStates(stateData) {
  $.ajax({
    url: "/api-request",
    method: "POST",
    data: {
      endpoint: "/affiliate/get-states/" + $("#countrycode").val(),
      method: "GET"
    },
    success: function(res) {
      let selectStates = $("#stateprov");

      selectStates.html("");

      $.each(res.data, function(index, state) {
        selectStates.append(`
                                  <option value="${state.code ??
                                    state.name}">${state.name}</option>
                              `);
      });

      if (stateData) {
        selectStates.append(`
                                  <option value="${stateData}" selected>${stateData}</option>
                            `);
      }
    }
  });
}

/*
  Submit with new PaymentMethod
 */
$("#btnSubmitNewCard").on("click", function(event) {
  $(this).attr("disabled", true);
  $(this).html("Please Wait...");

  event.preventDefault();

  address = {
    address1: $("#address1").val(),
    apt: $("#apt").val(),
    countrycode: $("#countrycode").val(),
    postalcode: $("#postal_code").val(),
    stateprov: $("#stateprov").val(),
    city: $("#city").val(),
    usePrimaryAddress
  };

  credit_card = {
    last_name: $("#last_name").val(),
    first_name: $("#first_name").val(),
    number: $("#number").val(),
    expiry_date: $("#expiry_date").val(),
    update_payment_method_id: $("#update_payment_method_id").val()
  };

  $.ajax({
    url: "/api-request",
    method: "POST",
    data: {
      endpoint: "/affiliate/user/payment-methods/add-card",
      method: "POST",
      data: {
        credit_card,
        address
      }
    },
    success: function(data) {
      if (data.success === true) {
        $(this).removeClass("disabled");
        showPopupNotification(
          "success",
          "Yeah",
          "Credit card added successfully"
        );
        $("#btnSubmitNewCard").attr("disabled", true);
        $("#btnSubmitNewCard").html("Continue");
        $("#modalAddNewCardShoppingCart").modal("hide");
        window.location.reload();
        return;
      }

      let error = $("#modalAddNewCardShoppingCart #errorMessage")
        .removeClass("d-none")
        .html("");

      if (data.success === false) {
        errorMessages = "<ul>";

        $.each(data.errors, function(index, value) {
          errorMessages += "<li>" + value + "</li>";
        });

        errorMessages += "</ul>";
        error.html(errorMessages);

        $("#btnSubmitNewCard").attr("disabled", false);
        $("#btnSubmitNewCard").html("Continue");

        showPopupNotification(
          "warning",
          "Oops!",
          "This card could not be added"
        );

        return;
      }
    },
    error: function(err) {
      $("#btnSubmitNewCard").attr("disabled", false);
      $("#btnSubmitNewCard").html("Continue");
    }
  });
});

/*
  clear modal add new credit card
*/

function clearFormAddNewCard() {
  $("#address1").val("");
  $("#apt").val("");
  $("#countrycode").val("");
  $("#postal_code").val("");
  $("#stateprov").val("");
  $("#city").val("");
  $("#last_name").val("");
  $("#first_name").val("");
  $("#number")
    .val("")
    .attr("readonly", false);
  $("#expiry_date").val("");
}
