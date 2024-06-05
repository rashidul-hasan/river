<?php

namespace BitPixel\SpringCms\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use BitPixel\SpringCms\Constants;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            $auth = Auth::guard($guard)->check();
            if ($auth) {
                if ($guard == Constants::AUTH_GUARD_ADMINS) {
                    return redirect(route('river.admin.dashboard'));
                }
                if ($guard == Constants::AUTH_GUARD_CUSTOMERS) {
                    return redirect('/');
                }
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
