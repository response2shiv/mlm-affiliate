@extends('layouts.affiliates')
    @push('styles')
        <link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
     @endpush
@section('base-content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Subscription</h5>
                    </div>
                    <div class="ibox-content">
                    <form id="subscription">
                        <div class="alert alert-danger d-none" id="errorMessage"></div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label subscription-label">SUBSCRIPTION LEVEL</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" value="{{$response->current_plan}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label subscription-label">NEXT BILLING DATE</label>
                        <div class="col-lg-9">
                            <input type="text" id="next-subscription-date"
                            name="next_subscription_date" class="form-control" autocomplete="off"
                            value="{{$response->next_subscription_date}}" min="{{$response->next_subscription_date}}" max="25">
                        </div>
                        </div>
                        <input type="hidden" data-product-id>
                        @foreach ($response->payment_method as $payment_method)
                            @if (!empty($payment_method->selected))
                                <input type="hidden" name="subscription_payment_method_id" id="subscription_payment_method_type_id" value="{{$payment_method->id}}"/>
                            @endif
                        @endforeach
                        {{-- <div class="form-group row">
                            <label class="col-lg-3 col-form-label subscription-label">PAYMENT METHOD</label>
                            <div class="col-lg-9">
                                <input type="hidden" data-product-id>
                                <select class="form-control" data-toggle="modal" name="subscription_payment_method_id" id="subscription_payment_method_type_id">
                                    @foreach ($response->payment_method as $payment_method)
                                        <option value="{{$payment_method->id}}"{{$payment_method->selected}}>{{$payment_method->paymentMethodName}}</option>
                                    @endforeach
                                    @if (empty($subscription_card_added))
                                        <option value="add_new_card">Add New  Card</option>
                                    @endif
                                </select>
                            </div>
                        </div> --}}
                        @if($response->is_sites_deactivate == 1 || $response->subscription_attempts == 1)
                            <!-- Subscription reactivate button -->
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label subscription-label">STATUS</label>
                                <div class="col-lg-9">
                                    <a href="javascript:;" class="col-md-6 col-form-label m--font-success" id="btnOpenSubscriptionModal">
                                    @if($response->is_sites_deactivate == 1)
                                        Reactivate
                                    @elseif($response->subscription_attempts == 1)
                                        Pay Now
                                    @endif
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if(!empty($response->september_subscription->subscription_product_id))
                            <!-- Subscription reactivate september button -->
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label subscription-label">STATUS</label>
                                <div class="col-lg-9">
                                    <a href="javascript:;" class="col-md-6 col-form-label m--font-success" id="btnOpenSubscriptionSeptemberModal">
                                    @if($response->is_sites_deactivate == 1)
                                        Reactivate September
                                    @elseif($response->subscription_attempts == 1)
                                        Pay Now
                                    @endif
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="form-group m-form__group row" style="margin-top:10px;">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <input type="hidden" name="gflag" id="gflag" value="{{$response->gflag}}"/>
                                    @if($response->current_product_id != \App\Models\Product::ID_STANDBY_CLASS)
                                        <button id="btnSaveSubscription" class="ladda-button btn btn-focus m-btn m-btn--pill m-btn--air btn-info" data-style="expand-right">
                                            <span class="ladda-label">Save</span>
                                            <span class="ladda-spinner"></span>
                                            <div class="ladda-progress" style="width: 0;"></div>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/subscription.js') }}"></script>
@endpush

@push('modals')
    @include('affiliates.partials.modals._subscription')
    @include('affiliates.partials.modals._subscriptionSeptember')
    @include('affiliates.partials.modals._subscription_thank_you')
    @include('affiliates.partials.modals._subscription_add_new_card_thank_you')
    @include('affiliates.partials.modals._subscription_reactivated_thank_you')
    @include('affiliates.partials.modals._add_new_card')
    @include('affiliates.partials.modals._alert')
@endpush

