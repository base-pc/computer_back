<?php

namespace App\Repositories\Rate;

interface RateRepository
{
	public function store($user, $product_id, $rate);
}



?>
