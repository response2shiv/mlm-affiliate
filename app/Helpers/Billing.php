<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Serializer;

class Billing
{
    private const PROCESS_API_URL = 'v1/api/user/customers/create-payment-method';

    public function __construct()
    {
    }

    public static function iPayTotal($addressInfo, $cardInfo)
    {
        $baseUrl = env('BILLING_BASE_URL');
        $apiToken = env('BILLING_API_TOKEN');

        $user = \Auth::user();

        $client = new Client();
        $baseUrl = 'https://' . $baseUrl . '/';


        $cardInfo['number'] = str_replace(' ', '', $cardInfo['number']);

        try {
            $result = $client->post($baseUrl . self::PROCESS_API_URL, [
                'form_params' => [
                    'email' => $user->email,
                    'first_name' => $cardInfo['last_name'],
                    'last_name' => $cardInfo['first_name'],
                    'address1' => $addressInfo['address1'],
                    'address2' =>  $addressInfo['address1'],
                    'city' => $addressInfo['city'],
                    'state' => $addressInfo['stateprov'],
                    'zip' => $addressInfo['postalcode'],
                    'country' => $addressInfo['countrycode'],
                    'phone' => $user->phonenumber ?? $user->mobilenumber,
                    'card_number' => trim($cardInfo['number']),                    
                    'expiration_year' => substr($cardInfo['expiry_date'], -4),
                    'expiration_month' => substr($cardInfo['expiry_date'], 0, 2)
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiToken,
                    'timeout' => 60
                ]
            ]);

            $responseJson = $result->getBody()->getContents();
            return json_decode($responseJson, true);
        } catch (Exception $e) {
            return $e;
        }
    }
}
