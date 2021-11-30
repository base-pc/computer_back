<?php

namespace App\Repositories\Product;

use App\Models\Category;
use App\Models\Product;
use App\Services\UploadService;


class EloquentProduct implements ProductRepository
{
	private $model;
	private $upload;

	public function __construct(Product $model, UploadService $upload)
	{
		$this->model  = $model;
		$this->upload = $upload;
	}

	public function index()
	{
		return $this->model->all();
	}

	public function show($product_id)
	{
		return $this->model->findOrFail($product_id)->with('comments')->get();
	}


	public function store($user, $category_id, array $attributes, $upload)
	{
		$category = Category::findOrFail($category_id);

		$this->upload->setDisk('products');
		$this->upload->setImage($upload);

		$this->model->user_id       = $user->id;
		$this->model->product_owner = $user->fullname;
		$this->model->category_id   = $category->id;
		$this->model->product_owner = $user->fullname;
		$this->model->photo_url     = $this->upload->getPhotoUrl();
		$this->model->photo_name    = $this->upload->getPhotoName();

		$this->model->fill($attributes);

		$this->model->saveOrFail();

	}

	public function update($product_id, array $attributes)
	{
		$product = $this->model->findOrFail($product_id);

		$product->update($attributes);
	}

	public function destroy($product_id)
	{
		$product = $this->model->findOrFail($product_id);

		$product->delete($product_id);
	}

	public function find($request)
	{
		$request = $this->model->search($request)->get();
	}

}
