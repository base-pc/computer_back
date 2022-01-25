<?php

namespace App\Services;

use App\Models\Product;
use Treestoneit\ShoppingCart\CartManager;

class CartService
{
    private $product;
    private $cart;

    public function __construct(Product $product, CartManager $cart)
    {
        $this->product = $product;
        $this->cart    = $cart;
    }

    public function addToCart($user, $product_id)

    {

        $product  = $this->product->findOrFail($product_id);

        $quantity = 2;

        $this->cart->add($product, $quantity);

        $this->cart->attachTo($user);

    }

    public function getCartItems($user)
    {
        return $this->cart->loadUserCart($user)->getModel();
    }

    public function getSubtotal()
    {
        return $this->cart->subtotal();
    }

}

?>
