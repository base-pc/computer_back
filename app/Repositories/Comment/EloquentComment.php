<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Rate;

class EloquentComment implements CommentRepository
{
	private $model;

	public function __construct(Comment $model, Rate $rate)
	{
		$this->model = $model;
		$this->rate  = $rate;
	}
	public function store($user, $product_id, array $attributes, $rate)

	{
		$product = Product::findOrFail($product_id);

		$my_rate = $rate->where([
			'product_id' => $product_id,
			'user_id'    => $user->id,
		])->first();

		$this->model->comment_author = $user->fullname;
		$this->model->author_avatar  = $user->avatar;
		$this->model->product_id     = $product->id;

		if($my_rate)
		{
			$this->model->myrate         = $my_rate->rate;

		}

		$this->model->fill($attributes);

		$this->model->save();

	}

}

