@component('layouts.components.modal', [
    'id' => 'modalSubscriptionSeptember',
    'header' => [
        'image' => asset('assets/images/iBuumerangLogo.png'),
        'width' => '150px'
    ],
    'modal_size' => 'modal-sm'
    ])
    <div class="cm-body">
        <div class="cm-body-inner">
            <div class="col-12 alert alert-danger d-none" id="errorMessage"></div>
            <div class="col-12 alert alert-success d-none" id="couponMessage"></div>
            <form id=frmReactivateSubscriptionSeptember>
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
                                <strong style="font-size: 12px;"><span id="subscription_amount_display">{{"$".$response->september_subscription->subscription_amount." USD / ".$response->september_subscription->conversion->display_amount}}</span></strong>
                                <input type="hidden" id="subscription_amount" name="subscription_amount" value="{{$response->september_subscription->subscription_amount}}">
                            </p>
                        </td>
                    </tr>
                    @if($response->subscription_fee->is_enabled)
                    <tr class="prdct-item" style="border-bottom: 1px solid #ffffff;">
                        <td class="prdct-name">
                            <p>
                                <span style="font-size: 12px;"> Reactivation Fee </span>
                            </p>
                        </td>
                        <td class="text-left">
                            <p>
                                <strong style="font-size: 12px;"><span id="subscription_fee" >{{number_format($response->september_subscription->subscription_fee->price,2)}}</span></strong>
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
                                <strong style="font-size: 12px;"><span id="total_display">{{"$".$response->september_subscription->total." USD / ".$response->september_subscription->total_display}}</span></strong>
                                <input type="hidden" id="total" name="total" value="{{$response->september_subscription->total}}">
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
             
            </form>
            @slot('actions')
                <button class="btn btn-dark" id="btnCloseSubscriptionModal">Close</button>
                <button class="btn btn-yellow btnAddToCart" data-product="{{$response->september_subscription->subscription_product_id}}"" data-modal="REDIRECT">ADD TO CART <i class="fa fa-shopping-cart"></i></button>              
            @endslot
        </div>
    </div>
@endcomponent
