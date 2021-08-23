jsonParams = {};
$(document).ready(function () {
//   $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': csrfToken,
//           'Content-Type': 'application/json;',
//       }
//   });

  $('.legend-header .circle-btn').on('click', function (e) {
      const legend = $(e.target).closest('.legend-wrap');
      legend.toggleClass('open');
  });

  $('.search-header .circle-btn').on('click', function (e) {
      const search = $(e.target).closest('.search-wrap');
      search.toggleClass('open');
  });
  $('.avatar-wrap').on('click', function (e) {
      e.preventDefault();
      window.location.href = $(this).data('href');
  });

  var visibleDistributorsStart = [];
  var visibleDistributorsEnd = [];
  var visibleDistributorsAmount = 0;
  var totalDistributorsAmount = 0;
  var isLoadMoreBtnVisible = true;
  var loading = false;
  var currentNode = window.location.href.split('/binary-viewer/')[1];

  var rankClasses = {
    14: 'ncreaser',
    15: 'ncreaser-500',
    16: 'ncreaser-1000',
    17: 'mpacter-5k',
    18: 'mpacter-10k',
    19: 'mpacter-20k',
    20: 'royal-mpacter-50K',
    21: 'royal-mpacter-100K',
    22: 'elite-mpacter-200K',
    23: 'elite-mpacter-500K',
    24: 'eliteroyal-mpacter-500K',
  };

  function getStatusClass(account_status){
    var statusClass = '';
    if(account_status == 'PENDING APPROVAL'){
        statusClass = 'pending-approval';
    }else if(account_status == 'CUSTOMER'){
        statusClass = 'pending-approval';
    }else if(account_status == 'CANCELLED'){
        statusClass = 'pending-approval';
    }else if(account_status == 'APPROVED'){
        statusClass = 'active';
    }else{
        statusClass = 'inactive';
    }
    return statusClass;
  }

  function showResults(data, showMore = false){
    console.log(data);
    var activityClass = '';
    var packageClass = '';

    if(showMore == false) {
        console.log('showmore false');
        $('.search-section .list-wrap .distributors').text('');
        $('button#show-more').removeClass('visible');
        $('.search-section .list-wrap .distributors-end').text('');
    }

    if (data.distributors && typeof(data.distributors.length) !== "undefined") {
        if(data.distributors && data.distributors.length > 0){
            $('#unavailable-msg').remove();
            // Load distributions start
            data.distributors.forEach( distributor => {
                /*if(distributor.current_product_id == 14 || (distributor.account_status !== 'SUSPENDED' && distributor.current_month_qv >= 100 && distributor.account_status !== 'TERMINATED')) {
                    activityClass = 'active';
                } else {
                    activityClass = 'inactive';
                }*/
                activityClass = getStatusClass(distributor.user.account_status);
                packageClass = rankClasses[distributor.user.current_product_id];
                $('.search-section .list-wrap .distributors').append(`
                    <div class="item">
                        <div class="${activityClass}">
                            <span class="number">${distributor.leg}</span>
                            <a href="/organization/binary-viewer/${distributor.uid}" class="btn m-btn distributor-btn">
                                <div class="image ${packageClass}">
                                    <svg version="1.1" class="avatar-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 146.5 178.5" xml:space="preserve">
                                    <path d="M74.9,177.1c-27.4,0-52-11.5-69.5-29.9c6.7-9.2,22.9-15.2,32.5-18.6c9.8-3.5,13.1-5.6,15.7-9
                                        c2.6-3.4,1.5-17.9,1.5-17.9s-5.4-7.5-7.2-12.2c-1.8-4.7-2.1-13.8-2.1-13.8s-4.6-3.1-5.8-6.8c-1.2-3.7-2.2-10.1-1.4-12.8
                                        c0.5-2,2.5-2.1,3.6-2c-0.7-2.4-1.4-5.3-1.7-8.6c-0.6-6.9-0.2-10.7,2.2-16.8C45.8,20.7,55.9,11,70.3,11c7.2,0,15.2,0.7,19.9,3.3
                                        c0,0,4.2-0.6,8.9,2c5.8,3.2,10.4,11.5,10.4,24c0,5.6-0.4,9-1.7,13.8c1.1,0,2.9,0.2,3.4,2.1c0.8,2.8-0.2,9.1-1.4,12.8
                                        c-1.2,3.7-5.8,6.8-5.8,6.8s-0.3,9.1-2.1,13.8c-1.8,4.7-7.2,12.2-7.2,12.2s-1.1,14.5,1.5,17.9c2.6,3.4,5.9,5.5,15.7,9
                                        c9.6,3.4,25.9,9.4,32.5,18.7C126.9,165.7,102.2,177.1,74.9,177.1z"/>
                                    </svg>
                                </div>
                                <span class="distributor-name">${distributor.firstname } ${distributor.lastname}</span>
                                <div class="image selected-pack">
                                    <svg version="1.1" class="logo-small" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 25.8 33.7" xml:space="preserve">
                                    <path d="M7.2,33l14.6-17.7c0.4-0.5,0.5-1.2,0.3-1.8c-0.1-0.5-0.5-1-0.9-1.3l-15-5.5C5.6,6.6,5.1,7,4.9,7.5
                                        C4.8,7.9,5,8.3,5.3,8.5l8.7,6.3c0.2,0.2,0.4,0.4,0.4,0.7c0.1,0.3,0,0.5-0.1,0.8l-9,15.5c-0.1,0.4,0,0.9,0.3,1.1
                                        C6.2,33.3,6.7,33.3,7.2,33z"/>
                                    <path d="M6.2,23.5L19,8c0.3-0.5,0.4-1,0.3-1.6c-0.1-0.5-0.4-0.9-0.8-1.1L5.3,0.5c-0.5-0.1-1,0.2-1.1,0.7
                                        C4.1,1.5,4.3,1.8,4.6,2l7.7,5.5c0.2,0.1,0.3,0.4,0.4,0.6c0,0.2,0,0.5-0.1,0.7L4.7,22.4c-0.1,0.4,0,0.8,0.3,1
                                        C5.3,23.7,5.8,23.8,6.2,23.5z"/>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                `);
            });
        }else{
            $('.search-section .list-wrap .distributors').append('<p id="unavailable-msg" style="color: red;">Sorry, no results found</p>');
        }
    }
  }

  function SendInitSearch(currentNode) {

    //if ($('input[name=leg]:checked').length) {
    jsonParams["endpoint"]  = '/affiliate/organization/binary-viewer/init-search';
    jsonParams["method"]    = "POST";
    jsonParams["data"]      = {
        offset: 0,
        limit: 10,
        endpoint: '/affiliate/organization/binary-viewer/init-search',
        search:  $('#search-input')[0].value,
        currentNode,
        leg: ''//$('input[name=leg]:checked')[0].value
    };
    $.ajax({
        url: "/api-request",
        method: "POST",
        data: jsonParams,
        dataType: "json",
        success: function(data){
            if (data.error == 1) {
                toastr.warning(`${data.msg}`, "Notification");
                console.log(data.msg);
                // hideLoading();
                return;
            }else{
                showResults(data);
            }
        },
        error: err => {
            console.log(err);
        }
    });
    //}
  }

  $('.search-section #search-input').on('keypress', function(e) {
    // on Enter press
    if(e.keyCode === 13) {
        if(!$('.load-more-btn').hasClass('visible')) {
            $('.load-more-btn').addClass('visible');
        }
        SendInitSearch(currentNode);

    }
  });

  $('#search-btn').click(function(){
    if(!$('.load-more-btn').hasClass('visible')) {
        $('.load-more-btn').addClass('visible');
    }
    SendInitSearch(currentNode);
  });

  $('.glyphicon-search').on('click', function(e) {
    
    if(!$('.load-more-btn').hasClass('visible')) {
        $('.load-more-btn').addClass('visible');
    }
    SendInitSearch(currentNode);
    
  });

  $('.search-section span#send-search').on('click', function(e) {
    if (!$('.load-more-btn').hasClass('visible')) {
        $('.load-more-btn').addClass('visible');
    }
    SendInitSearch(currentNode);
  });

  $('.search-section button#show-more').on('click', function(e) {
    if ($('.load-more-btn').hasClass('visible')) {
        // $('.load-more-btn').addClass('loading');
    }

    jsonParams["endpoint"]  = '/affiliate/organization/binary-viewer/search';
    jsonParams["method"]    = "POST";
    jsonParams["data"]      = {
        offset: parseInt($('#search-input').attr('data-offset')),
        endpoint: '/affiliate/organization/binary-viewer/search',
        search:  $('#search-input')[0].value,
        currentNode,
        leg: $('input[name=leg]:checked')[0].value
    };

    $.ajax({
        url: "/api-request",
        method: "POST",
        data: jsonParams,
        dataType: "json",
        success: function(data){
            $('#search-input').attr('data-offset', parseInt($('#search-input').attr('data-offset')) + 10);
            if (data.error == 1) {
                toastr.warning(`${data.msg}`, "Notification");
                console.log(data.msg);
                // hideLoading();
                return;
            } else {
                showResults(data, true);
            }
            console.log(data.msg);
        },
        error: err => {
            console.log(err);
        }
    });
  });  
});


