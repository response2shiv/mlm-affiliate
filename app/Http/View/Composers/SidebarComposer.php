<?php

namespace App\Http\View\Composers;

use Cache;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $user = [
            'first_name' => Cache::get('first_name'),
            'last_name' => Cache::get('last_name'),
            'pv' => Cache::get('pv'),
            'rank' => Cache::get('rank')
        ];

        $view->with('user', $user);
    }
}
