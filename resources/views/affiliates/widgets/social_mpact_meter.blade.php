<div class="ibox float-e-margins">
    <div class="ibox-title widget-rounded-border-top border-bottom">
        <div class="ibumm-widget-title">Social Mpact Meter</div>
    </div>
    <div class="ibox-content widget-rounded-border-bottom dashboard_block">
        <div class="row">
             <span class="hover-image">
                <img src="{{ asset('images/Social_Mpact_Meter.png') }}" width="100%" />
                <span class="text">Coming soon</span>
            </span>
            {{-- <div class="col-md-4 col-sm-12">
                <div class="ibumm-widget-title-small">STATUS</div>
                <div class="battery-icon widget-align-center battery-size-{{ $dashboard['business_snapshot']['is_active'] ? '100' : \App\Models\User::getPV() }}"></div>
                <div class="ibumm-battery-status">{{ $dashboard['business_snapshot']['is_active'] ? 'ACTIVE' : 'INACTIVE' }}</div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="ibumm-widget-title-small mobile-padding-top">ACTIVITY</div>
                <div class="row">
                    <div class="col-6">
                        <div class="ibumm-battery-status">Binary Qualified</div>
                        <div class="dashboard_1_2_context_1_center">
                            <div class="dashboard_1_2_context_1_center_1">
                                <p class="font-left-right">L</p>
                                @if ($dashboard['business_snapshot']['binary_qualified']['left'] > 0)
                                    <span class="glyphicon glyphicon-ok check-icon"></span>
                                @else
                                    <span class="glyphicon glyphicon-remove cancel-icon"></span>
                                @endif
                            </div>
                            <div class="dashboard_1_2_context_1_center_2">
                                <p class="font-left-right">R</p>
                                @if ($dashboard['business_snapshot']['binary_qualified']['right'] > 0)
                                    <span class="glyphicon glyphicon-ok check-icon"></span>
                                @else
                                    <span class="glyphicon glyphicon-remove cancel-icon"></span>
                                @endif
                            </div>
                        </div>

                        <div class="dashboard_context_footer">
                            <div class="dashboard_context_footer_text">
                                Personally Enrolled Active
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="ibumm-battery-status">Binary Volume</div>
                        <div class="dashboard_1_2_context_2">
                            <div class="dashboard_1_2_context_2_center">
                                <div class="dashboard_1_2_context_2_center_1">
                                    <p class="p_width font-left-right">L</p>
                                    <p class="price p_width">{{ number_format($dashboard['business_snapshot']['binary_volume']['left']) }}</p>
                                </div>
                                <div class="dashboard_1_2_context_2_center_2">
                                    <p class="p_width font-left-right">R</p>
                                    <p class="price p_width">{{ number_format($dashboard['business_snapshot']['binary_volume']['right']) }}</p>
                                </div>
                            </div>
                            <div class="dashboard_context_footer">
                                <div class="dashboard_context_footer_text">
                                    Binary total volume
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                @if ($dashboard['upgrades']['showUpgradeBtn'])
                    <div class="ibumm-widget-title-small">UPGRADE</div>
                @endif
                <div class="dashboard_1_3_context">
                    @if ($dashboard['upgrades']['showUpgradeBtn'])
                        <div class="countdown-text" id="countdown"></div>

                        <div class="row packages mt-2 text-center">
                            @foreach ($dashboard['upgrades']['packages'] as $package)
                                @if ($package['enable'])
                                    <div class="col-12 mb-3">
                                        <input class="form-check-input" type="radio" name="my_package" id="{{ $package['value'] }}" value="{{ $package['value'] }}">
                                        <img src="{{$package['image']}}" alt="{{$package['value']}}" for="{{$package['value']}}" class="upgrade-image">
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary" id="btnUpgradePack">Upgrade Pack</button>
                        </div>
                    @else
                        <div class="row mt-4">
                            <div class="col-8 offset-2">
                            @if(\Auth::user()->current_product_id == 4)
                                <img class="img-no-upgrade" style="border-radius: 0px" src="{{ asset('assets/images/no_upgrade.png') }}"  alt="No Upgrade"/>
                            @else
                                <img class="img-no-upgrade" style="border-radius: 0px" src="{{ asset('assets/images/2020Gradlogo.png') }}"  alt="2020 Graduate program"/>
                            @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <form action="{{ route('api-request')}} }}" id="upgradePack">
                <input type="hidden" id="order_conversion_id" name="order_conversion_id" value="">
                <input type="hidden" name="country_code" value="{{Auth::user()->getConversionCountry()}}">
            </form> --}}
        </div>
    </div>
</div>
{{-- 
@push('scripts')
<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ route('api-request') }}',
            method: 'POST',
            data: {
                endpoint: '/affiliate/subscription/get-upgrade-countdown',
                method: 'GET'
            },
            success: function (res) {
                let countdown = $('#countdown');

                if (res.date) {
                    let offset = new Date().getTimezoneOffset();
                    let localOffset = offset * 60000;
                    let countDownDate = new Date(res.date).getTime() + localOffset;

                    const x = setInterval(function () {
                        let now = new Date().getTime();
                        let distance = countDownDate - now;
                        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        countdown.text(("0" + days).slice(-2) + " : " + ("0" + hours).slice(-2) + " : " + ("0" + minutes).slice(-2) + " : " + ("0" + seconds).slice(-2));

                        if (distance < 0) {
                            clearInterval(x);
                            countdown.text("00 : 00 : 00 : 00");
                        }

                    }, 1000);
                } else {
                    countdown.text("00 : 00 : 00 : 00");
                }
            }
        });
    });

    $('#btnUpgradePack').on('click', function () {
        const id = $('input[name="my_package"]:checked').val();

       
        $('input[data-product-id]').val(id);
        $.ladda( 'stopAll' );
        $.ajax({
            url: '{{ route('api-request') }}',
            method: 'POST',
            data: {
                endpoint: '/affiliate/subscription/upgrade-now',
                method: 'GET',
                data: {
                    id: id,
                    country: $('input[name="country_code"]').val(),
                    locale: navigator.language.replace("-", "_")
                }
            },
            success: function (res) {                
                let price = parseFloat(res.data.product.price).toLocaleString('en-US', { 'style': 'currency', 'currency': 'USD', 'currencyDisplay': 'symbol' });
                $('form#upgradePack #order_conversion_id').val(res.data.order_conversion_id);
                $('p[data-product-name]').text(res.data.product.productname);
                $('p[data-product-desc]').text(res.data.product.productdesc);
                $('p[data-product-price]').text("$"+res.data.product.price+" USD / "+res.data.conversion.display_amount);

                $('input[name="newProductId"]').val(res.data.new_product_id);
                $('input[name="currentProductId"]').val(res.data.current_product_id);
                $('input[name="upgradeProductId"]').val(res.data.upgrade_product_id);
                
                $('.btnAddToCart').data('product',res.data.new_product_id).data('modal','#modalCheckout');

                $('#modalCheckout').modal('show');
                $('input[data-product-id]').val(id);

                $('#product_cart_id').val(id);

                
            }
        });
    });
</script>
@endpush --}}
