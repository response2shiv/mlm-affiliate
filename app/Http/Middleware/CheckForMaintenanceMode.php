<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use \Closure;

class CheckForMaintenanceMode extends Middleware
{
    protected $except = [
    ];
}
