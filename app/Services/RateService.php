<?php

namespace App\Services;

use App\Models\Rate;
use App\Models\Product;

class RateService
{
    public function calculateRate($product_id)
    {
        $times_rate = null;

        $stall = Product::findOrFail($product_id);

        $total_ratings = Rate::where('product_id', $product_id)->count('rate');

        for($i=0; $i<=5; ++$i)
        {

            $rates = Rate::where([
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

        $stall_rate = fdiv($multisum,$times_rate);

        $stall->rate       = $stall_rate;
        $stall->rates_time = $total_ratings;

        $stall->update();
    }
}


?>
