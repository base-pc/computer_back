<?php

namespace App\Repositories\Category;

use App\Models\Category;

class EloquentCategory implements CategoryRepository
{
	private $model;

	public function __construct(Category $model)
	{
		$this->model = $model;
	}


	public function index()
	{
		return $this->model->all();
	}

	public function show($category_id)
	{
		$this->model->findOrFail($category_id);

		$category = $this->model->with('products')
						  ->where('id', $category_id)
						  ->get();

		return $category;
	}

	public function store($user, array $attributes)
	{

		$category = $this->model->fill($attributes);

		$category->saveOrFail();
	}

	public function showOpinions($category_id)
	{
		$this->model->findOrFail($category_id);

		$category = $this->model->with('products')
						  ->where('id', $product_id)
						  ->get();

		return $category;
	}

	public function destroy($category_id)
	{
		$category = $this->model->findOrFail($category_id);

		$category->delete($category_id);
	}
}

