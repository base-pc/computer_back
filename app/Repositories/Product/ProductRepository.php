<?php

namespace App\Repositories\Product;


interface ProductRepository
{
	public function index();

	public function show($product_id);

	public function store($user, $product_id, array $attributes, $upload);

	public function update($product_id, array $attributes);

	public function destroy($product_id);

	public function find($request);

}

?>
