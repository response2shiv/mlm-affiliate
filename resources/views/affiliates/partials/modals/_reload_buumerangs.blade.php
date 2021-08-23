@component('layouts.components.modal', ['id' => 'modalReloadBuumerangs'])
@slot('title')
<div class="text-center">
    <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
</div>
@endslot

<div class="text-center">
    <h3 class="font-weight-bold mb-4">Purchase Products</h3>
    <p>Ncrase come in packs of <span id="productName"></span>.</p>

    <div class="row">
        <div class="col-8 offset-2">
            <table class="table-products table text-white">
                <thead>
                    <tr>
                        <th>PRODUCT</th>
                        <th>PRICE</th>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <form action="{{ route('shopping-cart.add') }}" class="form" style="display: none" id="checkoutForm" method="POST">
            @csrf
            <input type="hidden" name="product_cart_id" value="" id="product_cart_id">
            <input type="hidden" name="quantity" value="1">
        </form>
    </div>

    <input type="hidden" name="country_code" value="{{Auth::user()->country_code}}">
</div>

@slot('actions')
<button class="btn btn-dark text-uppercase" data-dismiss="modal">Close</button>
<button class="btn btn-yellow btnAddToCart" data-product="" data-modal="">ADD TO CART <i class="fa fa-shopping-cart"></i></button>
@endslot
@endcomponent

@push('scripts')
<script>
    // $('#btnAddToCart').on('click', function() {
    //     alert('to cart');
    //     return;
    //     var form = document.getElementById('checkoutForm')

    //     form.submit();
    //     //$('#modalReloadBuumerangs').modal('hide');
    //     //$('#modalCheckout').modal('show');
    // });
</script>
@endpush