<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserStatus;

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
            $message = "Tài khoản chưa đc phê duyệt";
        }
        else  if ($user->status == UserStatus::DENIED) {
            $check = false;
            $message = "Tài khoản bị từ chối";
        }
        else  if ($user->status == UserStatus::LOCKED) {
            $check = false;
            $message = "Tài khoản bị khoá";
        }
        if($check) {
            return $next($request);
        }

        Auth::logout();
        return redirect()->route("login")->with("message", $message);

    }
    
}
