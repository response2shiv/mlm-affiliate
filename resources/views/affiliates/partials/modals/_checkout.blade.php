@push('styles')
    <!-- Ladda style -->
    <link href="{{ asset('css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
@endpush

@component('layouts.components.modal', ['id' => 'modalCheckout'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="row text-center">
        <div class="col-12 d-none" id="errorMessage">
            <div class="alert alert-danger"></div>
        </div>
        <div class="col-12">
            <h3>Order Details</h3>

            <table class="table" id="tableOrderDetails">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <p data-product-desc></p>
                        </td>
                        <td>
                            <p data-product-price></p>
                        </td>
                        <td>1</td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <td>Sub Total</td>
                        <td>
                            <p data-product-price></p>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Total</td>
                        <td id="totalPrice">
                            <p data-product-price></p>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>           
        </div>
    </div>    

    @slot('actions')
        <!-- <button id="btnSubmitCheckout" class="ladda-button btn btn-yellow" data-style="expand-right">
            <span class="ladda-label">Submit</span>
            <span class="ladda-spinner"></span>
            <div class="ladda-progress" style="width: 0;"></div>
        </button> -->
        <button class="btn btn-dark text-uppercase" data-dismiss="modal">Close</button>
        <button class="btn btn-yellow btnAddToCart" data-product="" data-modal="REDIRECT">ADD TO CART <i class="fa fa-shopping-cart"></i></button>
    @endslot
@endcomponent

@prepend('scripts')
    <!-- Ladda -->
    <script src="{{ asset('js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.jquery.min.js') }}"></script>

    <script>
        // Bind normal buttons
        Ladda.bind( '.ladda-button' );
        $( '#btnApplyCoupon' ).ladda();

        $(document).ready(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };

        });

        $(function() {
            /**
             * Returns the endpoint for the checkout based on the productId.
             *
             * @param productId
             * @returns {string}
             */
            const getEndpoint = function (productId) {
                switch (productId) {
                    case "15":
                        return '/affiliate/purchase/boomerangs';
                        break;

                    case "56":
                        return '/affiliate/purchase/generic-check-out';
                        break;

                    default:
                        return '/affiliate/subscription/upgrade-now';
                        break;
                }
            };

            $('#btnSubmitCheckout').on('click', function (event) {
                event.preventDefault();
                
                removeErrorMessage();
                $( this ).ladda();

                let paymentMethod = $('input[name="payment_method"]:checked').val();
                let couponCode = $('input#coupon').val();
                let productId = $('input[data-product-id]').val();
                let OrderConversion = $('input[name=OrderConversion]').val();
                let endpoint = getEndpoint(productId);
                let modalCheckout = $('#modalCheckout');

                if (paymentMethod === "0") {
                    modalCheckout.modal('hide');
                    $('#modalAddNewCard').modal('show');
                } else {
                    switch (productId) {
                        case "15":
                            requestBuumerangCheckout(productId, paymentMethod, couponCode, endpoint);
                            break;

                        case "56":
                            requestTrainingCheckout(productId, paymentMethod, couponCode, endpoint, OrderConversion);
                            break;

                        default:
                            requestCheckout(productId, paymentMethod, couponCode, endpoint);
                            break;
                    }
                }
            });

            /**
             * Request Training Checkout.
             *
             * @param {string} productId
             * @param {string} paymentMethod
             * @param {string} couponCode
             * @param endpoint
             */
            const requestTrainingCheckout = function (productId, paymentMethod, couponCode, endpoint, OrderConversion) {
                $( '#btnSubmitCheckout' ).ladda( 'start' );
                $.ajax({
                    url: '{{ route('api-request') }}',
                    method: 'POST',
                    data: {
                        endpoint: endpoint,
                        method: 'POST',
                        data: {
                            "product_id": productId,
                            "quantity": 1,
                            "payment_method_id": paymentMethod,
                            "discount_code": couponCode,
                            "order_conversion_id": OrderConversion
                        }
                    },
                    success: function (res) {
                        if (res.error === 1) {
                            toastr.error(res.msg, "Notification");
                        } else {
                            $('#modalCheckout').modal('hide');
                            $('#modalTrainingThankYou').modal('show');
                        }
                        $( '#btnSubmitCheckout' ).ladda( 'stop' );
                    },
                    error: function (err) {
                        console.log(err);
                        $( '#btnSubmitCheckout' ).ladda( 'stop' );
                    }
                });

            };

            /**
             * Request Checkout.
             *
             * @param productId
             * @param paymentMethod
             * @param couponCode
             * @param endpoint
             */
            const requestCheckout = function (productId, paymentMethod, couponCode, endpoint) {
                let newProductId = $('input[name="newProductId"]').val();
                let currentProductId = $('input[name="currentProductId"]').val();
                let upgradeProductId = $('input[name="upgradeProductId"]').val();
                let orderConversion = $('form#upgradePack #order_conversion_id').val();
                $( '#btnSubmitCheckout' ).ladda( 'start' );
                $.ajax({
                    url: '{{ route('api-request') }}',
                    method: 'POST',
                    data: {
                        endpoint: endpoint,
                        method: 'POST',
                        data: {
                            "product_id": productId,
                            "amount": 1,
                            "discount_code": couponCode,
                            "payment_method_id": paymentMethod,
                            "new_product_id": newProductId,
                            "current_product_id": currentProductId,
                            "upgrade_product_id": upgradeProductId,
                            "order_conversion_id": orderConversion
                        }
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

                        if (res.error === 0) {

                            ajaxReq('/join/signup-world-series', 'POST', {
                                'user_id': userId,
                                'event_type': "upgrade",
                                'order_id': orderId
                            });

                            $('#modalCheckout').modal('hide');
                            $('#modalUpgradeThankYou').modal('show');

                        } else {
                            showErrorMessage(msg);
                        }
                        $( '#btnSubmitCheckout' ).ladda( 'stop' );
                    },
                    error: function (err) {
                        console.log(err);
                        $( '#btnSubmitCheckout' ).ladda( 'stop' );
                    }
                });
            };

            /**
             * Request Buumerang Checkout.
             *
             * @param productId
             * @param paymentMethod
             * @param couponCode
             * @param endpoint
             */
            const requestBuumerangCheckout = function (productId, paymentMethod, couponCode, endpoint) {
                $( '#btnSubmitCheckout' ).ladda( 'start' );
                $.ajax({
                    url: '{{ route('api-request') }}',
                    method: 'POST',
                    data: {
                        endpoint: endpoint,
                        method: 'POST',
                        data: {
                            "product_id": productId,
                            "quantity": 1,
                            "discount_code": couponCode,
                            "payment_method_id": paymentMethod,
                            "order_conversion_id": $('input[name="order_conversion_id"]').val()
                        }
                    },
                    success: function (res) {
                        if (res.error === 0) {
                            $('#modalCheckout').modal('hide');
                            $('#modalThankYou').modal('show');
                        } else {
                            showErrorMessage(res.msg);
                        }
                        $( '#btnSubmitCheckout' ).ladda( 'stop' );
                    },
                    error: function (err) {
                        console.log(err);
                        $( '#btnSubmitCheckout' ).ladda( 'stop' );
                    }
                });

            }
        });

        $('#btnApplyCoupon').on('click', function (event) {
            event.preventDefault();

            var productId = $('input[name="upgradeProductId"]').val();

            if (productId === '') {
                productId = $('input[data-product-id]').val();
            }
            $( this ).ladda( 'start' );
            $.ajax({
                url: '{{ route('api-request') }}',
                method: 'POST',
                data: {
                    endpoint: '/affiliate/purchase/check-coupon',
                    method: 'POST',
                    data: {
                        'product_id': productId,
                        'discount_code': $('#coupon').val(),
                        'country': $('input[name="country_code"]').val(),
                        'locale': navigator.language.replace("-", "_"),
                    }
                },
                success: function (res) {
                    if (res.error === 0) {
                        $('span#couponMessage').removeClass('d-none').addClass('text-success').text(res.msg);
                        $('#tableOrderDetails tfoot #totalPrice p[data-product-price]').text("$"+res.details.total+" USD / "+res.details.total_display);
                        $('input[name="order_conversion_id"]').val(res.details.order_conversion_id);
                        $('input[name="OrderConversion"]').val(res.details.order_conversion_id);
                    } else {
                        $('span#couponMessage').removeClass('d-none').addClass('text-danger').text(res.msg);
                    }
                    $( '#btnApplyCoupon' ).ladda( 'stop' );
                },
                error: function (err) {
                    console.log(err);
                    $( '#btnApplyCoupon' ).ladda( 'stop' );
                }
            });
        });

        /**
         * Shows the error message.
         *
         * @param message
         */
        const showErrorMessage = function (message) {
            $('#modalCheckout #errorMessage').removeClass('d-none');
            $('#modalCheckout #errorMessage .alert').text(message);
        };

        /**
         * Closes the error message when it's displaying.
         */
        const removeErrorMessage = function () {
            $('#modalCheckout #errorMessage').addClass('d-none');
        };
    </script>
@endprepend

@push('modals')
    @include('affiliates.partials.modals._add_new_card')
    @include('affiliates.partials.modals._thank_you')
    @include('affiliates.partials.modals._upgrade_thank_you')
@endpush
