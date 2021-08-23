<div class="ibox loading-state">
    <div class="ibox-title">       
        <span id="numberItens" class="float-right">(<strong>{{ count($shopping_cart->items) }}</strong>) items</span> <h5>Items in your cart</h5>
    </div>
    <div class="ibox-content">

        <div class="sk-spinner sk-spinner-double-bounce">
            <div class="sk-double-bounce1"></div>
            <div class="sk-double-bounce2"></div>
        </div>

        @forelse ($shopping_cart->items as $product)
            @include('affiliates.shopping-cart.partials.cart._cart-item')
        @empty
        <p>Empty Cart</p>
        @endforelse
            @if(empty($stop_cart_message))
                @include('affiliates.shopping-cart.partials.cart._cart-button')
            @else
                @include('affiliates.shopping-cart.partials.cart._cart-button-stop')
            @endif
           
    </div>
</div>
