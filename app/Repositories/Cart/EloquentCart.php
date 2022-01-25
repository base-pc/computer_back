<?php

namespace App\Repositories\Cart;

use App\Models\Product;
use Treestoneit\ShoppingCart\CartManager;

class EloquentCart implements CartRepository
{
	private $model, $product;

	public function __construct(CartManager $model, Product $product)
	{
		$this->model   = $model;
		$this->product = $product;
	}

	public function addToCart($user, $product_id)

	{
		$product  = $this->product->findOrFail($product_id);

		$quantity = 1;

		$this->model->add($product, $quantity);

		$this->model->attachTo($user);
	}

	public function getCartItems($user)
	{
		return $this->model->loadUserCart($user)->getModel();
	}

	public function updateAmount($item_id, $quantity)
	{
		$item = $this->model->content()->find($item_id);

		$this->model->update($item->id, $item->quantity + $quantity);
	}

	public function deleteCartItem($item_id)
	{
		$item = $this->model->content()->find($item_id);

		$this->model->remove($item->id);
	}

	public function deleteCart()
	{
		$this->model->destroy();
	}

	public function getSubtotal()
	{
		return $this->model->subtotal();
	}

	public function getItemCounter()
	{
		return $this->model->count();
	}

}

?>
