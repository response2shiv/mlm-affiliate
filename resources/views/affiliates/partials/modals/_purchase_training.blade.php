@component('layouts.components.modal', ['id' => 'modalPurchaseTraining'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="text-center">
        <h3 class="font-weight-bold mb-4">Purchase Products</h3>

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

        <input type="hidden" data-product-id>
    </div>

    @slot('actions')
        <button class="btn btn-dark text-uppercase" data-dismiss="modal">Close</button>
        <!-- <input type="button" id="btnAddToCart" value="ADD TO CART" class="btn btn-yellow"> -->
        <button class="btn btn-yellow btnAddToCart" data-product="" data-modal="REDIRECT">ADD TO CART <i class="fa fa-shopping-cart"></i></button>
    @endslot
@endcomponent

@push('scripts')
<script>
    $('#btnAddToCart').on('click', function () {
        $('input[data-product-id]').val('56');
        $('#modalPurchaseTraining').modal('hide');
        $('#modalCheckout').modal('show');
        
        $("html,body").css({"overflow":"hidden"});
        $('#modalCheckout').css({"overflow":"auto"});
    });

    $('html,body').on('click', function () {        
        $("html,body").css({"overflow":"auto"});        
    });
</script>
@endpush
