<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use App\Helpers\Util;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showTabProfile($tab = null)
    {
        switch ($tab) {
            case 'binary-placement':
                return $this->showBinaryPlacement();
            break;
            case 'replicated-site':
                return $this->showReplicatedSite();
            break;
            case 'binary-placement':
                return $this->showBinaryPlacement();
            break;
            case 'primary-address':
                return $this->showPrimaryAddress();
            case 'shipping-address':
                return $this->showShippingAddress();
            break;
            case 'billing-address':
                return $this->showBillingAddress();
            break;
            case 'idecide':
                return $this->showIdecide();
            break;
            case 'billing':
                return $this->showBilling();
            break;
            case 'payment-methods':
                return $this->showUserPaymentMethods();
            break;
            default:
                return $this->showBasicInformation();
        }
    }

    public function showBinaryPlacement()
    {
        $response = ApiHelper::request('GET', '/affiliate/user/my-profile/binary-placement', array());

        $data = json_decode($response->getBody());

        $user = Auth::user();
        return view('affiliates.profile.tabs.binary_placement', [
            'binary_placement' => $data->data->binary_placement,
            'user' => $user
        ]);
    }

    public function showBasicInformation()
    {
        $response = ApiHelper::request('GET', '/affiliate/user/my-profile', array());

        $data = json_decode($response->getBody());

        $user = Auth::user();
        return view('affiliates.profile.tabs.basic_information', [
            'profile' => $data->data->rec,
            'selected' => 'basic',
            'user' => $user
        ]);
    }

    public function showReplicatedSite()
    {
        $response = ApiHelper::request('GET', '/affiliate/user/my-profile/replicated', array());

        $data = json_decode($response->getBody());

        $user = Auth::user();
        return view('affiliates.profile.tabs.replicated_site', [
            'preferences' => $data->data->preferences,
            'user' => $user
        ]);
    }

    public function showPrimaryAddress()
    {
        $response = ApiHelper::request('GET', '/affiliate/user/my-profile/primary-address', array());

        $data = json_decode($response->getBody());
        $user = Auth::user();
        return view('affiliates.profile.tabs.primary_address', [
            'primary_address' => $data->data->primary_address,
            'countries'       => $data->data->countries,
            'user' => $user
        ]);
    }

    public function showShippingAddress()
    {
        $response = ApiHelper::request('GET','/affiliate/user/my-profile/shipping-address',array());

        $data = json_decode($response->getBody());
        $countries = Country::getAll();

        $user = Auth::user();
        return view('affiliates.profile.tabs.shipping_address',[
                'shipping_addresses' => $data->data->shipping_addresses,
                'countries'       => $countries,
                'user' => $user
        ]);
    }

    public function showBillingAddress()
    {
        $response = ApiHelper::request('GET', '/affiliate/user/my-profile/billing-address', array());

        $data = json_decode($response->getBody());
        $user = Auth::user();
        return view('affiliates.profile.tabs.billing_address', [
            'billing_address' => $data->data->billing_address,
            'countries'       => $data->data->countries,
            'user' => $user
        ]);
    }

    public function showUserPaymentMethods()
    {
        $response = ApiHelper::request('GET', '/affiliate/user/payment-methods', array());

        $data = json_decode($response->getBody());
        $user = Auth::user();

        
        return view('affiliates.profile.tabs.payment_methods', [
            'payment_methods' => $data->data->payment_methods,
            'user' => $user
        ]);
    }


    public function showIdecide()
    {
        $user = Auth::user();
        return view('affiliates.profile.tabs.idecide', [
            'user' => $user
        ]);
    }

    public function showBilling()
    {
        $response = ApiHelper::request('GET', '/affiliate/user/my-profile/billing', array());

        $data = json_decode($response->getBody());
        $user = Auth::user();
        return view('affiliates.profile.tabs.billing', [
            'cards'     => $data->data->cards,
            'addresses' => $data->data->addresses,
            'countries' => $data->data->countries,
            'vibeUserWithoutBillingInfo' => $data->data->vibeUserWithoutBillingInfo,
            'user' => $user
        ]);
    }

    public function updateSession()
    {
        $response = ApiHelper::request('GET', '/affiliate/user/user-info', array());
        $response_data = json_decode($response->getBody());

        if ( isset($response_data->data) ){
            $data = $response_data->data;

            $infoUserApi = [
                'user' => (object) [
                    'firstname'          => $data->firstname,
                    'lastname'           => $data->lastname,
                    'profile_image_url'  => $data->profile_image_url
                ],
                'pv'   => $data->pv,
                'achieved_rank_desc' => $data->achieved_rank_desc,
            ];

            AuthService::storesUserData((object) $infoUserApi);

            $data->profile_image_url = User::getProfilePicture();

           
        }else{
            $data = [ 
                'firstname' => ''            
            ];    
        }
        
        return response()->json($data);        
    }

    public function uploadFoto(Request $request)
    {
        $user = Auth::user();
        $data = $request->image;

        if (!Util::isNullOrEmpty($user->profile_image_url)) {
            Storage::delete($user->profile_image_url);

            $resultImage = $this->decodeImageCrop($data);
            Storage::put($resultImage['image_name'], $resultImage['data']);

            ApiHelper::request('POST', '/affiliate/user/save-profile-picture-url', [
                'profile_image_url' => $resultImage['image_name']
            ]);
        } else {
            $resultImage = $this->decodeImageCrop($data);
            Storage::put($resultImage['image_name'], $resultImage['data']);
            ApiHelper::request('POST', '/affiliate/user/save-profile-picture-url', [
                'profile_image_url' => $resultImage['image_name']
            ]);
        }
        $this->updateSession();

        return response()->json(['msg' => 'ok', 'url' => $resultImage['image_name']], 200);
    }

    private function decodeImageCrop($data)
    {
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $path = 'avatars/';
        $image_name = $path . time() . '.png';

        return ['data' => $data, 'image_name' => $image_name];
    }

    public function getPrimaryAddress()
    {
        $response = ApiHelper::request('GET', '/affiliate/user/my-profile/primary-address', array());

        $data = json_decode($response->getBody());

        return response()->json(['primary_address' => $data->data->primary_address], 200);
    }
}
