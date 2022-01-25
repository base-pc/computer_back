<?php

namespace App\Services;

use App\Models\Product;
use Treestoneit\ShoppingCart\CartManager;

class CartService
{
    private $product, $cart;

    public function __construct(Product $product, CartManager $cart)
    {
        $this->product = $product;
        $this->cart    = $cart;
    }

    public function addToCart($user, $product_id)

    {

        $product  = $this->product->findOrFail($product_id);

        $quantity = 1;

        $this->cart->add($product, $quantity);

        $this->cart->attachTo($user);

    }

    public function getCartItems($user)
    {
        return $this->cart->loadUserCart($user)->getModel();
    }

    public function updateAmount($item_id, $quantity)
    {

        $item = $this->cart->content()->find($item_id);

        $this->cart->update($item->id, $item->quantity + $quantity);

    }

    public function deleteCartItem($item_id)
    {

        $item = $this->cart->content()->find($item_id);

        $this->cart->remove($item->id);

    }

    public function getSubtotal()
    {
        return $this->cart->subtotal();
    }

    public function getItemCounter()
    {
        return $this->cart->count();
    }
}

?>
