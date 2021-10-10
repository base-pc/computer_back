<?php

namespace App\Services;

use App\Models\Product;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductService
{
    public function findById($id)
    {
        $product = Product::where('id', $id)->first();

        if(!$product){
            throw new ModelNotFoundException('Product not found by id');
        }
        return $product;
    }
}









?>
