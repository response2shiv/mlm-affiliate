<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Storage;
use Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserType;

class User extends Authenticatable
{
    use Notifiable;

    const USER_TYPE_ADMIN       = 1;
    const USER_TYPE_DISTRIBUTOR = 2;
    const USER_TYPE_CUSTOMER    = 3;
    const USER_TYPE_LEAD        = 4;

    //
    const REC_PER_PAGE = 20;
    // affiliate account status
    const ACC_STATUS_PENDING = "PENDING";
    const ACC_STATUS_PENDING_REVIEW = "PENDING REVIEW";
    const ACC_STATUS_PENDING_APPROVAL = "PENDING APPROVAL";
    const ACC_STATUS_APPROVED = "APPROVED";
    const ACC_STATUS_SUSPENDED = "SUSPENDED";
    const ACC_STATUS_TERMINATED = "TERMINATED";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rank()
    {
        $rank = null;
        $rank = DB::select("SELECT * FROM get_rank_metrice('" . $this->distid . "','" . $this->current_month_rank . "')");

        if (is_array($rank) && count($rank)) {
            $rank = $rank[0];
        }

        return $rank;
    }

    public static function isAffiliateUser()
    {
        if (Auth::check() && Auth::user()->usertype == UserType::TYPE_DISTRIBUTOR && Auth::user()->account_status != self::ACC_STATUS_SUSPENDED) {
            return true;
        }
        return false;
    }

    public static function getFullName()
    {
        return session()->get('first_name') ." ".session()->get('last_name');
    }

    public function sponsor()
    {
        return $this->hasOne('App\Models\User', 'distid', 'sponsorid');
    }

    public static function getFirstName()
    {
        return session()->get('first_name');
    }
    public static function getLastName()
    {
        return session()->get('last_name');
    }

    public static function getConversionCountry()
    {
        $country_code =  Auth::user()->country_code ?? 'US';
        $country_code_billing = DB::select("SELECT * FROM addresses where userid =".Auth::user()->id);
        if ($country_code) {
            return $country_code;
        } elseif ($country_code_billing) {
            return $country_code_billing['countrycode'];
        } else {
            return 'US';
        }
    }
    public static function getPV()
    {
        // return session()->get('pv');
        $monthAgo = date('Y-m-d', strtotime("-1 Months"));
        $rec = DB::table('orders')
                ->selectRaw('sum(orderqv) as qv')
                ->where('userid', Auth::user()->id)
                ->whereDate('created_dt', '>=', $monthAgo)
                ->first();
        $rec->qv > 100 ? 100 : $rec->qv;
        if ($rec->qv > 100) {
            $qv = 100;
        } else {
            $qv = $rec->qv;
        }

        return $qv;
    }

    public static function getMonthPQV($userId, $month, $year)
    {
        $start = Carbon::parse($year.'-'.$month.'-01')->format('Y-m-d');
        $end = Carbon::parse($year.'-'.$month.'-01')->endOfMonth()->format('Y-m-d');
        $pqv = DB::table('orders')
            ->select('orderqv', DB::raw('sum(orderqv) as pqv'))
            ->where('userid', $userId)
            ->whereBetween('created_date', [$start, $end])
            ->groupBy('orderqv')
            ->first();
        if (!$pqv) {
            return 0;
        }
        return $pqv->pqv;
    }

    public static function getRankDescription()
    {
        return session()->get('rank');
    }
    public static function getProfilePicture()
    {
        if (strlen(session()->get('profile_image_url'))>0) {
            return Storage::URL(session()->get('profile_image_url'));
        } else {
            return Storage::URL('avatars/default-profile-img.png');
        }
    }

    public static function getRootUserPQV($distid, $month, $year)
    {
        $start = Carbon::parse($year.'-'.$month.'-01')->format('Y-m-d');
        $end = Carbon::parse($year.'-'.$month.'-01')->endOfMonth()->format('Y-m-d');
        $pqv = DB::select("select * from calculate_pqv('" . $distid . "', '" . $start . "', '" . $end . "')");

        if (!$pqv) {
            return 0;
        }
        
        return $pqv[0]->calculate_pqv;

    }

    public static function getTsa()
    {
        if (Auth::user()) {
            return Auth::user()->distid;
        } else {
            return "";
        }
    }

    public static function getRememberTokenForEvents()
    {
        if (Auth::check()) {
            return Auth::user()->remember_token;
        } else {
            return "";
        }
    }

    public function download()
    {
        return $this->hasOne('App\Models\UserDownload');
    }

    public function replicatedPreferences()
    {
        return $this->hasOne('App\Models\ReplicatedPreferences');
    }

    public function getIpayoutUser($user)
    {
        $ipayoutUser = DB::table('ipayout_user')->where('user_id', $user->id)->first();

        //create ipayoutUser if not exists
        if (!$ipayoutUser) {
            return IPayOut::createiPayoutUser($user);
        }

        return ['error' => 1, 'msg' => 'iPayout user exists'];
        
    }

    public function getPendingJoinOrderHash()
    {
        return DB::table('pre_order_items')
                ->whereIn('productid', [Product::ID_STANDBY_CLASS, Product::ID_COACH_CLASS, Product::ID_BUSINESS_CLASS, Product::ID_FIRST_CLASS])
                ->join('pre_orders', 'pre_orders.id', '=', 'pre_order_items.orderid')
                ->where('pre_orders.user_id', '=', $this->id)
                ->get(['orderhash']);
    }

    public function currentProduct()
    {
        return $this->belongsTo('App\Models\Product', 'current_product_id')->withDefault();;
    }

    public static function getCurrentProduct()
    {
        if (Auth::user()) {
            return Auth::user()->currentProduct->productname;
        } else {
            return "";
        }
    }

    public function getUserTree()
    {
        return $this->hasMany('App\Models\BucketTree', 'uid', 'id');
    }
}
