<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json(['ALL_CATEGORIES'=>$categories]);
    }

    public function show($id, Category $category)
    {
        $categories_with_products = $category->showCategory($id);

        return response()->json(['CATEGORIES_WITH_PRODUCRS'=>$categories_with_products]);
    }

    public function store(Request $request, Category $category)
    {

        $category->storeCategory($request->all());

        return response()->json(['MESSAGE'=> 'A category has been added']);
    }

    public function destroy($id, Category $category)
    {

        try {
            $category = (new CategoryService())->findById($id);
            $category->destroyCategory($id);
        }catch(ModelNotFoundException $exception){
            return response()->json(['MESSAGE' => $exception->getMessage()]);
        }

        return response()->json(['MESSAGE'=> 'A category has been deleted']);
    }
}
