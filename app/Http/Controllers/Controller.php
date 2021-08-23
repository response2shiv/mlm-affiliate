<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Validate if user should have access to the portal
     */
    protected function validateUserStatus()
    {
        //Checking to see what status the account is
        if (!User::isAffiliateUser()) {
            return view('affiliates.dashboard.suspended_user.index');
        }
    }
}
