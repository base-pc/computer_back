<?php

namespace App\Http\Controllers;

use App\Services\CartService;

class CartController extends Controller
{

    private $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function add($product_id)
    {

        $user = auth()->user();

        $this->cart->storeItem($user, $product_id);
    }

    public function getItems()
    {
        $user = auth()->user();

        return $this->cart->getUserItems($user);
    }
}
