<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Services\UploadService;

class EloquentCategory implements CategoryRepository
{
	private $model;

	public function __construct(Category $model, UploadService $upload)
	{
		$this->model  = $model;
		$this->upload = $upload;
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

	public function store($user, array $attributes, $upload)
	{
		$this->upload->setDisk('categories');
		$this->upload->setImage($upload);

		$this->model->icon_url  = $this->upload->getPhotoUrl();

		$category = $this->model->fill($attributes);

		$category->saveOrFail();
	}


	public function destroy($category_id)
	{
		$category = $this->model->findOrFail($category_id);

		$category->delete($category_id);
	}
}

