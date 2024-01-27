<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserStatus;
use App\Http\Controllers\PostController;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!Auth::check()){
            return $next($request);
        }

        $check = true;
        $user = Auth::user();
        $message = "";

        if ($user->status == UserStatus::PENDING) {
            $check = false;
            $message = "Account has not been approved";
        }
        else  if ($user->status == UserStatus::DENIED) {
            $check = false;
            $message = "Account rejected";
        }
        else  if ($user->status == UserStatus::LOCKED) {
            $check = false;
            $message = "Account locked";
        }
        if($check) {
            return $next($request);
        }

        Auth::logout();
        return redirect()->route("login")->with("message", $message);

    }
    
}
