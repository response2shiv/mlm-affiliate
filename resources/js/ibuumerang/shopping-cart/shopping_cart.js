var usePrimaryAddress = false;
var address;
var credit_card;

$(document).ready(function() {
  hideLoading();
  toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: "slideDown",
    timeOut: 3000
  };
  $("#creditCardmsg").append("<p> Please wait ... </p>");

  getUserPaymentsMethods();

  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });

  //Get Countries
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

  var voucher_status = $("#voucher_status").val();

  if (voucher_status == 0) {
    $("#invalidVoucher").modal("show");
  }
});

/*
GET PAYMENTS METHODS
*/
function getUserPaymentsMethods() {
  $.ajax({
    url: "/shopping-cart/user-payment-methods",
    method: "GET",
    success: function(res) {
      let paymentsMethods = $("#payment_method_id");

      paymentsMethods.html("");

      if (res.subscription.creditCards.length > 0) {
        paymentsMethods.append(`
                              <option value="">Choose card</option>
                            `);
        $.each(res.subscription.creditCards, function(index, creditCard) {
          paymentsMethods.append(`

                                  <option value="${creditCard.id}">${creditCard.paymentMethodName}</option>
                              `);
        });
        $("#creditCardmsg").html("");
        $("#creditCards").removeAttr("hidden");
      } else {
        $("#creditCardmsg").html("");
        $("#creditCardmsg").append("<p>No Credit Card found.</p>");
      }
    }
  });
}

/*
  Country Code Select
 */
$("#countrycode").on("change", function() {
  getStates();
});

/*
GET STATES
*/
function getStates() {
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
    }
  });
}

function showLoading() {
  $(".loading").fadeIn(500);
}

function hideLoading() {
  $(".loading").fadeOut(500);
}

$("#btCloseInvalidVoucher").on("click", function() {
  $("#invalidVoucher").modal("hide");
});

/*
  Set Primary Address as Billing Address
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

$("body").on("click", ".remove-product", function(e) {
  e.preventDefault();
  loadingState();

  var product_id = $(this).data("product");

  $.ajax({
    url: "/shopping-cart/remove-from-cart",
    method: "POST",
    data: {
      product_id: product_id,
      quantity: 1
    },
    success: res => {
      showPopupNotification("success", "Yeah", res.message[0]);
      $(`#${product_id}`).remove();
      $("#cart-items-badge").html(res.data.shopping_cart.items);
      $("#numberItens").html(
        "(<strong>" + res.data.shopping_cart.items + "</strong>) items"
      );
      $("#subtotal").html("$ " + res.data.shopping_cart.total);
      $("#total").html("$ " + res.data.shopping_cart.subtotal);
      if (res.data.shopping_cart.items < 1) {
        $("#removeVoucher").click();
        $("#shippingAddress").html("");
        $("#updateCart").html("");
      }

      $(this)
        .closest("tr")
        .html("");
      loadingState();
      return;
    },
    error: err => {
      //console.log(err)
    }
  });
});

/*
  Apply Voucher
 */

$("body").on("click", "#btnVoucher", function() {
  const voucher_code = $("#txtVoucher").val();

  //console.log(voucher_code);
  if (voucher_code.trim() == "") {
    showPopupNotification("warning", "Error", "Please, insert a voucher code");
    return;
  }
  loadingState();

  $.ajax({
    url: "/api-request",
    method: "POST",
    data: {
      endpoint: "/affiliate/shopping-cart/apply-voucher",
      method: "POST",
      data: {
        voucher_code: voucher_code
      }
    },
    success: res => {
      if (res.data.error == 0) {
        showPopupNotification(
          "success",
          "Yeah",
          "Discount applied in your Cart"
        );
        $("#discount-amount").html("$ " + res.data.voucher.discount_amount);
        $("#voucher-code").html("code: " + res.data.voucher.code);
        $("#removeVoucher").data("voucher-id", res.data.voucher.id);
        $("#discount").show();
        $("#applyVoucher").hide();
        $("#total").html("$ " + res.data.shopping_cart.subtotal);
        loadingState();
        return;
      }
      loadingState();
      showPopupNotification("error", "Error", res.data.msg);
    },
    error: err => {
      //console.log(err)
      showPopupNotification("error", "Error", err.message[0]);
      loadingState();
    }
  });
});

/* Delete Voucher */
$("body").on("click", "#removeVoucher", function(e) {
  e.preventDefault();

  const voucher_code = $("#removeVoucher").data("voucher-id");

  if (voucher_code == "") {
    return;
  }

  loadingState();

  $.ajax({
    url: "/api-request",
    method: "POST",
    data: {
      endpoint: "/affiliate/shopping-cart/remove-voucher",
      method: "POST",
      data: {
        voucher_id: $(this).data("voucher-id")
      }
    },
    success: res => {
      if (res.data.error === 0) {
        showPopupNotification(
          "success",
          "Yeah",
          "Voucher Code has been removed"
        );
        $("#discount-amount").html("");
        $("#txtVoucher").val();
        $("#discount").hide();
        $("#applyVoucher").show();
        $("#total").html("$ " + res.data.shopping_cart.subtotal);
      } else {
        showPopupNotification("error", "Error", "The Voucher Code is invalid!");
      }
      loadingState();
      return;
    },
    error: err => {
      // showPopupNotification('error', 'Error', err.message[0])
      loadingState();
    }
  });
});

/*
  Apply PaymentMethod
 */
$("body").on("click", ".paymentMethod", function(e) {
  e.preventDefault();

  const payment_method = $(this).data("id");
  showLoading();

  $.ajax({
    url: "/shopping-cart/apply-payment-method",
    method: "POST",
    data: {
      payment_method: payment_method
    },
    success: res => {
      showPopupNotification("success", "Yeah", "Payment Method Selected!");
      $(".border-primary").removeClass("border-primary");
      $(".payment-icon-big").removeClass("text-success");

      $(this).append(` <i class="fa fa-check"></i>`);
      $(`#${payment_method}`).addClass("border-primary");
      $(`#${payment_method}`)
        .find("i")
        .addClass("text-success");
      $(`#btnContinue`).toggleClass("d-none");
      hideLoading();
    },
    error: err => {
      //console.log(err)
      showPopupNotification("error", "Error", res.message[0]);
      hideLoading();
    }
  });
});

/*
  Set is gift
 */
$("body").on("click", "#gift_box", function(e) {
  showLoading();
  let gift = 0;
  if ($(this).is(":checked")) {
    gift = 1;
  }

  $.ajax({
    url: "/shopping-cart/is-gift",
    method: "POST",
    data: {
      gift: gift
    },
    success: res => {
      showPopupNotification("success", "Yeah", res.data);

      hideLoading();
    },
    error: err => {
      //console.log(err)
      showPopupNotification("error", "Error", res.message[0]);
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
      showPopupNotification("success", "Yeah", res.data);

      hideLoading();
    },
    error: err => {
      //console.log(err)
      showPopupNotification("error", "Error", res.message[0]);
      hideLoading();
    }
  });
});

/*
  Set ShipipngAddress
 */
$("#SelShippingAddress").on("change", function(e) {
  e.preventDefault();
  var address_id = $("#SelShippingAddress").val();

  loadingState();

  $.ajax({
    url: "/shopping-cart/apply-shipping-address",
    method: "POST",
    data: {
      address_id: address_id
    },
    success: res => {
      $("#text_apt").html(res.apt);
      $("#text_city").html(res.city);
      $("#text_countrycode").html(res.countrycode);
      $("#text_stateprov").html(res.stateprov);
      $("#text_address1").html(res.address1);
      $("#text_postalcode").html(res.postalcode);

      showPopupNotification("success", "Yeah", "Shipping Address Selected");
      loadingState();
    },
    error: err => {
      //console.log(err)
      showPopupNotification("error", "Error", "Payment Method Not Selected!");
      loadingState();
    }
  });
});

$("#btnCancelAddNewCard").on("click", function() {
  $("#modalAddNewCardShoppingCart").modal("hide");
  //$('#modalCheckout').modal('show');
});

$("#btnAddAddNewCard").on("click", function() {
  getStates();
  $("#modalAddNewCardShoppingCart").modal("show");
});

//clear cvv
$("#payment_method_id").on("change", function(event) {
  event.preventDefault();
  $("#credit_card_cvv").val("");
});

$("#btnChooseCard").on("click", function(event) {
  event.preventDefault();

  if ($("#payment_method_id").val() == "") {
    showPopupNotification("error", "Error", "Please select the card");
  } else if ($("#credit_card_cvv").val() == "") {
    $("#credit_card_cvv").focus();
    showPopupNotification("error", "Error", "Please insert the CVV");
  } else {
    $("#choose_cc_payment").submit();
  }
});

/*
  Submit with new PaymentMethod
 */

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
    update_payment_method_id: null
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
      $(this).removeClass("disabled");
      if (data.success === true) {
        showPopupNotification(
          "success",
          "Yeah",
          "Credit card added successfully"
        );
        $("#btnSubmitNewCard").attr("disabled", true);
        $("#btnSubmitNewCard").html("Continue");
        $("#modalAddNewCardShoppingCart").modal("hide");
        getUserPaymentsMethods();
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

        showPopupNotification(
          "warning",
          "Oops!",
          "This card could not be added"
        );

        return;
      }
      $("#btnSubmitNewCard").attr("disabled", false);
      $("#btnSubmitNewCard").html("Continue");
    },
    error: function(err) {
      $(this).removeClass("disabled");
      $("#btnSubmitNewCard").attr("disabled", false);
      $("#btnSubmitNewCard").html("Continue");
    }
  });
});
// $("#btnSubmitNewCard").on("click", function(event) {
//   event.preventDefault();

//   address = {
//     address1: $("#address1").val(),
//     apt: $("#apt").val(),
//     countrycode: $("#countrycode").val(),
//     postalcode: $("#postal_code").val(),
//     stateprov: $("#stateprov").val(),
//     city: $("#city").val(),
//     usePrimaryAddress
//   };

//   credit_card = {
//     last_name: $("#last_name").val(),
//     first_name: $("#first_name").val(),
//     number: $("#number").val(),
//     cvv: $("#cvv").val(),
//     expiry_date: $("#expiry_date").val()
//   };

//   $.ajax({
//     url: "/shopping-cart/add-payment-method",
//     method: "POST",
//     dataType: "json",
//     data: {
//       address,
//       credit_card
//     },
//     success: function(data) {
//       if (data.success === true) {
//         $(this).removeClass("disabled");
//         showPopupNotification(
//           "success",
//           "Yeah",
//           "Credit card added successfully"
//         );
//         $("#modalAddNewCardShoppingCart").modal("hide");
//         window.location.reload();
//       }

//       let error = $("#modalAddNewCardShoppingCart #errorMessage")
//         .removeClass("d-none")
//         .html("");

//       if (data.success === false) {
//         errorMessages = "<ul>";

//         $.each(data.errors, function(index, value) {
//           errorMessages += "<li>" + value + "</li>";
//         });

//         errorMessages += "</ul>";
//         error.html(errorMessages);

//         showPopupNotification(
//           "warning",
//           "Error",
//           "This card could not be added"
//         );
//       }
//     },
//     error: function(err) {
//       $(this).removeClass("disabled");
//     }
//   });
// });

$("#checkout").on("click", function() {
  loadingState();

  $.ajax({
    url: "/shopping-cart/process-payment",
    method: "POST",
    dataType: "json",
    success: data => {
      if (data.error === 0) {
        if (data.data.redirect_url != "") {
          // var redirect_url = data.data.redirect_url
          $("#waitingPayment").modal("show");

          setTimeout(function() {
            window.location.href = data.data.redirect_url;
          }, 3000);

          // window.location.href = "/shopping-cart/payment-waiting"
        } else {
          showPopupNotification("success", "Yeah", data.msg);
          window.location.href = "/shopping-cart/thank-you";
        }
        return;
      }

      let errorMsg = "";

      if (Array.isArray(data.msg)) {
        errorMsg = data.msg.join("<br>");
      } else {
        errorMsg = data.msg;
      }

      showPopupNotification("error", "Error", errorMsg);
      loadingState();
    },
    error: err => {
      //console.log(err)
      loadingState();
    }
  });
});

$(".updateCart").on("click", function(event) {
  event.preventDefault();
  let form = $("#update-cart");
  form.submit();
});

function loadingState() {
  $(".loading-state")
    .children(".ibox-content")
    .toggleClass("sk-loading");
}
