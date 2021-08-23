<?php

namespace App\Http\Middleware;


use Closure;

use App\Helpers\ApiHelper;
use App\Models\Address;

use Log;

/**
 * Class CheckShoppingCartSetting
 * @package App\Http\Middleware
 */
class CheckShoppingCartStopSetting
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $response = ApiHelper::request('GET', '/affiliate/shopping-cart/setting', array());        
        $status = json_decode($response->getBody())->data;

        if (!$status->shopping_cart_maintenance){
            return redirect()->route('shopping-cart.my-cart');
        }
        return $next($request);
    }    
}
