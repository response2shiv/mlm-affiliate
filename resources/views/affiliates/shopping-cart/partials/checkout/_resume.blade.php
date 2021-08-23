<div class="ibox loading-state">
    <div class="ibox-title">
        <h5>Cart Summary</h5>
        <div class="ibox-tools">
            @include('components.affiliates.spinners.wave')
        </div>
    </div>

    <div class="ibox-content">
        <div class="sk-spinner sk-spinner-double-bounce">
            <div class="sk-double-bounce1"></div>
            <div class="sk-double-bounce2"></div>
        </div>
        <div class="row px-3">
            <div class="col-6">
                <h2 class="font-bold">
                    SubTotal
                </h2>
            </div>
            <div class="col-6 mt-auto">
                <h2 class="font-bold">
                    <span id="subtotal">
                        $ {{ number_format($shopping_cart->total,2) }}
                    </span>
                </h2>
            </div>
        </div>

        {{-- @if($shopping_cart->discount > 0)
        <div class="row px-3" id="discount">
            <div class="col-6">
                <h3 class="font-bold text-success">
                    Discount
                </h3>
                <span class="text-muted small" id="voucher-code">

                </span>
            </div> --}}

        <hr>

        @if ($shopping_cart->voucher_id)
        <div class="row px-3" id="discount" style="{{ $shopping_cart->discount > 0 ? '' : 'display:none' }}">
            <div class="col">
                <h3 class="font-bold text-success">Voucher</h3>
                <span class="text-muted small" id="voucher-code">code: {{$shopping_cart->voucher->code }}</span>
            </div>
            <div class="col ">
                <h3 class="font-bold text-success">
                    <span id="discount-amount">$ {{ number_format($shopping_cart->discount,2) ?? '0.00'}}</span>
                </h3>
            </div>
        </div>
        @endif

        {{-- </div>
        @endif --}}

        <div class="row px-3">
            <div class="col-6">
                <h2 class="font-bold">
                    Total
                </h2>
            </div>
            <div class="col-6 mt-auto">
                <h2 class="font-bold">
                    <span id="total">
                        $ {{ number_format($shopping_cart->subtotal,2 ) ?? '0,00' }}
                    </span>
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="ibox loading-state">
    <div class="ibox-title">
        <h5>Payment Method</h5>
    </div>
    <div class="ibox-content">
        <div class="sk-spinner sk-spinner-double-bounce">
            <div class="sk-double-bounce1"></div>
            <div class="sk-double-bounce2"></div>
        </div>
        <div class="row">
            <div class="col-12">
                @if($payment_method == "ewallet")
                <p><span class="font-weight-bold">E-Wallet</span></p>
                @elseIf($payment_method == 'voucher')
                <p><span class="font-weight-bold">Voucher</span></p>
                @else
                <p><span class="font-weight-bold">Credit Card </span></p>
                <p>
                    Name: {{ $payment_user['first_name'] }} {{ $payment_user['last_name'] }}<br>
                    Number: {{ $payment_user['card_token'] }}<br>
                    Expiration: {{ $payment_user['expiration_month'] }}/{{ $payment_user['expiration_year'] }}<br>
                    CVV: {{ $payment_user['cvv'] }}
                </p>
                <p>
                    Address: {{ $payment_user['address']['address1'] }} {{ $payment_user['address']['address2'] }} <br>
                    {{ $payment_user['address']['city'] }} - {{ $payment_user['address']['state'] }} - {{ $payment_user['address']['country_code'] }}
                </p>
                @endif
            </div>
        </div>
    </div>
</div>