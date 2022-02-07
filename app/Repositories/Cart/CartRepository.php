<?php

namespace App\Repositories\Cart;

interface CartRepository
{
	public function addToCart($user, $product_id);

	public function getCartItems($user);

	public function updateAmount($item_id, $quantity);

	public function deleteCartItem($item_id);

	public function deleteCart();

	public function getSubtotal();

	public function getItemCounter();
}

?>
