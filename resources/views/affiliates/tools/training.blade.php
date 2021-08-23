@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn pb-0 pb-md-0">
    <div class="row">
        <div class="col-lg-12">
            <img src="{{ asset('images/forex-training-banner.png') }}" width="100%" class="responsive">
        </div>
    </div>
    
    <!-- <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content text-center">
                        <p class="mt-4" style="font-size: 1.44em">&bull; 6 HOURS OF SOLID TRAINING TO START</p>
                        <p style="font-size: 1.44em">&bull; Mr. Holton Buggs and Mr. Edwin Haynes<br>and all of the Blue Diamonds from Xccelerate</p>
                        <p style="font-size: 1.44em">&bull; Hours of new trainings will be added every month</p>
                        <p style="font-size: 1.44em">&bull; Private Access to the CEO Secret Vault of Trainings</p>
                        <p style="font-size: 1.44em">&bull; Regular $99 per month - Special Price of $19.95 per month</p> <br />

                        <button id="btnPurchaseTraining" class="btn btn-outline btn-success">BUY NOW</button>
                        <h2 class="pt-4" style="font-size: 1.2em; color: red; font-weight: bold"><s>Reg $99/mo</s></h2>
                        <h2 class="shiny-new-price">NOW $19.95/mo</h2>
                        <p>First 6 months are Free</p>               
                </div>
            </div>
        </div>
    </div> -->
    
</div>

<div class="wrapper wrapper-content animated fadeIn pb-0 pb-md-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins widget-rank-insights">
                <div class="ibox-title widget-rounded-border-top">        
                    <div class="col-xl-12 border-bottom-title">
                        <div class="row">                            
                            <div class="ibumm-widget-title">NCREASEU FOREX TRAINING LIBRARY</div>                            
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            @include('affiliates.tools.tabs_training.beginner_training')
                            @include('affiliates.tools.tabs_training.intermediate_training')
                            @include('affiliates.tools.tabs_training.advanced_training')                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/tools/training.js') }}"></script>

    <script>
      $(document).ready(function() {

        var language = navigator.language.replace('-', '_');
        
        $('#btnPurchaseTraining').on('click', function () {
            $(this).text('PROCESSING...');

            $.ajax({
                url: '{{ route('api-request') }}',
                method: 'POST',
                data: {
                    endpoint: '/affiliate/product-currency',
                    method: 'POST',
                    data: {
                        product_id: 56,
                        country: '{!! auth()->user()->country_code !!}',
                        locale: language
                    }
                },
                success: function (res) {
                    $('p[data-product-name]').text(res.productname);
                    $('p[data-product-desc]').text(res.productdesc);
                    $('p[data-product-price]').text("$"+res.price+" USD / "+res.display_amount);
                    $('input[name=productId]').val(res.id);
                    $('input[name=OrderConversion]').val(res.order_conversion_id);
                    $('input[name=sourceView]').val('training');
                    
                    $('.btnAddToCart').data('product',res.id).data('modal','#modalPurchaseTraining');
                    
                    $('#modalPurchaseTraining').modal('show');
                },
                complete: function () {
                    $('#btnPurchaseTraining').text('BUY NOW');
                }
            });
        });
      });
  </script>
@endpush


@push('modals')
    @include('affiliates.partials.modals._purchase_training')
    @include('affiliates.partials.modals._checkout')
    @include('affiliates.partials.modals.thank_you._default', ['id' => 'modalTrainingThankYou'])

    @component('components.toast', ['title' => 'Notification'])
        <p id="toastContent"></p>
    @endcomponent
@endpush
