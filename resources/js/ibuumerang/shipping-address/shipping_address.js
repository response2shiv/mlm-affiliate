var usePrimaryAddress = false;
var addressId = null;

$(document).ready(function() {
  // alert("Ready");
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  //Get Countries
  $.ajax({
    url: '/api-request',
    method: 'POST',
    data: {
      endpoint: '/affiliate/get-countries',
      method: 'GET'
    },
    success: function (res) {
      $.each(res.data, function (index, country) {
        $('#countrycode').append(`
                            <option value="${country.countrycode}">${country.country}</option>
                        `);
      })
    }
  });

  //Get states
  $.ajax({
    url: "/api-request",
    method: 'POST',
    data: {
      endpoint: '/affiliate/get-states/' + $('#countrycode').val(),
      method: 'GET'
    },
    success: function (res) {
      let selectStates = $('#stateprov');

      selectStates.html('');

      $.each(res.data, function (index, state) {
        selectStates.append(`
                                <option value="${state.code ?? state.name}">${state.name}</option>
                            `);
      })
    }
  });

});

/*
  Set Primary Address
 */
$('#primary_address').on('click', function () {

  usePrimaryAddress = !usePrimaryAddress;

  //console.log(usePrimaryAddress)
  if (usePrimaryAddress) {
    $(".address").val('Loading...');
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
        $("#stateprov").append(`<option value="${data.stateprov}">${data.stateprov}</option>`);

      },
      error: (err) => {
        //console.log(err)
      }
    })

  } else {
    $("#address1").val("");
    $("#city").val("");
    $("#apt").val("");
    $("#postal_code").val("");
    $("#countrycode").val("");
    $("#stateprov").val("");
  }
});

// /*
//   Edit Shipping Address
//  */
// $('.btnEditAddress').on('click', function () {

//   usePrimaryAddress = !usePrimaryAddress;

//   //console.log(usePrimaryAddress)
//   if (usePrimaryAddress) {
//     $(".address").val('Loading...');
//     $.ajax({
//       url: "/api-request",
//       method: "POST",
//       data: {
//         endpoint: "/affiliate/user/primary-address",
//         method: "GET"
//       },
//       success: ({ data }) => {
//         //console.log(data.address1);
//         //console.log(data.address1);
//         $("#address1").val(data.address1);
//         $("#city").val(data.city);
//         $("#apt").val(data.apt);
//         $("#postal_code").val(data.postalcode);
//         $("#countrycode").val(data.countrycode);
//         $("#stateprov").append(`<option value="${data.stateprov}">${data.stateprov}</option>`);

//       },
//       error: (err) => {
//         //console.log(err)
//       }
//     })

//   } else {
//     $("#address1").val("");
//     $("#city").val("");
//     $("#apt").val("");
//     $("#postal_code").val("");
//     $("#countrycode").val("");
//     $("#stateprov").val("");
//   }
// });

/*
  Country Code Select
 */
$('#countrycode').on('change', function () {
  $.ajax({
    url: "/api-request",
    method: 'POST',
    data: {
      endpoint: '/affiliate/get-states/' + $('#countrycode').val(),
      method: 'GET'
    },
    success: function (res) {
      let selectStates = $('#stateprov');

      selectStates.html('');

      $.each(res.data, function (index, state) {
        selectStates.append(`
                                <option value="${state.code}">${state.name}</option>
                            `);
      })
    }
  });
});

/*
  Delete Shipping Address
*/

$('.btnDeleteShippingAddress').on('click', function () {
  var addressId = $(this).attr("id");
  $.ajax({
    url: "/api-request",
    type: "POST",
    ddataType: "json",
    data: {
      endpoint: "/affiliate/user/delete-shipping-address/"+addressId,
      method: "GET"
    },
    success: function (res) {

      if(res.data.error == 0){
        showPopupNotification('success', 'Yeah', 'Shipping address deleted successfully')
        window.location.reload()
        return
      }else{
        showPopupNotification('warning', 'Oops!', 'This address could not be deleted. Please try again later!')
        return
      }

    },
    error: function (err) {
    }
  });
});

/*
  Edit Shipping Address
*/

$('.btnEditShippingAddess').on('click', function () {
  $("#btnSubmitShippingAddress").hide();
  $("#btnEditSubmitShippingAddress").show();
  addressId = $(this).attr("id");
  $.ajax({
    url: "/api-request",
    type: "POST",
    ddataType: "json",
    data: {
      endpoint: "/affiliate/user/get-shipping-address/"+addressId,
      method: "GET"
    },
    success: function (res) {
      console.log(res.data);
      $('#modalAddShippingAddress').modal('show');

      $("#address1").val(res.data.address1);
      $("#city").val(res.data.city);
      $("#apt").val(res.data.apt);
      $("#postal_code").val(res.data.postalcode);
      $("#countrycode").val(res.data.countrycode);
      $("#stateprov").append(`<option value="${res.data.stateprov}">${res.data.stateprov}</option>`);
    },
    error: function (err) {
    }
  });
});

/*
  Set Primary Address
*/

$('.btnSetPrimaryShippingAddress').on('click', function () {
  $("#btnSubmitShippingAddress").hide();
  addressId = $(this).attr("id");
  $.ajax({
    url: "/api-request",
    type: "POST",
    ddataType: "json",
    data: {
      endpoint: "/affiliate/user/set-primary-shipping-address/"+addressId,
      method: "PUT"
    },
    success: function (res) {
      if(res.data.error == 0){
        showPopupNotification('success', 'Yeah', 'Shipping address saved successfully')
        window.location.reload()
        return
      }else{
        showPopupNotification('warning', 'Oops!', 'This address could not be saved. Please try again later!')
        return
      }
    },
    error: function (err) {
    }
  });
});

$('#btnCancelAddShippingAddress').on('click', function () {
  $('#modalAddShippingAddress').modal('hide');
});

$('#btnAddAddShippingAddress').on('click', function () {
   modalClear();
   $("#btnEditSubmitShippingAddress").hide();
   $('#modalAddShippingAddress').modal('show');
   $("#btnSubmitShippingAddress").show();
});

$('#btnSubmitShippingAddress').on('click', function (event) {

    event.preventDefault();

      var address1= $('#address1').val(),
      apt= $('#apt').val(),
      countrycode= $('#countrycode').val(),
      postalcode= $('#postal_code').val(),
      stateprov= $('#stateprov').val(),
      city= $('#city').val();


    $.ajax({
      url: "/api-request",
      type: "POST",
      dataType: "json",
      data: {
        endpoint: "/affiliate/user/save-shipping-address",
        method: "POST",
        data: {
          address1,
          apt,
          countrycode,
          postalcode,
          stateprov,
          city,
          usePrimaryAddress
        }
      },
      success: function (data) {
        console.log(data)

        if (data.data.error === 0) {
          console.log(data.error)
          showPopupNotification('success', 'Yeah', 'Shipping address saved successfully')
          $('#modalAddShippingAddress').modal('hide')
          window.location.reload()
          return
        }

        let error = $('#modalAddShippingAddress #errorMessage').removeClass('d-none').html('');

        if (data.data.error === 1) {
          console.log(data.error)
            error.html('<p>' + data.data.msg + '</p>')
          showPopupNotification('warning', 'Oops!', 'This address could not be saved')
          return
        }


      },
      error: function (err) {
        //console.log(err);
      }
    });

  });

$('#btnEditSubmitShippingAddress').on('click', function (event) {
    event.preventDefault();
    console.log(addressId)
      var address1= $('#address1').val(),
      apt= $('#apt').val(),
      countrycode= $('#countrycode').val(),
      postalcode= $('#postal_code').val(),
      stateprov= $('#stateprov').val(),
      city= $('#city').val();


    $.ajax({
      url: "/api-request",
      type: "POST",
      dataType: "json",
      data: {
        endpoint: "/affiliate/user/update-shipping-address/"+addressId,
        method: "PUT",
        data: {
          address1,
          apt,
          countrycode,
          postalcode,
          stateprov,
          city,
          usePrimaryAddress
        }
      },
      success: function (data) {
        console.log(data)

        if (data.data.error === 0) {
          console.log(data.error)
          showPopupNotification('success', 'Yeah', 'Shipping address saved successfully')
          $('#modalAddShippingAddress').modal('hide')
          window.location.reload()
          return
        }

        let error = $('#modalAddShippingAddress #errorMessage').removeClass('d-none').html('');

        if (data.data.error === 1) {
          console.log(data.error)
            error.html('<p>' + data.data.msg + '</p>')
          showPopupNotification('warning', 'Oops!', 'This address could not be saved')
          return
        }


      },
      error: function (err) {
        //console.log(err);
      }
    });

  });

  function modalClear()
  {
      $('#address1').val('');
      $('#apt').val('');
      $('#countrycode').val('');
      $('#postal_code').val('');
      $('#stateprov').val('');
      $('#city').val('');
      $('#primary_address').prop("checked", false);
  }
