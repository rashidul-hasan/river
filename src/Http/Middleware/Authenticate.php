<?php

namespace Rashidul\River\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (count($guards)) {
            $auth = Auth::guard($guards[0])->check();
            if (!$auth) {
                return redirect(route('river.admin.login'));
            }
        }

        return $next($request);
    }
}
