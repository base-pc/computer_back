<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Treestoneit\ShoppingCart\CartManager;


class CartItemMiddleware
{
    private $cart;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function __construct(CartManager $cart)
    {
        $this->cart = $cart;

    }

    public function handle(Request $request, Closure $next)
    {
        $item_id = $request->route('item_id');

        if($this->cart->content()->contains($item_id))
        {
            return $next($request);
        }else
        {
            abort(404, 'Item not found');
        }
    }
}
