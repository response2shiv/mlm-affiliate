<?php

namespace App\Http\Controllers\Affiliates;

use App\Helpers\ApiHelper;
use App\Helpers\Billing;
use App\Models\UserPaymentMethod;
use App\Models\UserPaymentAddress;
use App\Models\Address;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Util;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Log;

class ShoppingCartController extends Controller
{

    # Just return true or false if have a product on the cart with shipping
    public function hasShipping($items)
    {
        $hasShipping = false;

        if (isset($items)) {
            foreach ($items as $item) {
                if ($item->product->shipping_enabled) {
                    $hasShipping = true;
                    break;
                }
            }
        }

        return $hasShipping;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myCart()
    {
        session()->forget('payment_selected');

        $response = ApiHelper::request('GET', '/affiliate/shopping-cart/cart', array());

        $shopping_cart = json_decode($response->getBody())->data;

        if (isset($shopping_cart->error) && ($shopping_cart->error == 1)) {
            return redirect()->back();
        }

        $hasShipping = $this->hasShipping($shopping_cart->items);

        if (!session('shipping_address')) {
            $shipping_address = Address::getRec(\Auth::user()->id, Address::TYPE_SHIPPING, 1);
        } else {
            $user_defaul_shipping_address = Address::where('userid', Auth::user()->id)
                ->where('id', session('shipping_address'))
                ->first();

            $shipping_address = $user_defaul_shipping_address ?: Address::getRec(\Auth::user()->id, Address::TYPE_SHIPPING, 1);
        }

        $addresses = Address::getUserShippingAddress(Auth::user()->id);

        $countries = Country::getAll();
        $physical_product = $this->checkProductsType($shopping_cart->items);

        $voucher_status = '';
        if (!empty($shopping_cart->voucher_id)) {
            $voucher_status = $shopping_cart->voucher->is_active > 0 ? '' : 'color:red;';
        }

        return view('affiliates.shopping-cart.my-cart', [
            'shopping_cart' => $shopping_cart,
            'shipping_address' => $shipping_address,
            'addresses' => $addresses,
            'countries' => $countries,
            'physical_product' => $physical_product,
            'has_shipping' => $hasShipping,
            'voucher_status' => $voucher_status

        ]);
    }

    public function updateCart(Request $request)
    {
        $data = $request->except('_token');

        $response = ApiHelper::request('POST', '/affiliate/shopping-cart/update-cart', $data);

        $data = json_decode($response->getBody());

        return redirect()->route('shopping-cart.my-cart');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paymentsMethods()
    {
        session()->forget('payment_selected');

        $response = ApiHelper::request('GET', '/affiliate/shopping-cart/cart', array());
        $shopping_cart = json_decode($response->getBody())->data;

        if (!empty($shopping_cart->voucher)) {
            if ($shopping_cart->voucher->is_active == 0) {
                return redirect()->back();
            }
        }
        #jump user to confirmation if shoppint-cart total is 0
        if ($shopping_cart->total_calculated == 0) {
            session()->put('payment_selected', 'voucher');

            return redirect()->route('shopping-cart.confirmation');
        }

        $response = ApiHelper::request('GET', '/affiliate/shopping-cart/payments-methods-available', array());



        $data = json_decode($response->getBody());



        return view('affiliates.shopping-cart.checkout', [
            'payment_methods'  => $data->data->paymentMethods,
            'limit_unicrypt'   => $data->data->minimum_via_unicrypt,
            'allow_creditCard' => $data->data->allow_creditCard
        ]);
    }

    public static function getFormatedCardNo($token)
    {
        $count = strlen($token);
        $temp1 = substr($token, 0, 6);
        $temp2 = substr($token, -4);
        $xCount = $count - 10;

        return $temp1 . str_repeat('x', $xCount) . $temp2;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmation(Request $request)
    {
        $response = ApiHelper::request('GET', '/affiliate/shopping-cart/checkout', array());
        $data = json_decode($response->getBody());

        $paymentMethod = session('payment_selected');
        $cvv = $request->get('cvv');
        $payment_method_id = $request->get('payment_method_id');
        # Data to billing
        if ($request->get('payment_method') == 'ipaytotal') {
            session()->put('payment_selected', 'billing');
            session()->put('payment_method_id', $payment_method_id);
            session()->put('cvv', $cvv);
        }

        $hasShipping = $this->hasShipping($data->data->items);

        if (!session('shipping_address')) {
            $shipping_address = Address::getRec(\Auth::user()->id, Address::TYPE_SHIPPING, 1);
        } else {
            $user_defaul_shipping_address = Address::where('userid', Auth::user()->id)
                ->where('id', session('shipping_address'))
                ->first();

            $shipping_address = $user_defaul_shipping_address ?: Address::getRec(\Auth::user()->id, Address::TYPE_SHIPPING, 1);
        }

        $payment_user = [];

        #dont show payment if e-wallet or full-voucher
        if ($paymentMethod != "ewallet" && $paymentMethod != "voucher") {
            $payment_user = UserPaymentMethod::find($payment_method_id)->toArray();
            $payment_user['card_token'] = $this->getFormatedCardNo($payment_user['card_token']);
            $payment_user['cvv'] = $cvv;
            $payment_user['address'] = UserPaymentAddress::find($payment_user['user_payment_address_id'])->toArray();
        }


        return view('affiliates.shopping-cart.confirmation', [
            'shopping_cart' => $data->data,
            'payment_method' => $paymentMethod,
            'has_shipping' => $hasShipping,
            'shipping_address' => $shipping_address,
            'payment_user' => $payment_user
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $response = ApiHelper::request('POST', '/affiliate/shopping-cart/remove-product', [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);

        $data = json_decode($response->getBody());

        session()->put('cart-items', $data->data->cartItems);

        return response()->json($data);
    }


    public function addToCart(Request $request)
    {
        $response = ApiHelper::request('POST', '/affiliate/shopping-cart/add-product', [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'amount' => $request->amount ?: 0
        ]);

        $data = json_decode($response->getBody());

        if ($data->data->error == 0) {
            session()->put('cart-items', $data->data->cartItems);
        }

        return response()->json($data);
    }

    public function isGift(Request $request)
    {
        $gift = $request->gift;

        session()->put('is_gift', $gift);

        return response()->json(['data' => 'Successfully changed']);
    }

    public function addPaymentMethod(Request $request)
    {
        $data = $request->all();

        $addressInfo = $request->address;
        $cardInfo = $request->credit_card;

        $response = Billing::iPayTotal($addressInfo, $cardInfo);


        $data = (object)$response;

        if ($data->success == true) {
            $newCard = UserPaymentMethod::convertAndSave($data->data['credit_card'], $data->data['billing_address']);

            return response()->json($data, 200);
        }

        return response()->json((object)$data, 200);
    }

    public function applyPaymentMethod(Request $request)
    {
        session()->put('payment_selected', $request->payment_method);

        $payment_selected = session('payment_selected');

        return $payment_selected;
    }

    public function applyShippingAddress(Request $request)
    {

        $address = Address::find($request->address_id);

        if ($address) {
            session()->put('shipping_address', $address->id);
        }
        return response()->json($address, 200);
    }

    public function processPayment()
    {
        try {
            $parameters = [
                'payment_method'    => session('payment_selected'),
                'payment_method_id' => session('payment_method_id'),
                'shipping_address'  => session('shipping_address'),
                'cvv'               => session('cvv'),
                'gift'              => session('is_gift'),
                'currency'          => 'USD',
                'redirect_3ds_url'  => env('SHOPPING_CART_FINAL_URL', 'https://dev2.bitjarlabs.com/shopping-cart/thank-you'),
                'user_ip'           => \Request::ip()
            ];

            $response = ApiHelper::request('POST', '/affiliate/shopping-cart/process-payment', $parameters);

            $data = json_decode($response->getBody());


            if ($data->error == 0) {
                session()->forget('payment_selected');
                session()->forget('payment_method_id');
                session()->forget('cart-items');
                session()->forget('shipping_address');
            }
        } catch (\Throwable $th) {
            Log::error('error on shopping cart process-payment: ' . $th->getMessage());
            $data = ['error' => 1, 'status' => 'error', 'msg' => 'Transaction failed. Please contact customer support.'];
        }


        return response()->json($data);
    }

    public function paymentWaiting()
    {
        return view('affiliates.shopping-cart.payment-waiting');
    }

    public function thankYou()
    {
        return view('affiliates.shopping-cart.thank-you');
    }

    public function paymentFail($message)
    {
        return view('affiliates.shopping-cart.payment-fail', ['message' => $message]);
    }
    public function changeStatus()
    {
        return view('affiliates.shopping-cart.change-status');
    }

    public function getInvoiceStatus(Request $request)
    {
        $response = ApiHelper::request('GET', '/affiliate/shopping-cart/get-status', [
            'orderhash' => $request->get('orderhash'),
        ]);

        $data = json_decode($response->getBody());

        return response()->json($data);
    }

    public function getStatus(Request $request)
    {
        $status = $request->get('status');

        if (!empty($status)) {
            if ($status == 'fail') {
                return $this->paymentFail($request->message);
            }

            if ($status == 'success') {
                $response = $this->processAfterMerchantResponse($request);

                if ($response->status == 'success') {
                    return $this->thankYou();
                } elseif ($response->status == 'failed') {
                    return $this->paymentFail($response->msg);
                }
            }
        }

        return $this->thankYou();
    }

    public function processAfterMerchantResponse($request)
    {
        $response = ApiHelper::request('POST', '/affiliate/shopping-cart/finish-purchase', [
            'order_id'     => $request->get('order_id'),
            'pre_order_id' => $request->get('sulte_apt_no'),
            'status'       => $request->get('status'),
            'message'      => $request->get('message')
        ]);

        $data = json_decode($response->getBody());

        if ($data->error == 0) {
            session()->forget('payment_selected');
            session()->forget('payment_method_id');
            session()->forget('cart-items');
        }

        return $data;
    }

    public function getTotalItemCart()
    {
        $response = ApiHelper::request('GET', '/affiliate/shopping-cart/get-total-items-cart', []);
        $data = json_decode($response->getBody());
        return response()->json($data->total);
    }

    public function checkProductsType($products)
    {
        $productTypes = [];
        foreach ($products as $product) {
            $productTypes[] = $product->product->producttype;
        }

        if (in_array(8, $productTypes)) {
            $shipping_address = Address::getRec(\Auth::user()->id, Address::TYPE_SHIPPING, 1);

            if ($shipping_address) {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }

    public function getUserPaymentsMethods()
    {
        # Get user payments from new table
        $res = ApiHelper::request(
            'GET',
            '/affiliate/user/payment-methods',
            []
        );

        $payments = json_decode($res->getBody())->data;


        $cc_availables['subscription']['creditCards'] = [];

        foreach ($payments->payment_methods as $creditCard) {
            $cc_availables['subscription']['creditCards'][] = [
                'id' => $creditCard->id,
                'paymentMethodName' => 'Credit Card: ' . $this->getFormatedCardNo($creditCard->card_token),
            ];
        }

        return response()->json($cc_availables, 200);
    }
}
