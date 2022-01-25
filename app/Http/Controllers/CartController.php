<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    private $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function cartStore($product_id)
    {

        $user = auth()->user();

        $this->cart->addToCart($user, $product_id);

        return response()->json(['Dodano produkt do koszyka']);
    }

    public function getCart()
    {
        $user = auth()->user();

        $items = $this->cart->getCartItems($user);

        return $items;
    }

    public function getTotal()
    {
        $total = $this->cart->getSubtotal();

        return $total;

    }

}
