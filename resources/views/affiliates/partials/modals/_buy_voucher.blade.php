@push('styles')
    <!-- Ladda style -->
    <link href="{{ asset('css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
@endpush

@component('layouts.components.modal', ['id' => 'modalBuyVoucher'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="text-center">
        <h3 class="font-weight-bold">Add new discount coupon</h3>
        
        <div class="row">
            <div class="col-6 offset-3">
                <div class="form-group">
                    <label for="discount_code" class="control-label text-uppercase font-weight-bold">Code <span class="req">*</span></label>
                    <input type="text" name="discount_code" class="form-control modal-voucher" id="discount_code"/>
                </div>
            </div>

            <div class="col-6 offset-3">
                <div class="form-group">
                    <label for="product_id" class="control-label text-uppercase font-weight-bold">Discount Amount <span class="req">*</span></label>
                    <select name="product_id" class="form-control m-b modal-voucher" id="product_id">

                    </select>
                </div>
            </div>
        </div>
    </div>

    @slot('actions')
        <button id="btnSubmitVoucher" class="ladda-button btn btn-yellow" data-style="expand-right">
            <span class="ladda-label">SAVE</span>
            <span class="ladda-spinner"></span>
            <div class="ladda-progress" style="width: 0px;"></div>  
        </button>
    @endslot
@endcomponent

@push('scripts')
    <!-- Ladda -->
    <script src="{{ asset('js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.jquery.min.js') }}"></script>

    <script>
        // Bind normal buttons
        $( '#btnSubmitVoucher' ).ladda();         

        $(document).ready(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };

            $("#btnVoucher").on('click', function() {                
                $.ajax({
                    url: '{{ route('api-request') }}',
                    method: 'POST',
                    data: {
                        endpoint: '/affiliate/purchase/add-new-discount-code',
                        method: 'GET'
                    },
                    success: function (res) {
                        $("#discount_code").val(res.response.code);

                        let productsOption = '<option value="">Select Product</option>';
                        $.each(res.response.prepaid_products, function(i, product){
                            productsOption += '<option value="'+product.id+'">'+product.productdesc+'</option>'
                        });
                        $("#product_id").html(productsOption);                       
                    }
                });
            });

            $("#btnSubmitVoucher").on('click', function() {
                let product_id = $("#product_id").val();
                let discount_code = $("#discount_code").val();
                $( this ).ladda( 'start' );
                $.ajax({
                    url: '{{ route('api-request') }}',
                    method: 'POST',
                    data: {
                        endpoint: '/affiliate/purchase/create-discount-code',
                        method: 'POST',
                        data: {
                            product_id: product_id,
                            discount_code: discount_code
                        }
                    },
                    success: function (res) {
                        if(res.error==1){
                            toastr.error(res.msg, "Notification");
                        }else{
                            toastr.success(res.msg, "Notification");
                        }
                        $( '#btnSubmitVoucher' ).ladda( 'stop' );
                    }
                });
            }) 
        });
    </script>
@endpush
