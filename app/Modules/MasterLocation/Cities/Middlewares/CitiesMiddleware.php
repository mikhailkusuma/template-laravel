<?php

namespace App\Modules\MasterLocation\Cities\Middlewares;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CitiesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the current guard is valid
        if (Auth::guard('web')->user() == null) {
            Session::put('url.intended', $request->fullUrl());
            return redirect()->route('authentication.login_index')
                ->withErrors(["errors" => ["Autentikasi Tidak Valid"]]);
        }

        // Retrieve the current logged-in user's level
        $currentUserLoggedIn = Auth::guard('web')->user()->email;

        $user = User::where('email', $currentUserLoggedIn)->first();
        // Check if the user's level is in the allowed levels
        if (!$user) {
            abort(403, 'Unauthorized access');
        }

        // If user has a valid level, allow the request to proceed
        return $next($request);
    }
}
