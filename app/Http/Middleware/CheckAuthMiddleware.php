<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckAuthMiddleware
{
    public function handle(Request $request, Closure $next,$role)
    {   
        if (!Auth::check()) {
            return redirect()->to('/');
        }
        
        elseif (Auth::user()->role == $role) {
            abort(401,$role);
            // Nếu vai trò của người dùng khớp với $role được truyền vào, chuyển hướng hoặc phản hồi tùy ý của bạn.
        }
        
        else{

            return $next($request);
        }

    }
}
