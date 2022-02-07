<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Comment;

class HasCommentedMiddleware
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
        $user = auth()->user();
        $id = $request->route('product_id');

        $hasComment = Comment::where([
            'comment_author' => $user->fullname,
            'product_id'     => $id
        ])->exists();

        if($hasComment)
        {
            abort(403, 'You commented this product before');
        }

        return $next($request);


    }
}
