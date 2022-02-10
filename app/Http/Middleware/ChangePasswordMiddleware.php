<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangePasswordMiddleware
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
        $row = DB::table('password_resets')
            ->where(['email' => $request->email, 'token' => $request->reset_token])
            ->exists();

        if(!$row)
        {
            return response()->json(['error'=> 'Token or email is incorrect'], 404);
        }

        return $next($request);
    }
}
