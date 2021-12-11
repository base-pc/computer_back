<?php

namespace App\Services;

use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;
use App\Models\Product;

class CartService
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function storeItem($user, $product_id)
    {
        $product = $this->product->findOrFail($product_id);

        Cart::add($product_id, $product->name, $product->price, $product->quantity);

        Cart::store($user->id);

    }

    public function getUserItems($user)
    {
        $items = Cart::restore($user->id);

        return $items->content();

    }
}

?>
