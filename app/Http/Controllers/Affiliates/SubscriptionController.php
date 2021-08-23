<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use GuzzleHttp\Client;
use Auth;

class SubscriptionController extends Controller
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * ApiHelper constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }
    
    public function subscription()
    {
        $response = ApiHelper::request('GET', '/affiliate/subscription/index/'.Auth::user()->getConversionCountry().'/', array());
        $response_data = json_decode($response->getBody());
        
        return view('affiliates.subscription.index')->with(['response' => $response_data->data]);
    }

    public function dlgSubscriptionReactivateSuspendedUser()
    {
        $response = ApiHelper::request('GET', '/affiliate/subscription/subscription-reactivate-suspended-user/'.Auth::user()->getConversionCountry().'/', array());

        $response_data = json_decode($response->getBody());
        return view('affiliates.subscription.reactivate_suspended_account')->with(['response' => $response_data]);
    }
}
