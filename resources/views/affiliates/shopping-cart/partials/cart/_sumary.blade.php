<div class="ibox loading-state">
    <div class="ibox-title">
        <h5>Cart Summary</h5>
        <div class="ibox-tools">
            @include('components.affiliates.spinners.wave')
        </div>
    </div>

    <div class="ibox-content">
        <div class="sk-spinner sk-spinner-double-bounce">
            <div class="sk-double-bounce1"></div>
            <div class="sk-double-bounce2"></div>
        </div>
        <div class="row">
            <div class="col">
                <h2 class="font-bold">
                    SubTotal
                </h2>
            </div>
            <div class="col">
                <h2 class="font-bold">
                    <span id="subtotal">
                        $ {{ number_format($shopping_cart->total,2) }}
                    </span>
                </h2>
            </div>
        </div>
        <hr>
        
        <div class="row px-3"   id="discount" style="{{ $shopping_cart->discount > 0 ? '' : 'display:none;' }}">
            <div class="col">
                <h3 class="font-bold {{ $voucher_status ? '' : 'text-success' }}" style="color:red">Voucher</h3>
                <span class="small {{ $voucher_status ? '' : 'text-muted' }}" style="color:red" style=" {{ $voucher_status ? 'color:red' : '' }}" id="voucher-code">code: {{ $shopping_cart->discount > 0 ? $shopping_cart->voucher->code : '' }}</span>
                
            </div>
            <div class="col ">
                <h3 class="font-bold {{ $voucher_status ? '' : 'text-success' }}" style="color:red">
                    <span id="discount-amount">$ {{ number_format($shopping_cart->discount,2) ?? '0.00'}}</span>
                    <a href="" id="removeVoucher" data-voucher-id="{{ $shopping_cart->voucher_id }}" style="{{ $voucher_status ? 'color:red' : '' }}"><i class="fa fa-trash-o"></i></a>
                </h3>
            </div>
            <input type="hidden" id="voucher_status" value="{{ $voucher_status ? 0 : 1 }}" />
        </div>        

        <div class="row">
            <div class="col">
                <h2 class="font-bold">
                    Total
                </h2>
            </div>
            <div class="col text-nowrap">
                <h2 class="font-bold">
                    <span id="total">
                        $ {{ number_format($shopping_cart->subtotal,2) ?? '0,00' }}
                    </span>
                </h2>
            </div>
        </div>       
        <div id="applyVoucher" class="m-t-sm" style="{{ $shopping_cart->discount > 0 ? 'display:none' : '' }}">
            <div class="row px-3">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Voucher Code" id="txtVoucher">
                </div>
                <div class="form-group ml-auto">
                    <button class="btn btn-primary pull-right" id="btnVoucher">Apply Voucher</button>
                </div>
            </div>
        </div>        
    </div>
</div>
