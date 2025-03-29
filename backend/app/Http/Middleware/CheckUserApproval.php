<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserApproval
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->is_approved) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Your account is pending approval.'], 403);
            }
            
            return redirect()->route('approval.pending');
        }

        return $next($request);
    }
} 