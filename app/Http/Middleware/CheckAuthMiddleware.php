<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->to('/');
        }
        $user = Auth::user();
        $currentRoute = Route::currentRouteName();
        if ($user->role == 1 && $currentRoute != 'admin') {
            if ($currentRoute != 'index') {
                return $next($request);
            } else {
                return redirect()->route('user_client');
            }
        } elseif ($user->role == 0) {
            // Nếu user có role là 0 và đường dẫn không thuộc user_client
            if ($currentRoute != 'user_client') {
                return $next($request);
            } else {
                // Nếu không, chuyển hướng đến index
                return redirect()->route('index');
            }
        }
    }
}
