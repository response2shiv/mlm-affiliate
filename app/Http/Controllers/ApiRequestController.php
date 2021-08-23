<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\ApiRequest;

class ApiRequestController extends Controller
{
    /**
     * @param ApiRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function request(ApiRequest $request)
    {
        $data = $request->validated();

        // Makes the request
        $res = ApiHelper::request(
            $data['method'],
            $data['endpoint'],
            $data['data'] ?? [],
            $data['headers'] ?? []
        );

        return response()->json(json_decode($res->getBody()));
    }
}
