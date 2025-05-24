<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bu sayfaya erişmek için giriş yapmalısınız.');
        }

        $user = Auth::user();
        
        // Check if user has admin role or is_admin flag
        if (!$user->is_admin && !$user->hasRole('admin')) {
            return redirect()->route('home')->with('error', 'Bu sayfaya erişim yetkiniz bulunmamaktadır.');
        }

        // Check for specific permissions if route has permission requirement
        if ($request->route()->hasParameter('permission')) {
            $requiredPermission = $request->route()->parameter('permission');
            if (!$user->hasPermission($requiredPermission)) {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Bu işlem için gerekli yetkiye sahip değilsiniz.');
            }
        }

        return $next($request);
    }
}
