<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use GuzzleHttp\Client;
use App\Models\User;
use Auth;

class BucketPlacementController extends Controller
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

    public function setUser($id = null)
    {
        $user = User::findOrFail($id);
        session()->push('users', $user);

        $users = session()->get('users');
        return response()->json($users, 200);
    }

    public function getUser($usern)
    {
        $response = ApiHelper::request('POST', '/affiliate/bucket-placement-lounge/search-user', ['usern' => $usern]);
        $response_data = json_decode($response->getBody());

        if (isset($response_data->user->id))
            session()->put('searched_user', $response_data->user->id);
        else
            session()->put('searched_user', null);

        $searched_user = session()->get('searched_user');

        return response()->json($response_data);
    }

    public function placeSelected($bucket = 0)
    {
        $users = session()->get('users') ?? [];

        if (session()->get('searched_user') == null) {
            $placement_root = Auth::user()->id;
        } else {
            $placement_root = session()->get('searched_user');
        }

        if (count($users) > 1) {
            $bucket = 0;
        }

        $response = ApiHelper::request('POST', '/affiliate/bucket-placement-lounge/set-user-on-bucket', [
            'users' => $users,
            'placement_root' => $placement_root,
            'bucket' => $bucket
        ]);


        // dd($response);

        $response_data = json_decode($response->getBody());

        dd($response_data);
        // $searched_user = session('searched_user', $response_data->id);

        return response()->json($response_data);
    }

    public function removeUser($userId)
    {
        $users = session()->get('users');
        session()->forget('users');

        foreach ($users as $user) {
            if ($user->id != $userId) {
                session()->push('users', $user);
            }
        }


        $users = session()->get('users');

        return response()->json($users, 200);
    }
}
