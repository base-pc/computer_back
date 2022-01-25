<?php

namespace App\Http\Controllers;

use App\Repositories\Cart\CartRepository;
use App\Http\Requests\CartRequest;

class CartController extends Controller
{
    private $cart;

    public function __construct(CartRepository $cart)
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
        $user  = auth()->user();

        $items = $this->cart->getCartItems($user);

        return $items;
    }

    public function updateQuantity($item_id, CartRequest $request)
    {
        $this->cart->updateAmount($item_id, $request->get('quantity'));

        return response()->json(['Cart item has been updated']);
    }

    public function destroy($item_id)
    {
        $this->cart->deleteCartItem($item_id);

        return response()->json(['Cart item has been deleted']);

    }

    public function destroyCart()
    {
        $this->cart->deleteCart();

        return response()->json(['Cart has been destroyed']);
    }

    public function getTotal()
    {
        $total = $this->cart->getSubtotal();

        return $total;

    }

    public function getCounter()
    {
        $counter = $this->cart->getItemCounter();

        return $counter;
    }

}
