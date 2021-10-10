<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchProductRequest;
use App\Models\Product;

class SearchController extends Controller

{
    public function search (Product $product, SearchProductRequest $request)
    {
        $searchResults = $product->performSearch($request);

        return response()->json(['Result' => $searchResults], 200, [],JSON_UNESCAPED_SLASHES);
    }
}

