<div class="col-md-4 ">
    <div class="payment-card {{ $pm->name == session('payment_selected') ? 'border-primary' : '' }}" id="{{ $pm->name }}" style="height: 270px">
        <div class="d-flex align-items-start justify-content-between">
            <div>
                @if($pm->name == "ewallet")
                <i class="fa fa-money payment-icon-big {{$pm->name == session('payment_selected') ? 'text-success' : '' }}"></i>
                @else
                <i class="fa fa-credit-card payment-icon-big {{$pm->name == session('payment_selected') ? 'text-success' : '' }}"></i>
                @endif
            </div>
        </div>

        <h2>
            {{ $pm->label }}
        </h2>

        @if($pm->name == "ewallet")
        <div class="row align-items-baseline">
            <div class="col-sm-6">
                <h2>
                    <strong> Balance: ${{ number_format(Auth::user()->estimated_balance,2) ?? 0 }}</strong>
                </h2>
                @if($pm->name != session('payment_selected'))
                <button class="btn btn-xs btn-primary paymentMethod" data-id="{{$pm->name}}">
                    Use this method
                </button>
                @else
                <button class="btn btn-xs btn-primary paymentMethod" disabled="disabled" data-id="{{$pm->name}}">
                    Selected <i class="fa fa-check"></i>
                </button>
                @endif
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-sm-12">

                @if (!$allow_creditCard && $pm->name != 'ipaytotal')
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-danger" style="font-weight: 300">${{number_format($limit_unicrypt,2) }} minimum for credit card purchases</h3>
                    </div>
                </div>
                @endif
                <div class="row">
                    @if ($pm->name != session('payment_selected') && $allow_creditCard && $pm->name != 'ipaytotal')
                    <div class="col-12">
                        <a href="#" class="btn btn-xs btn-primary paymentMethod pull-right" data-id="{{$pm->name}}">
                            Use this method
                        </a>
                    </div>
                    @endif

                    @if ($pm->name == 'ipaytotal')
                    <div class="col-row">
                        <div id="creditCards" hidden>
                            <form action="{{ route('shopping-cart.confirmation') }}" id="choose_cc_payment" method="POST">
                                <input type="hidden" name="payment_method" value="ipaytotal">
                                @csrf
                                <div class="col-12">
                                    <select class="form-control" name="payment_method_id" id="payment_method_id">
                                        <option value="">Choose card</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <input class="form-control mt-1" type="text" name="cvv" data-mask="999" placeholder="CVV" id="credit_card_cvv" required>
                                </div>

                                <button class="btn btn-xs btn-primary pull-left mt-2 ml-3" id="btnChooseCard">Use this card</a>
                            </form>
                        </div>
                        <div class="col-12" id="creditCardmsg">
                           {{-- Message Waiting and No Credit Card found. --}}
                        </div>
                        <button class="btn btn-xs btn-warning pull-right mt-2" id="btnAddAddNewCard">Add new card</button>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        @endif
    </div>
</div>