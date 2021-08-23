<?php

namespace App\Http\View\Composers;

use Cache;
use Illuminate\View\View;
use App\Helpers\ApiHelper;
use Auth;

class HeaderFoundationComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $view->with('dashboard', $this->getSubscriptionData());
    }


   /**
     * @return array
     */
    private function getSubscriptionData(): array
    {

        $data['subscription']['creditCards'] = [];
        return $data;

        $country_code = Auth::user()->getConversionCountry();

        $res = ApiHelper::request(
            'GET',
            '/affiliate/subscription/index/'.$country_code.'/',
            []
        );

        $subscription = json_decode($res->getBody())->data;

        foreach ($subscription->payment_method as $creditCard) {
            $data['subscription']['creditCards'][] = [
                'id' => $creditCard->id,
                'paymentMethodName' => $creditCard->paymentMethodName
            ];
        }

        return $data;
    }
}
