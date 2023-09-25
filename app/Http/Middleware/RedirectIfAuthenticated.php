<?php

namespace App\Http\Middleware;

use Closure;
use App\Message\ResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // return redirect('/home');
            return Controller::sendError(null,ResponseMessage::$loginErrorMessage);
        }

        return $next($request);
    }
}
