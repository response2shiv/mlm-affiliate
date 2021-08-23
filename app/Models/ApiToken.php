<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class ApiToken extends Model
{

    protected $table = "api_token";
    public $timestamps = false;

    public static function isValidToken($token)
    {
        // this token is hardcode to communicate with enrollement site
        if ($token == "KBT49D2QGM8UGLQT6U84") {
            return true;
        }
        //
        $count = DB::table('api_token')
                ->where('token', $token)
                ->where('is_active', 1)
                ->count();
        return $count > 0;
    }
}
