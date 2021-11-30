<?php

namespace App\Http\Controllers;

use App\Repositories\Rate\RateRepository;
use App\Http\Requests\StoreRateRequest;

class RateController extends Controller
{
    private $rate;

    public function __construct(RateRepository $rate)
    {
        $this->rate = $rate;
    }

    public function store(StoreRateRequest $request, $product_id)
    {
        $user = auth()->user();

        $this->rate->store($user, $product_id, $request->rate);

        return response()->json(['message'=>'You rated']);

    }
}

