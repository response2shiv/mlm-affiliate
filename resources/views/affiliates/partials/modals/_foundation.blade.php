@component('layouts.components.modal', [
    'id' => 'modalFoundation',
    'header' => [
        'image' => asset('assets/images/ibuum-foundation-logo.png'),
        'width' => '150px'
    ],
    'modal_size' => 'modal-sm'
    ])
    <div class="row">
        <div class="col-12">
            <p>Choose the amount you would like to donate to the büüm Foundation </p>
        </div>

        <div class="alert alert-danger d-none" id="errorMessage"></div>

        <form action="{{ route('api-request')}} }}" id="foundation">
            <div id="amount_div" class="form-group">
                <label for="amount" class="control-label">Amount USD</label>
                <input type="text" class="form-control" id="amount" name="amount" />
                <!-- <label id="amount_convert" class="control-label"></label> -->
            </div>

            <!-- <div class="form-group">
                <label for="payment_method" class="control-label">Payment Method</label>
                <select class="form-control" name="payment_method" id="payment_method">
                    <option value="">Select Payment Method</option>
                    @if (env('DISABLE_BILLING', false) === false)
                        <option value="0">Add New Card</option>
                    @endif
                     @foreach ($dashboard['subscription']['creditCards'] as $creditCard)
                        <option value="{{ $creditCard['id'] }}">{{ $creditCard['paymentMethodName'] }}</option>
                    @endforeach
                </select>
            </div> -->
            <input type="hidden" id="order_conversion_id" name="order_conversion_id" value="">
            <input type="hidden" name="country_code" value="{{Auth::user()->getConversionCountry()}}">
        </form>
    </div>

    @slot('actions')
        <button class="btn btn-dark" id="btnCloseFoundationModal">Close</button>
        <!-- <button class="btn btn-yellow" id="btnSubmitFoundation">Submit</button> -->
        <button class="btn btn-yellow btnAddToCart" data-product="39" data-modal="REDIRECT">ADD TO CART <i class="fa fa-shopping-cart"></i></button>
    @endslot
@endcomponent
