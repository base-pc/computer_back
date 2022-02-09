<?php

namespace App\Repositories\Product;

use App\Models\Category;
use App\Models\Product;
use App\Services\UploadService;

class EloquentProduct implements ProductRepository
{
	private $model, $category, $upload;

	public function __construct(Product $model, Category $category, UploadService $upload)
	{
		$this->model    = $model;
		$this->category = $category;
		$this->upload   = $upload;
	}

	public function index()
	{
		return $this->model->all();
	}

	public function show($product_id)
	{
		$this->model->findOrFail($product_id);

		$product = $this->model->with('comments')
						 ->where('id', $product_id)
						 ->get();

		return $product;

	}

	public function random()
	{
		try{
			return $this->model->all()->random(9);
		}catch (\Exception $e){
			abort(404, 'Not enough product to display');
		}
	}

	public function store($user, $category_id, array $attributes, $upload)
	{
		$category = $this->category->findOrFail($category_id);

		$this->upload->setDisk('products/');
		$this->upload->setImage($upload, 400, 400);

		$this->model->user_id       = $user->id;
		$this->model->product_owner = $user->fullname;
		$this->model->category_id   = $category->id;
		$this->model->photo_url     = $this->upload->getPhotoUrl();

		$this->model->fill($attributes);

		$this->model->saveOrFail();
	}

	public function update($product_id, array $attributes, $upload)
	{
		$product = $this->model->findOrFail($product_id);

		if($upload)
		{
			$this->upload->setDisk('products/');
			$this->upload->setImage($upload, 400, 400);

			$product->photo_url = $this->upload->getPhotoUrl();
		}

		$product->update($attributes);
	}

	public function destroy($product_id)
	{
		$product = $this->model->findOrFail($product_id);

		$product->delete($product_id);
	}

	public function find($request)
	{
		return $request = $this->model->search($request)->get();
	}
}
