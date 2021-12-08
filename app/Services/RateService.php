<?php

namespace App\Services;

use App\Models\Rate;
use App\Models\Product;

class RateService
{
    private $product, $rate;

    public function __construct(Product $product, Rate $rate)
    {
        $this->product = $product;
        $this->rate    = $rate;
    }

    public function calculateRate($product_id)
    {
        $times_rate = null;

        $product = $this->product->findOrFail($product_id);

        $total_ratings = $this->rate->where('product_id', $product_id)->count('rate');

        for($i=0; $i<=5; ++$i)
        {

            $rates = $this->rate->where([
                'product_id' => $product_id,
                'rate'     => $i
            ])->count();


            $assoc_rates = array($i=>$rates);

            foreach($assoc_rates as $x => $x_value)
            {
                $multi[$i]    = $x*$x_value;
                $times_rate  += $x_value;
            }
        }

        $multisum = array_sum($multi);

        $product_rate = fdiv($multisum,$times_rate);

        $product->rate       = $product_rate;
        $product->rates_time = $total_ratings;

        $product->update();
    }
}

?>
