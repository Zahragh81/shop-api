<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    use ApiResponse;

    public function handle(Request $request, Closure $next, $permission): Response
    {
        $user = auth()->user();
        $role = $user->role; // بازیابی نقش کاربر

        if (!$role->hasPermission($permission)) {
            return $this->errorResponse('not permission user!', 403);
        }

        return $next($request);
    }


//    public function handle(Request $request, Closure $next, $permission): Response
//    {
//        if (!auth()->user()->role()->hasPermission($permission))
//        {
//            return $this->errorResponse('not permission user!', 403);
//        }
//        return $next($request);
//    }
}
