<div class="row">
    <div class="col-md-6 col-lg-6 col-sm-12 align-content-center">
        <div class="col-sm-12 text-center">
            @if($response->error_address == true)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    We don't have your country in the Primary Address section of your profile. Please update your info to proceed.
                </div>
            @endif
        </div>
        <div class="col-sm-12 text-center">
            <div id="divBalance">
                <span>${{number_format($response->balance, 2)}}</span>
            </div>
            <div class="mt-5">
                @if($response->payout_type == 'ipayout')
                    <a href="{{env('EWALLET_MERCHANT_URL')}}" target="_blank"
                       class="btn btn-primary rounded-pill" id="checkIpayoutUser">Launch
                        iPayout Account</a>
                @endif
                
                @if($response->payout_type == 'payquiker')
                    {{--  <a href="{{env('EWALLET_MERCHANT_URL')}}" target="_blank"
                       class="btn btn-primary rounded-pill" id="checkIpayoutUser">Launch
                        PayQuiker Account</a>  --}}
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-sm-12 align-content-center">
        <div class="col-sm-12 text-center">
            @if($response->error_address != true)
                <div id="divTransferAm">
                    <div>Enter Amount to Transfer</div>
                    <input type="text" id="transferAmt" class="form-control"/>
                    <div>A ${{number_format($response->fee, 2)}} service fee will apply<br/>to all transfers</div>
                </div>
                <div class="mt-3">

                    @if($response->is_rank_running)
                        <div class="alert alert-warning">Ewallet is currently unavailable. Please try again in a few minutes.</div>
                    @else
                        @if($response->payout_type == 'payquicker')
                            <button id="openModalSendType"
                                    class="btn btn-primary rounded-pill"
                                    >
                                Transfer
                            </button> 
                        @elseif($response->payout_type =='ipayout')
                            <button 
                                    class="btn btn-primary rounded-pill"
                                    id="openModalSendType">
                                Transfer
                            </button>
                        @endif
                    @endif                    
                </div>
            @endif
        </div>
    </div>
</div>
