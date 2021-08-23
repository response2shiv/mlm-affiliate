
@component('layouts.components.modal', [
    'id' => 'modalSubscriptionReactivate',
    'header' => [
        'image' => asset('assets/images/iBuumerangLogo.png'),
        'width' => '150px'
    ],
    'modal_size' => 'modal-sm',
    ])
    <div class="cm-body">

        <div class="cm-body-inner">
            <div class="col-12 alert alert-danger d-none" id="errorMessage"></div>
            <div class="col-12 alert alert-success d-none" id="couponMessage"></div>

            <form id=frmReactivateSuspendedSubscription>

                <table class="product-tbl" id="ibuumerang_product_table" style="margin-left: 0px; margin-bottom: 5px;">
                    <tbody>
                    <tr class="prdct-head">
                        <td>PRODUCT</td>
                        <td>PRICE</td>
                    </tr>
                    <tr class="prdct-item">
                        <td class="prdct-name">
                            <p>
                                <span style="font-size: 12px;"> Subscription Fee </span>
                            </p>
                        </td>
                        <td class="text-left">
                            <p>
                            <strong style="font-size: 12px;"><span id="subscription_amount_display">${{$response->data->subscription_amount}} USD / {{$response->data->conversion->display_amount}}</strong>
                                <input type="hidden" id="subscription_amount" name="subscription_amount" value="{{$response->data->subscription_amount}}">
                            </p>
                        </td>
                    </tr>
                    @if($response->data->subscription_fee->is_enabled)
                        <tr class="prdct-item" style="border-bottom: 1px solid #ffffff;">
                        <td class="prdct-name">
                            <p>
                                <span style="font-size: 12px;"> Reactivation Fee </span>
                            </p>
                        </td>
                        <td class="text-left">
                            <p>
                                <strong style="font-size: 12px;"><span id="subscription_fee" >{{number_format($response->data->subscription_fee->price,2)}}</strong>
                            </p>
                        </td>
                    </tr>
                    @endif
                    <tr class="prdct-item">
                        <td class="prdct-name">
                            <p>
                                <span style="font-size: 12px;"> Total </span>
                            </p>
                        </td>
                        <td class="text-left">
                            <p>
                            <strong style="font-size: 12px;"><span id="total">${{$response->data->total}} USD / {{$response->data->total_display}}</strong>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!-- <div class="form-group">
                    <label> Do you have a voucher code?</label>
                    <input type="text" id="coupon" class="sub_input-box" value="{{isset($response->data->coupon_code)?$response->data->coupon_code:''}}">
                    <button type="button" id="btnReactivateSubscriptionAddCouponCode" class="ladda-button btn btn-yellow" value="Apply" data-style="expand-right">
                        <span class="ladda-label">Apply</span>
                        <span class="ladda-spinner"></span>
                        <div class="ladda-progress" style="width: 0;"></div>
                    </button>
                </div>
                <input type="hidden" data-product-id>
                <div class="form-group">
                    <label for="payment_method" class="control-label">Payment Method<span class="req">*</span></label>
                    <select class="form-control form-control-sm" name="subscription_payment_method_id"
                            id="subscription_payment_method_type_id">
                        @if(!empty($response->data->payment_method))
                            @foreach($response->data->payment_method as $payment_method)
                                <option value="{{$payment_method->id}}">{{$payment_method->paymentMethodName}}</option>
                            @endforeach
                        @endif
                        @if (env('DISABLE_BILLING', false) === false)
                            <option value="add_new_card">Add New Card</option>
                        @endif
                    </select>
                </div> -->
                <input type="hidden" id="order_conversion_id" name="order_conversion_id" value="{{$response->data->order_conversion_id}}">
                <input type="hidden" id="country_code" value="{{Auth::user()->getConversionCountry()}}">
            </form>

            @slot('actions')
                <button class="btn btn-dark" id="btnSubscriptionReactivateCloseButton" data-href="{{URL::to('/login')}}">CLOSE</button>
                <!-- <button class="ladda-button btn btn-yellow" id="btnSubscriptionReactivateSubmitButton" data-style="expand-right">
                    <span class="ladda-label">Submit</span>
                    <span class="ladda-spinner"></span>
                    <div class="ladda-progress" style="width: 0;"></div>
                </button> -->
                <button class="btn btn-yellow btnAddToCart" data-product="11" data-modal="REDIRECT">ADD TO CART <i class="fa fa-shopping-cart"></i></button>
            @endslot                   
        </div> 
    </div>
@endcomponent









