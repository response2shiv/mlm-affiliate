window.ajaxReq = function (endpoint, method, data, successCallback) {
  $.ajax({
    url: '/api-request',
    method: 'POST',
    data: {
      endpoint: endpoint,
      method: method,
      data: data
    },
    success: successCallback
  });
}
