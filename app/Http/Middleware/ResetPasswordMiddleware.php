<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ResetPasswordMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $verify =  User::where([
            'email'       => $request->email,
            'social_user' => false,
        ])->exists();

        if(!$verify)
        {
            return response()->json(['error' => 'Email is invalid'], 404);
        }


        return $next($request);
    }
}
