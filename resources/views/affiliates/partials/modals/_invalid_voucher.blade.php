@component('layouts.components.modal', ['id' => 'invalidVoucher'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="text-center">
        <h3 class="font-weight-bold mb-4">Invalid Voucher</h3>        
    </div>

    @slot('actions')
        <button id=btCloseInvalidVoucher class="btn btn-dark text-uppercase" data-dismiss="modal">Ok</button>        
    @endslot
@endcomponent

