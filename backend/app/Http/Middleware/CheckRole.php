<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated
        if (!$request->user()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated',
            ], Response::HTTP_UNAUTHORIZED);
            
        }

        // Check if user has the required role
        if ($request->user()->role->value !== $role) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to access this resource',
                'required_role' => $role,
                'current_role' => $request->user()->role
            ], Response::HTTP_FORBIDDEN); // 403
        }
        return $next($request);
    }
}
