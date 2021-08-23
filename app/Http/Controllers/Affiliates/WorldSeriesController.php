<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use App\Models\Product;
use GuzzleHttp\Client;
use Mpdf\Mpdf;
use Log;
use Auth;
use App\Models\User;
use App\Models\UserType;
use App\Models\UserRankHistory;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use DB;
use Carbon\Carbon;

class WorldSeriesController extends Controller
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

        $response = ApiHelper::request(
            'POST',
            '/join/resume-owner-world-series',
            [
                'sponsorId' => Auth::user()->id,
            ]
        );

        $response_data = json_decode($response->getBody());

        $diamond = $response_data->data;

                // dd($diamond);

                // dd(Auth::user());
        $response_team = ApiHelper::request('GET', '/join/top-teams-world-series', array());
        $response_data_team = json_decode($response_team->getBody());
        $top_teams = $response_data_team->data;
            
        return view('affiliates.world-series.index')->with(['diamond' => $diamond->resume, 'top_teams' => $top_teams->resume]);
    }
}
