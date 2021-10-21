<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Models\Product;

class EloquentComment implements CommentRepository
{
	private $model;

	public function __construct(Comment $model)
	{
		$this->model = $model;
	}

	public function store($user, $product_id, array $attributes)
	{
		$product = Product::findOrFail($product_id);

		$this->model->comment_author = $user->fullname;
		$this->model->author_avatar  = $user->avatar;
		$this->model->product_id     = $product->id;

		$this->model->fill($attributes);

		$this->model->save();

	}
}


