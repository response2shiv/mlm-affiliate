<?php

namespace App\Http\Controllers\Affiliates;

use Log;
use App\Models\User;
use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class EwalletTransactionController extends Controller
{
    public function index()
    {

        try {
            /*$response = $this->client->request('GET', $url, [
                'headers' => $headers
            ]);*/
            $response = ApiHelper::request('GET', '/affiliate/e-wallet', array());
            $response_data = json_decode($response->getBody());
            
        } catch (\Exception $e) {
            return ['message' => $e->getMessage()];
        }
        $response_data->data->found1099 = false;
        //overwrite $found1099 in response api data with verification S3 storage
        $response_data->data->found1099 = Storage::disk('s3')->exists('1099/2019/1099_'.Auth::user()->distid.'.pdf');
        
        return view('affiliates.e-wallet.index')->with(['response' => $response_data->data]);
    }

    public function getIpayoutUser()
    {
        $user =new User;
        
        //$iPayoutUser = $user->getIpayoutUser(Auth::user());
        $iPayoutUser = 0;
        //get url based on enviroment
        $url = env('APP_ENV') == 'local'
                ? Config::get('const.ipayout.sb.eWalletMerchantURL')
                : Config::get('const.ipayout.lv.eWalletMerchantURL');
        
        return response()->json(['message'=>$iPayoutUser,'url'=>$url]);
    }
}
