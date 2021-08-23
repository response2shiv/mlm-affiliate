<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use GuzzleHttp\Client;
use Auth;

class PlacementController extends Controller
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

    public function index()
    {
        // $response = ApiHelper::request('GET', '/affiliate/binary-placement', []);
        // $response_data = json_decode($response->getBody());

        // $direct_line_response = ApiHelper::request('GET', '/affiliate/binary-placement/direct-line', []);
        // $direct_line_response_data = json_decode($direct_line_response->getBody());

        // return view('affiliates.organization.placement', ['response' => $response_data->data, 'direct_line' => $direct_line_response_data->data->tree]);

        return view('affiliates.organization.placement');
    }

    public function bucketPlacement()
    {
        $user = Auth::user();
        $response = ApiHelper::request('GET', '/affiliate/bucket-placement-lounge/get-users', []);
        $response_data = json_decode($response->getBody());
        
        if(count($response_data) > 0 && $user->getUserTree->count() > 0){
            if(session()->exists('users')){
                session()->forget('users');
            }
            return view('affiliates.organization.bucket-placement', [
                'users' => $response_data,                 
                'bucketIsNotAvaliable' => false
            ]);
        }else{
            return view('affiliates.organization.bucket-placement', [
                'users' => $response_data,
                'bucketIsNotAvaliable' => true
                ]);
        }
        
    }

    public function update(Request $request)
    {
        $binary_placement = $request->get('preference_placement');

        $response = ApiHelper::request('POST', '/affiliate/binary-placement/update', ['binary_placement' => $binary_placement]);

        
        return redirect()->back();
    }
}
