@component('layouts.components.modal', ['id' => 'modalAddNewCard'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="row">
        <div class="col-12 alert alert-danger d-none" id="errorMessage"></div>

        <div class="col-6">
            <div class="form-group">
                <label for="first_name" class="control-label">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="last_name" class="control-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="address1" class="control-label">Address</label>
                <input type="text" class="form-control" name="address1" id="address1">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label for="apt" class="control-label">Apt/Suite</label>
                <input type="text" class="form-control" name="apt" id="apt">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label for="countrycode" class="control-label">Country</label>
                <select class="form-control" name="countrycode" id="countrycode"></select>
            </div>
        </div>

        <div class="col-4">
            <div class="form-group">
                <label for="city" class="control-label">City/Town</label>
                <input type="text" class="form-control" name="city" id="city">
            </div>
        </div>

        <div class="col-4">
            <div class="form-group">
                <label for="stateprov" class="control-label">State/Province</label>
                <select class="form-control" name="stateprov" id="stateprov"></select>
            </div>
        </div>

        <div class="col-4">
            <div class="form-group">
                <label for="postal_code" class="control-label">Postal Code</label>
                <input type="text" class="form-control" name="postal_code" id="postal_code">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="number" class="control-label">Card Number</label>
                <input type="text" class="form-control cc-number" name="number" id="number">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label for="cvv" class="control-label">CVV</label>
                <input type="text" class="form-control" name="cvv" id="cvv">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label for="expiry_date" class="control-label">Expiration Date</label>
                <input type="text" class="form-control" name="expiry_date" id="expiry_date" data-mask="99/9999" placeholder="MM/YYYY">
            </div>
        </div>
    </div>

    @slot('actions')   
        <button class="btn btn-default" id="btnCancelAddNewCard">Cancel</button>    
        <button class="ladda-button btn btn-yellow" id="btnSubmitNewCard" data-style="expand-right">
            <span class="ladda-label">Submit</span>
            <span class="ladda-spinner"></span>
            <div class="ladda-progress" style="width: 0;"></div>
        </button>        
    @endslot
@endcomponent

@push('scripts')

    <!-- Ladda -->
    <script src="{{ asset('js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.jquery.min.js') }}"></script>
    <script> 
        
        $('#btnCancelAddNewCard').on('click', function () {
            $('#modalAddNewCard').modal('hide');
            $('#modalCheckout').modal('show');
            $.ladda( 'stopAll' );
        }); 

        $.ajax({
            url: '{{ route('api-request') }}',
            method: 'POST',
            data: {
                endpoint: '/affiliate/get-countries',
                method: 'GET'
            },
            success: function(res) {
                $.each(res.data, function (index, country) {
                    $('#countrycode').append(`
                        <option value="${country.countrycode}">${country.country}</option>
                    `);
                })
            }
        });

        $('#countrycode').on('change', function () {
            $.ajax({
                url: '{{ route('api-request') }}',
                method: 'POST',
                data: {
                    endpoint: '/affiliate/get-states/' + $('#countrycode').val(),
                    method: 'GET'
                },
                success: function(res) {
                    let selectStates = $('#stateprov');

                    selectStates.html('');

                    $.each(res.data, function (index, state) {
                        selectStates.append(`
                            <option value="${state.id}">${state.name}</option>
                        `);
                    })
                }
            });
        });

        $('#btnSubmitNewCard').on('click', function (event) {
            event.preventDefault();
            // Credit card info

            $( this ).ladda(); 
            $( this ).ladda( 'start' );
            let creditCard = {
                firstName: $('#first_name').val(),
                address: $('#address1').val(),
                lastName: $('#last_name').val(),
                apt: $('#apt').val(),
                countryCode: $('#countrycode').val(),
                number: $('#number').val(),
                cvv: $('#cvv').val(),
                city: $('#city').val(),
                state: $('#stateprov').val(),
                expiryDate: $('#expiry_date').val(),
                postalCode: $('#postal_code').val()
            };

            /**
             * Returns the endpoint for the checkout based on the productId.
             *
             * @param productId
             * @returns {string}
             */
            const getEndpointData = function () {
                
                productId = $('input[data-product-id]').val(); 
                OrderConversionId = $('input[name=OrderConversion]').val();

                var data = {
                    "product_id": productId,
                    "discount_code": $('input#coupon').val(),
                    "quantity": 1,
                    "first_name": creditCard.firstName,
                    "last_name": creditCard.lastName,
                    "number": creditCard.number,
                    "cvv": creditCard.cvv,
                    "expiry_date": creditCard.expiryDate,
                    "address1": creditCard.address,
                    "apt": creditCard.apt,
                    "countrycode": creditCard.countryCode,
                    "city": creditCard.city,
                    "stateprov": creditCard.state,
                    "postalcode": creditCard.postalCode,
                    "terms": "on",
                    "thankyou": "modalThankYou",
                    "order_conversion_id": OrderConversionId
                }
                
                switch (productId) {
                    case "15":
                        data['endpoint'] = '/affiliate/purchase/add-new-card-boomerang';
                        data['order_conversion_id'] = $('input[name="order_conversion_id"]').val();
                        break;

                    case "39":
                        data['endpoint'] =  '/affiliate/purchase/add-new-card-foundation';    
                        data['order_conversion_id'] = $('form#foundation #order_conversion_id').val(); 
                        
                        if ( $('form#foundation #amount').val().indexOf(".") > -1 ) {
                            data['amount'] = $('form#foundation #amount').val().replace(".", "");
                        }else{
                            data['amount'] = $('form#foundation #amount').val()+"00";
                        }
                                         
                        break;

                    case "add_new_card_subscription":
                        data['endpoint'] =  '/affiliate/subscription/add-new-card-subscription';
                        data['paymentMethod'] = $('form#subscription select#subscription_payment_method_type_id').val();
                        data['amount'] = $('form#subscription #subscription_amount').val();
                        data['thankyou'] = "modalSuscriptionAddNewCardThankYou";                                                                                 
                        break;

                    case "add_new_card_subscription_reactivate":
                        data['endpoint'] =  '/affiliate/subscription/add-new-card-subscription-reactivate';   
                        data['paymentMethod'] = $('form#frmReactivateSubscription select#selectPayment').val();
                        data['amount'] = $('form#frmReactivateSubscription #subscription_amount').val();   
                        data['order_conversion_id'] = $('form#frmReactivateSubscription #order_conversion_id').val();                       
                        data['thankyou'] = "modalSubscriptionReactivatedThankYou";  
                        break;

                    case "add-new-card-subscription-reactivate-suspended-user":
                        data['endpoint'] =  '/affiliate/subscription/add-new-card-subscription-reactivate-suspended-user';
                        data['subscription_payment_method_type_id'] = $('form#frmReactivateSuspendedSubscription select#subscription_payment_method_type_id').val();
                        data['amount'] = $('form#frmReactivateSuspendedSubscription #subscription_amount').val(); 
                        data['order_conversion_id'] = $('form#frmReactivateSuspendedSubscription #order_conversion_id').val();                       
                        data['thankyou'] = "modalSubscriptionReactivatedSuspendedThankYou";                        
                        break;                        
                            
                    case "56":
                        data['endpoint'] =  '/affiliate/purchase/generic-check-out-new-card';
                        break;

                    default:
                        data['endpoint'] =  '/affiliate/subscription/upgrade-package-check-out-new-card'; 
                        data['new_product_id'] = $('input[name="newProductId"]').val();
                        data['current_product_id'] = $('input[name="currentProductId"]').val();
                        data['upgrade_product_id'] = $('input[name="upgradeProductId"]').val();
                        data['payment_method_id'] = $('input[name="payment_method"]:checked').val();
                        data['order_conversion_id'] = $('form#upgradePack #order_conversion_id').val(); 
                       
                        break;
                }
                return data
            };

            const informations = getEndpointData();
            
            $.ajax({
                url: '{{ route('api-request') }}',
                method: 'POST',
                data: {
                    endpoint: informations['endpoint'],
                    method: 'POST',
                    data: informations
                },
                success: function (res) {
                    
                    if ( !res.data ){
                        var erro = res.error;
                        var msg = res.msg;
                        var userId = res.userId;
                        var orderId = res.orderId;
                    }else{
                        var erro = res.data.error;
                        var msg = res.data.msg;
                        var userId = res.data.userId;
                        var orderId = res.data.orderId;
                    }    
                    
                    if ( erro === 0 ) {

                        if ($('form#upgradePack #order_conversion_id').val().length > 0){

                            ajaxReq('/join/signup-world-series', 'POST', {
                                'user_id': userId,
                                'event_type': "upgrade",
                                'order_id': orderId
                            });
                            
                        }

                        $('#modalAddNewCard').modal('hide');

                        $('#modalThankYou').attr("data-backdrop", "static");
                        $('#modalThankYou').attr("data-keyboard", "false");
                        if (informations['thankyou'] != "modalThankYou" ){
                            $('#'+informations['thankyou']).modal('show');
                        }else{
                            $('#modalThankYou').modal('show');
                        }                        
                    }else {                        
                        if (informations['thankyou'] != "modalThankYou" ){
                            $('#'+informations['thankyou']+' #errorMessage').removeClass('d-none').text('').text(msg);
                        }else{
                            $('#modalAddNewCard #errorMessage').removeClass('d-none').html('').html(msg);
                        }
                    }
                    $.ladda( 'stopAll' );
                },
                error: function (err) {
                    console.log(err);
                    $.ladda( 'stopAll' );
                }
            });
        });
    </script>
@endpush
