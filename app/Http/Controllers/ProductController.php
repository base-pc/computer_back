<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductStoreRrequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\CategoryService;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response()
            ->json([
                'ALL_PRODUCTS'=>$products
            ], 200, [], JSON_UNESCAPED_SLASHES);

    }

    public function show($id, Product $product)
    {
        $product_with_comments = $product->showProduct($id);

        return response()
            ->json([
                'PRODUCT_WITH_COMMENTS'=> $product_with_comments
            ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function showMyProducts()
    {
        $user = auth()->user();
        $my_products = $user->products()->get();

        return response()
            ->json([
                'MY_PRODUCTS'=> $my_products
            ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function store(ProductStoreRrequest $request, Product $product, $id)
    {
        $user = auth()->user();
        $upload = $product->photo = $request->file('photo');

        try {
            $category = (new CategoryService())->findById($id);
            $product->storeProduct($user, $request->all(), $upload, $id);
        }catch(ModelNotFoundException $exception){
            return response()->json(['MESSAGE'=> $exception->getMessage()]);
        }

        return response()->json(['MESSAGE'=>'A product has been added']);
    }

    public function destroy($id, Product $product)
    {

        try {
            $product = (new ProductService())->findById($id);
            $product->destroyProduct($id);

        }catch(ModelNotFoundException $exception){
            return response()->json(['MESSAGE'=> $exception->getMessage()]);
        }

        return response()->json(['MESSAGE'=>'A product has been deleted']);
    }

    public function update($id, Request $request, Product $product)
    {
        $upload = $product->photo = $request->file('photo');

        try {
            $product = (new ProductService())->findById($id);
            $product->updateProduct($id, $request->all(), $upload);
        }catch(ModelNotFoundException $exception){
            return response()->json(['MESSAGE'=> $exception->getMessage()]);
        }

        return response()->json(['MESSAGE'=>'A product has been updated']);
    }

}
