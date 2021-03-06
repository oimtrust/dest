<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthorizeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        // dd($roles);
        if (!Auth::check()) {
            Auth::logout();
            return redirect(route('login'))->with(['status' => 'You are not logged in yet.', 'type' => 'warning']);
        }

        $user   = Auth::user();
        if ($user->roles->count() > 0) {
            foreach ($roles as $key => $role) {
                if ($user->roles()->where('slug', $role)->exists()) {
                    return $next($request);
                }
            }
        }
        abort(403);
    }
}
