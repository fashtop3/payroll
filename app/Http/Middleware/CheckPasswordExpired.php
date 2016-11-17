<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckPasswordExpired
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
        $user = Auth::user();
        if(!($user->isRole('developer|ict')) && $user->expire < Carbon::now())
        {
            Session::flash('expired', 'Your account has expired, please contact ICT Department');
            Auth::logout();
            return redirect('login');
        }

        return $next($request);
    }
}
