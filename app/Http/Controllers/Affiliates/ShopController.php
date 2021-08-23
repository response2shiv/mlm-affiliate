<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use GuzzleHttp\Client;
use Auth;

class ShopController extends Controller
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

    public function shop(Request $request)
    {
        $sort = $request->get('sort', 'desc');

        $response = ApiHelper::request('POST', '/affiliate/shop/index', ['sort' => $sort]);
        $response_data = json_decode($response->getBody());

        return view('affiliates.shop.index')->with(['response' => $response_data->data, 'sort' => $sort]);
    }

    public function productDetail($id = null)
    {
        $response = ApiHelper::request('GET', '/affiliate/shop/product/'. $id .'/'.Auth::user()->getConversionCountry().'/', array());
        $response_data = json_decode($response->getBody());
        // dd($response_data);
        return view('affiliates.shop.product_detail')->with(['product' => $response_data->data->product]);
    }
}
