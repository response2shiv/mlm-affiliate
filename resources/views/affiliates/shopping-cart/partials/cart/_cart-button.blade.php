
 <div class="d-flex justify-content-between bd-highlight mb-3">
    @if(!Request::segment(2)=='confirmation')
        <div>
            <a href="{{ route('affiliates.dashboard.index') }}" class="btn btn-sm btn-white"><i
                    class="fa fa-arrow-left"></i> Back to Dashboard</a>
        </div>
        @if( count($shopping_cart->items) > 0 )
            <div class="ml-auto" id="updateCart">
            <button class="btn-sm btn btn-light updateCart mr-1 mf-1"><i class="fa  fa-refresh"></i> Update Cart</button>
                <a href="{{ route('shopping-cart.checkout') }}" class="btn btn-sm btn-primary  mr-1 mf-1">
                    <i class="fa fa fa-shopping-cart"></i> Continue
                </a>
            </div>
        @endif
    @else
        @if($shopping_cart->subtotal>0)
            <a href="{{ route('shopping-cart.checkout') }}" class="btn btn-white">
                <i class="fa fa-arrow-left"></i> Back to Payment Methods
            </a>
        @else
            <a href="{{ route('shopping-cart.my-cart') }}" class="btn btn-sm btn-white"><i
                class="fa fa-arrow-left"></i> Back to your cart</a>    
        @endif
        <a href="#" class="btn btn-primary pull-right" id="checkout">
            <i class="fa fa fa-check"></i> Confirm Payment
        </a>
    @endif
</div>