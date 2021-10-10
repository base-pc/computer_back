<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->admin === true)
        {
            return $next($request);
        }
        elseif(auth()->user()->admin === false || null)
        {
            return response()
                ->json([
                    'WARNING'=> 'You are not authorized to perform this action'
                ]);
        }
    }
}
