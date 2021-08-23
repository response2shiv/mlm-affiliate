@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            @include('affiliates.shopping-cart.partials.cart._cart-list')
        </div>
        <div class="col-md-3 col-sm-12">
            @include('affiliates.shopping-cart.partials.checkout._resume')

            @if ($has_shipping)
            @include('affiliates.shopping-cart.partials.cart._shipping_address')
            @endif
        </div>

    </div>
</div>
@endsection

@push('modals')
@include('affiliates.partials.modals._add_shipping_address')
@include('affiliates.partials.modals._waiting_payment')
@endpush

@push('scripts')
<script src="{{asset('js/ibuumerang/shipping-address/shipping_address.js')}}" type="text/javascript"></script>
<script src="{{asset('js/ibuumerang/shopping-cart/shopping_cart.js')}}" type="text/javascript"></script>
@endpush