<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use GuzzleHttp\Client;
use Auth;

class BinaryViewerController extends Controller
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

    public function index($id = null)
    {
        $response = ApiHelper::request('GET', '/affiliate/organization/binary-viewer', array('id' => $id));
        $response_data = json_decode($response->getBody());
        //error_log(print_r(json_encode($response->getBody()), true));
        return view('affiliates.organization.binary_viewer.index')->with(['response' => $response_data]);
    }
}
