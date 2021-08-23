<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Models\PromoInfo;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $promo = PromoInfo::where('id', 1)->first();

        if (parent::validateUserStatus()) {
            return parent::validateUserStatus();
        }
        
        // Log::info("Show notification value is -> ".session('show_notification'));
        // session('show_notification', '1');
        return view('affiliates.dashboard.index')->with([
            'user' => $user,
            'promo' => $promo
        ])->render();
    }
}
