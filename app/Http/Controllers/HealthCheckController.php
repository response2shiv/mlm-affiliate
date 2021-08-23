<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class HealthCheckController extends Controller
{

    public function check()
    {
        $statusCode = 200;
        try {
            DB::select(DB::raw("select version()"));
            $response['db'] = true;
        } catch (\Exception $e) {
            report($e);
            $response['db'] = $e->getMessage();
            $statusCode = 500;
        }

        try {
            Redis::set('redis-health-check', Carbon::now());
            $response['cache'] = true;
        } catch (\Exception $e) {
            report($e);
            $response['cache'] = $e->getMessage();
            $statusCode = 500;
        }

        try {
            $res = ApiHelper::request('GET', '/status/healthcheck', []);
            $response['api'] = json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            report($e);
            $response['api'] = $e->getMessage();
        }

        return response()->json($response, $statusCode);
    }
}
