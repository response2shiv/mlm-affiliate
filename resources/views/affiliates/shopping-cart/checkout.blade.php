@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="col-12">
        <h3>Select a Payment Method</h3>
        @include('components.affiliates.spinners.wave')
    </div>

    <div class="row paymentMethods ">
        @forelse ($payment_methods as $pm)
        @include('affiliates.shopping-cart.partials.checkout._credit-card')
        @empty

        @endforelse
    </div>

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('shopping-cart.my-cart') }}" class="btn btn-w-m btn-default">Back</a>
            <div class="inline">


                <a href="{{ route('shopping-cart.confirmation') }}" class="btn btn-w-m btn-primary {{ session('payment_selected') ? '' : 'd-none' }}" id="btnContinue">Continue</a>

            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{asset('js/ibuumerang/jquery.payment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/ibuumerang/shopping-cart/shopping_cart.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('.cc-number').formatCardNumber();
        $('.cc-expires').formatCardExpiry();
        $('.cc-cvc').formatCardCVC();
    });
</script>
@endpush

@push('modals')
@include('affiliates.partials.modals._add_new_card_shopping_cart')
@endpush