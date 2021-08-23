@extends('affiliates.profile.index')


@section('title','Shipping Address')

@section('child')
    <div class="row">
        <div class="col-12 mb-3">
            <button class="btn btn-success" id="btnAddAddShippingAddress">Add New</button>
        </div>
        @foreach ($shipping_addresses as $shipping_address)
            <div class="col-12 col-xl-6 mb-3">
            <div class="card">
            @if($shipping_address->primary != 1)
                <div class="bg-light card-header">
                    <button class="btn btn-xs btn-primary pull-right btnSetPrimaryShippingAddress" id="{{$shipping_address->id}}">
                        Use this address as a primary
                    </button>
                </div>
            @else
                <div class="bg-success card-header">
                    <button class="btn btn-xs btn-light pull-right" disabled="disabled">
                        Primary <i class="fa fa-check"></i>
                    </button>
                </div>
            @endif
                <div class="card-body">
                    <p class="card-text"><strong>Address:</strong> {{ $shipping_address->address1 }}</p>
                    <p class="card-text"><strong>Apt/Suite:</strong> {{ $shipping_address->apt }}</p>
                    <p class="card-text"><strong>City:</strong> {{ $shipping_address->city }}</p>
                    <p class="card-text"><strong>State/Province:</strong> {{ $shipping_address->stateprov }}</p>
                    <p class="card-text"><strong>Postal Code:</strong> {{ $shipping_address->postalcode }}</p>
                    <p class="card-text"><strong>Country:</strong> {{ $shipping_address->countrycode }}</p>
                        
                        
                    <button class="btn btn-warning card-link btnEditShippingAddess" id="{{$shipping_address->id}}">Edit</button>
                    <button class="btn btn-danger card-link btnDeleteShippingAddress" id="{{$shipping_address->id}}">Delete</button>
                </div>
            </div>
            </div>        
        @endforeach
    </div>
@endsection

@push('modals')
    @include('affiliates.partials.modals._add_shipping_address')
    @include('affiliates.partials.modals._alert')
@endpush

@push('scripts')
    <script src="{{asset('js/ibuumerang/shipping-address/shipping_address.js')}}" type="text/javascript"></script>
@endpush