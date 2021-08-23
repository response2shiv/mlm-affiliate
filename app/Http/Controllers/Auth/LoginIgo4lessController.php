<?php
namespace App\Http\Controllers\Auth;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Auth;
use App\Helpers\SOR;

class LoginIgo4lessController
{

    /**
     * @var AuthService
     */
    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request)
    {

        $login = $this->service->login([
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'remember' => false
        ]);

        if (isset($login->response_code) &&  $login->response_code != 200) {
            return response()->json(['status' => 'error', 'msg' => $login->message]);
        } else {
            $user = Auth::user();
            $currentProductId = $user->current_product_id;
            if ($currentProductId == 13) {
                $currentProductId = 4;
            }
            if ($currentProductId == 14) {
                $currentProductId = 3;
            }

            $endPoint = config('api_endpoints.SORGetLoginToken');
            $saveOnAPI = new SOR($currentProductId);
            $postData = array(
                "ContractNumber" => $user->distid
            );
            try {
                $responseBody = $saveOnAPI->_post($endPoint, $postData, false);
            } catch (\Exception $exception) {
                $responseBody = (string) $exception->getResponse()->getBody(true);
            }
            if (strpos($responseBody, "LoginToken") !== false) {
                $token = str_replace("LoginToken:", "", $responseBody);
                $token = str_replace('"', '', $token);
                $url = 'https://members.igo4less.com/vacationclub/logincheck.aspx?Token=' . $token;
                return response()->json(['status' => 'success', 'url' => $url]);
            } else {
                return response()->json(['status' => 'error', 'msg' => $responseBody]);
            }
        }
    }
}
