<?php

namespace App\Repositories\Rate;

use App\Models\Rate;
use App\Services\RateService;

class EloquentRate implements RateRepository
{
	private $model, $rate;

	public function __construct(Rate $model, RateService $rate)
	{
		$this->model = $model;
		$this->rate = $rate;
	}

	public function store($user, $product_id, $rate)
	{
		$this->model->product_id = $product_id;
		$this->model->user_id  = $user->id;
		$this->model->rate     = $rate;

		$this->model->saveOrFail();

		$this->rate->calculateRate($product_id);
	}
}


?>
