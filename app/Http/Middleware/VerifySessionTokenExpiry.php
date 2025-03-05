<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session; // Import Session
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class VerifySessionTokenExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if session has auth_token
        if (!session()->has('auth_token')) {
            return redirect('/login')->withErrors('status', 'Session expired. Please log in again.');
        }

        // Decode token (assuming Sanctum token)
        $token = session('auth_token');
        $tokenParts = explode('|', $token);
        $tokenId = $tokenParts[0] ?? null;

        if (!$tokenId) {
            return redirect('/login')->withErrors('status', 'Invalid token. Please log in again.');
        }

        $tokenRecord = \Laravel\Sanctum\PersonalAccessToken::find($tokenId);

        if (!$tokenRecord || Carbon::parse($tokenRecord->expires_at)->isPast()) {
            session()->forget('auth_token');
            return redirect('/login')->withErrors('status', 'Session expired. Please log in again.');
        }
        
        return $next($request);
    }
}
