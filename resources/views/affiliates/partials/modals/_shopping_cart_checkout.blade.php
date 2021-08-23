@push('styles')
<!-- Ladda style -->
<link href="{{ asset('css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
@endpush

@component('layouts.components.modal', ['id' => 'shoppingCartCheckout'])
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

        {{-- <input type="hidden" name="sourceView" value="">--}}
        {{-- <input type="hidden" name="newProductId" value="">--}}
        {{-- <input type="hidden" name="currentProductId" value="">--}}
        {{-- <input type="hidden" name="upgradeProductId" value="">--}}
        {{-- <input type="hidden" name="OrderConversion" value="">--}}

        {{-- <div class="form-group">--}}
        {{-- <label for="cupom" class="control-label">Do you have a coupon code?</label>--}}
        {{-- <form action="#" class="form-inline">--}}
        {{-- <input type="text" class="form-control" name="coupon" id="coupon">--}}
        {{-- <button style="margin-left : .5rem!important;" type="button" id="btnApplyCoupon" class="ladda-button btn btn-yellow" value="Apply" data-style="expand-right">--}}
        {{-- <span class="ladda-label">Apply</span>--}}
        {{-- <span class="ladda-spinner"></span>--}}
        {{-- <div class="ladda-progress" style="width: 0;"></div>--}}
        {{-- </button>--}}
        {{-- </form>--}}
        {{-- </div>--}}

        {{-- <span id="couponMessage" class="d-none"></span>--}}
    </div>
</div>
{{-- <div class="row">--}}
{{-- <div class="col-12 quick-checkout">--}}
{{-- <h3>Quick Checkout</h3>--}}

{{-- <div class="list-group" id="listPaymentMethods">--}}
{{-- <div class="list-group-item">--}}
{{-- <input type="radio" name="payment_method" value="0">--}}
{{-- Add New Card--}}
{{-- </div>--}}

{{-- @foreach ($dashboard['subscription']['creditCards'] as $creditCard)--}}
{{-- <div class="list-group-item">--}}
{{-- <input type="radio" name="payment_method" value="{{ $creditCard['id'] }}">--}}
{{-- {{ $creditCard['paymentMethodName'] }}--}}
{{-- </div>--}}
{{-- @endforeach--}}
{{-- </div>--}}
{{-- </div>--}}

{{-- <div class="row">--}}
{{-- <form action="{{ route('shopping-cart.add') }}" class="form" style="display: none" id="checkoutForm" method="POST">--}}
{{-- @csrf--}}
{{-- <input type="hidden" name="product_cart_id" value="" id="product_cart_id">--}}
{{-- <input type="hidden" name="quantity" value="1">--}}
{{-- </form>--}}
{{-- </div>--}}
{{-- <input type="hidden" id="order_conversion_id" name="order_conversion_id" value="">--}}
{{-- </div>--}}
{{-- <br/>--}}
{{-- <form action="#" class="form-inline">--}}
{{-- <div class="row col-12">--}}
{{-- <label for="cupom" class="control-label">Do you have a coupon code?</label>--}}

{{-- </div>--}}
{{-- <div class="row col-12">--}}
{{-- <input type="text"  style="max-width: 76%;" class="form-control" name="coupon" id="coupon">--}}
{{-- <button type="button" id="btnApplyCoupon" style="margin-left : .5rem!important;" class="ladda-button btn btn-yellow" value="Apply" data-style="expand-right">--}}
{{-- <span class="ladda-label">Apply</span>--}}
{{-- <span class="ladda-spinner"></span>--}}
{{-- <div class="ladda-progress" style="width: 0;"></div>--}}
{{-- </button>--}}
{{-- </div>--}}
{{-- </form>--}}
{{-- <span id="couponMessage" class="d-none"></span>--}}

@slot('actions')
<button id="btnSubmitCheckout" class="ladda-button btn btn-yellow" data-style="expand-right">
    <span class="ladda-label">Submit</span>
    <span class="ladda-spinner"></span>
    <div class="ladda-progress" style="width: 0;"></div>
</button>
@endslot
@endcomponent

@prepend('scripts')
<!-- Ladda -->
<script src="{{ asset('js/plugins/ladda/spin.min.js') }}"></script>
<script src="{{ asset('js/plugins/ladda/ladda.min.js') }}"></script>
<script src="{{ asset('js/plugins/ladda/ladda.jquery.min.js') }}"></script>

<script>
    // Bind normal buttons
    Ladda.bind('.ladda-button', {
        timeout: 5500
    });

    $(document).ready(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
    });


    $('#btnSubmitCheckout').on('click', function(event) {

        alert("add to cart");
        return;
        var endpoint;
        var postData;
        var activeModal;

        if (newCreditCard === undefined || newCreditCard === null) {
            endpoint = '/affiliate/shopping-cart/checkout'
            postData = {
                payment_method_id: paymentMethodId
            };
            activeModal = 'checkout'
        } else {
            endpoint = '/affiliate/shopping-cart/checkout-new-card'
            postData = newCreditCard
            activeModal = 'newCreditCard'
        }

        $.ajax({
            url: '{{ route('
            api - request ') }}',
            method: 'POST',
            dataType: "json",
            data: {
                endpoint: endpoint,
                method: 'POST',
                data: postData
            },
            success: function(res) {
                console.log(res)
                if (!res.data) {
                    var erro = res.error;
                    var msg = res.msg;

                } else {
                    var erro = res.data.error;
                    var msg = res.data.msg;
                }

                if (erro === 0) {

                    $('#modalAddNewCardShoppingCart').modal('hide')
                    $('#shoppingCartCheckout').modal('hide')
                    window.open("/shopping-cart/confirmation")

                } else {

                    if (activeModal == 'newCreditCard') {
                        $('#shoppingCartCheckout').modal('hide')
                        $('#modalAddNewCardShoppingCart').modal()
                        $('#modalAddNewCardShoppingCart #errorMessage').removeClass('d-none').html('').html(msg);

                    } else {
                        $('#shoppingCartCheckout #errorMessage').removeClass('d-none').html('').html(msg);
                    }

                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    });


    $('#btnApplyCoupon').on('click', function(event) {
        event.preventDefault();

        var productId = $('input[name="upgradeProductId"]').val();

        if (productId === '') {
            productId = $('input[data-product-id]').val();
        }

        $.ajax({
            url: '{{ route('
            api - request ') }}',
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
            success: function(res) {
                if (res.error === 0) {
                    $('span#couponMessage').removeClass('d-none').addClass('text-success').text(res.msg);
                    $('#tableOrderDetails tfoot #totalPrice p[data-product-price]').text("$" + res.details.total + " USD / " + res.details.total_display);
                    $('input[name="order_conversion_id"]').val(res.details.order_conversion_id);
                    $('input[name="OrderConversion"]').val(res.details.order_conversion_id);
                } else {
                    $('span#couponMessage').removeClass('d-none').addClass('text-danger').text(res.msg);
                }
            }
        });
    });

    /**
     * Shows the error message.
     *
     * @param message
     */
    const showErrorMessage = function(message) {
        $('#modalCheckout #errorMessage').removeClass('d-none');
        $('#modalCheckout #errorMessage .alert').text(message);
    };

    /**
     * Closes the error message when it's displaying.
     */
    const removeErrorMessage = function() {
        $('#modalCheckout #errorMessage').addClass('d-none');
    };
</script>
@endprepend