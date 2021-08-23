@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-9">
            <form action="{{ route('shopping-cart.update-cart') }}" id="update-cart" method="post">
                @csrf
                
                    @include('affiliates.shopping-cart.partials.cart._cart-list')
                
            </form>
        </div>

        <div class="col-md-3">
            @include('affiliates.shopping-cart.partials.cart._sumary')

            @if ($has_shipping)
                @include('affiliates.shopping-cart.partials.cart._shipping_address')
            @endif

            @include('affiliates.shopping-cart.partials.cart._support')

        </div>
    </div>
</div>
@endsection

@push('modals')
    @include('affiliates.partials.modals._add_shipping_address')
    @include('affiliates.partials.modals._invalid_voucher')
@endpush

@push('scripts')
    <script src="{{asset('js/ibuumerang/shipping-address/shipping_address.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/ibuumerang/shopping-cart/shopping_cart.js')}}" type="text/javascript"></script>
@endpush
