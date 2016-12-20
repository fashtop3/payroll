<?php

namespace App\Http\Middleware;

use App\AppKey;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class License
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!AppKey::access()) {
            Session::flash('expired', 'Access denied! Contact the Administrator.');
            Auth::logout();
            return redirect('login');
        }

        return $next($request);
    }
}
