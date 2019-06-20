<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPrevilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $object)
    {
        if (Auth::user()->hasAccess($permission, $object)) {
            return $next($request);
        } else {
            return redirect(route('home'))->with(['status' => 'You do not have access \''. $permission . ' - ' . $object . '\'.', 'type' => 'danger']);
        }
    }
}
