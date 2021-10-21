<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepository;

class CategoryController extends Controller
{
    private $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return $this->category->index();
    }

    public function show($category_id)
    {
        return $this->category->show($category_id);
    }

    public function showOpinions($category_id)
    {
        return $this->category->showOpinions($category_id);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        return $this->category->store($user, $request->all());
    }

    public function destroy($category_id)
    {
        return $this->category->destroy($category_id);
    }
}
