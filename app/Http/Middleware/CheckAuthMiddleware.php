<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Nếu người dùng chưa đăng nhập, chuyển hướng đến signupPage
            return redirect()->route('user_client');
        }

        return $next($request);
    }
}
