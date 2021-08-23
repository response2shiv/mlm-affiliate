<div id="shippingAddress" class="ibox loading-state">
    <div class="ibox-title">
        <h5>Shipping Address </h5>
        @if(session()->has('is_gift') && session()->get('is_gift')==1) <i class="fa fa-gift fa-2x"></i> @endif
    </div>

    <div class="ibox-content">
        <div class="sk-spinner sk-spinner-double-bounce">
            <div class="sk-double-bounce1"></div>
            <div class="sk-double-bounce2"></div>
        </div>
        @if(!Request::segment(2)=='confirmation')
        <select id="SelShippingAddress" class="form-control">
            <option value="">Choose an options</option>
            @foreach($addresses as $add)
            <option value="{{$add->id}}" {{$shipping_address->id == $add->id ? 'selected' : '' }}>{{ $add->address1  }}</option>
            @endforeach
        </select>
        @endif

        @if($shipping_address)
        <div class="row">
            <div class="col">
                <span class="small">Address: </span>
            </div>
            <div class="col">
                <span class="small" id="text_address1">{{ $shipping_address->address1 ?? '' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span class="small">Apt/Suite: </span>
            </div>
            <div class="col">
                <span class="small" id="text_apt">{{$shipping_address->apt ?? ''}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span class="small">City: </span>
            </div>
            <div class="col">
                <span class="small" id="text_city">{{$shipping_address->city ?? ''}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span class="small">State: </span>
            </div>
            <div class="col">
                <span class="small" id="text_stateprov">{{$shipping_address->stateprov ?? ''}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span class="small"> Postal Code:</span>
            </div>
            <div class="col">
                <span class="small" id="text_postalcode">{{$shipping_address->postalcode ?? ''}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span class="small">Country: </span>
            </div>
            <div class="col">
                <span class="small" id="text_countrycode">{{$shipping_address->countrycode ?? ''}}</span>
            </div>
        </div>
        @if(!Request::segment(2)=='confirmation')
        <div class="text-center">
            <button class="btn btn-secondary mt-2" id="btnAddAddShippingAddress">Add Address</button>
        </div>
        <div class="text-center">
            <h3 class="list-group-item-heading text-success">Send as gift
                <input type="checkbox" name="gift_box" id="gift_box" valeu="1" @if(session()->has('is_gift') && session()->get('is_gift')==1) checked @endif>
            </h3>
        </div>
        @endif
        @else
        <div class="row text-center">
            <button class="btn btn-secondary" id="btnAddAddShippingAddress">Add Address</button>
        </div>
        <div class="row text-center">
            <span class="small text-danger">
                Shipping address is required
            </span>
        </div>
        @endif

    </div>
</div>