<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Helpers\ApiHelper;
use GuzzleHttp\Client;
use Auth;
use App\Models\User;
use App\Helpers\Util;
use App\Models\UserSettings;
use Log;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    protected $service;
    /**
     * @var Client
     */
    protected $client;

    /**
     * AuthController constructor.
     * @param AuthService $service
     */
    public function __construct(AuthService $service)
    {
        $this->service = $service;
        $this->client = new Client();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        $page = 'login';

        return view('affiliates.login', compact('page'));
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function authenticate(LoginRequest $request)
    {
        $request->request->add(['current_ip'=> Util::get_client_ip()]);
        $login = $this->service->login($request->validated());
        if (isset($login->response_code) &&  $login->response_code != 200) {
            return redirect()->back()->withErrors(['errors' => $login->message]);
        } else {
            try {
                //Checking account status to redirect
                return $this->validateUserAuthStatus();
            } catch (\Exception $e) {
                //If fails redirect back to login
                return redirect()->back()->withErrors(['errors' => "This account has restricted access.  Please contact customer service at support@ncrease.com"]);
            }
        }
    }

    public function forgotPassword()
    {
        $form_params = [
            'distid' => request()->distid
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];

        $response = ApiHelper::request('POST', '/affiliate/forgot-password', $form_params, $headers);
        $response_data = json_decode($response->getBody());

        return response()->json($response_data);
    }

    public function frmResetPassword($token)
    {
        $type = 'reset-password';
        $page = 'login';

        return view('affiliates.login', compact('token', 'type', 'page'));
    }

    public function resetPassword()
    {

        $form_params = [
            'token'  => request()->token,
            'pass_1' => request()->pass_1,
            'pass_2' => request()->pass_2
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];

        $response      = ApiHelper::request('POST', '/affiliate/reset-password', $form_params, $headers);
        $response_data = json_decode($response->getBody());

        return response()->json($response_data);
    }

    public function frmChangePassword()
    {
        $type = 'change-password';

        return view('affiliates.change_password', compact('type'));
    }

    public function changePassword()
    {
        $form_params = [
            'current_pass' => request()->current_pass,
            'pass_1'       => request()->pass_1,
            'pass_2'       => request()->pass_2
        ];

        $response      = ApiHelper::request('POST', '/affiliate/user/change-password', $form_params);
        $response_data = json_decode($response->getBody());

        return response()->json($response_data);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->service->logout();

        return redirect()->route('login');
    }

    /**
     * Login as user from the admin panel
     */
    public function loginAsUser($distid, $token)
    {
        if ($this->service->loginSSO($distid, $token)) {
            //Checking account status to redirect
            // return $this->validateUserStatus();
            return redirect()->route('affiliates.dashboard.index');
        } else {
            return redirect('login')->withErrors(['errors' => "This account has restricted access.  Please contact customer service at support@ncrease.com"]);
        }
    }

    /**
     * Validate if user should have access to the portal
     */
    private function validateUserAuthStatus()
    {
        //Checking to see what status the account is

        if (Auth::user()->account_status === User::ACC_STATUS_APPROVED) {
            // session('show_notification', '1');
            return redirect()->route('affiliates.dashboard.index');
        }

        if (!isset(Auth::user()->account_status)) {
            return redirect()->back()->withErrors(['errors' => "This account has restricted access.  Please contact customer service at support@ncrease.com"]);
        }

        if (Auth::user()->account_status === User::ACC_STATUS_PENDING || Auth::user()->account_status === User::ACC_STATUS_PENDING_REVIEW || Auth::user()->account_status === User::ACC_STATUS_TERMINATED) {
            Auth::logout();
            return redirect()->back()->withErrors(['errors' => "This account has restricted access.  Please contact customer service at support@ncrease.com"]);
        }

        if (Auth::user()->account_status === User::ACC_STATUS_PENDING_APPROVAL) {
            Auth::logout();
            return redirect()->back()->withErrors(['errors' => 'Welcome to ncrease! Your order is still being processed, please try again later.']);
        }


        return parent::validateUserStatus();
    }
    /*public function loginAsUser($distid, $token) {
        Auth::logout();
        // session(['login_from_admin' => Auth::user()->id]);
        $userRec = User::getByDistId($distid);
        Log::info("User loaded", array($userRec));
        Auth::loginUsingId($userRec->id);

        $response = ApiHelper::request('GET','/affiliate/user/user-info', array());
        $response_data = json_decode($response->getBody());

        $data = $response_data->data;

        Log::info("User from API", array($data));
        $infoUserApi = [
            'user' => (object) [
                'firstname'          => $data->firstname,
                'lastname'           => $data->lastname,
                'profile_image_url'  => $data->profile_image_url
            ],
            'pv'   => $data->pv,
            'achieved_rank_desc' => $data->achieved_rank_desc,
        ];

        AuthService::storesUserData((object) $infoUserApi);
        return redirect('/');
    }*/
}
