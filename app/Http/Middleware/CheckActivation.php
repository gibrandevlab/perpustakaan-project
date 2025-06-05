<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CheckActivation
{
    public function handle(Request $request, Closure $next)
    {
        // Middleware ini dinonaktifkan, aplikasi bebas aktivasi
        return $next($request);
    }
}
