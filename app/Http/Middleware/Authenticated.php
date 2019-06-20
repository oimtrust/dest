<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repositories\UserManagement\UserRepository;

class Authenticated
{
    /**
     * instance of UserRepository
     * @var UserRepository
     */
    private $userRepository;


    /**
     * Make new instance of AuthorizeMiddleware
     * @param UserRepository
     */
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        } else {
            return redirect(route('login'))->with(['status' => 'You are not logged in yet.', 'type' => 'danger']);
        }
    }
}
