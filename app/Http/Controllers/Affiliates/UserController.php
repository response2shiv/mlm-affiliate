<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ReplicatedPreferences;
use App\Models\ApiToken;
use App\Models\UserRankHistory;
use App\Models\User;

class UserController extends Controller
{
    //Function to provide user information to the replicated sites
    public function getUserInfo()
    {
        $request = request();

        $token = $request->header('ibuumerang-token');
        if (!$token) {
            return response()->json(['error' => 1, 'msg' => 'Token not found.']);
        }

        $isValid = ApiToken::isValidToken($token);

        if (!$isValid) {
            return response()->json(['error' => 1, 'msg' => 'Invalid token.']);
        }

        $username = $request->input('username');

        $user = User::where('username', $username)
            ->where('account_status', User::ACC_STATUS_APPROVED)
            ->first();

        if (!$user) {
            return response()->json();
        }

        $rank = UserRankHistory::getCurrentMonthUserInfo($user->id);

        if ($user) {
            $preferences = $user->replicatedPreferences;
            $name = $user->firstname . ' ' . $user->lastname;

            if ($preferences) {
                switch ($preferences->show_name) {
                    case ReplicatedPreferences::TYPE_DISPLAYED:
                        $name = $preferences->displayed_name;
                        break;
                    case ReplicatedPreferences::TYPE_CO_NAME:
                        $name = $preferences->co_name;
                        break;
                    case ReplicatedPreferences::TYPE_BUSINESS:
                        $name = $preferences->business_name;
                        break;
                }
            }

            $name = $name ?: $user->firstname . ' ' . $user->lastname;
            $email = $user->email;
            $phone = $user->phonenumber;

            if ($preferences) {
                if (!$preferences->show_email) {
                    $email = '';
                } elseif ($preferences->email) {
                    $email = $preferences->email;
                }

                if (!$preferences->show_phone) {
                    $phone = '';
                } elseif ($preferences->phone) {
                    $phone = $preferences->phone;
                }
            }

            return response()->json([
                'username' => $name,
                'rank' => $rank ? $rank->achieved_rank_desc : 'Ambassador',
                'phone' => $phone,
                'email' => $email,
            ]);
        }

        return response()->json();
    }
}
