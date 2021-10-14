<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\CategoryService;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function showCategory($id)
    {
        $category = new CategoryService;

        $category->ShowCategoryById($id);
    }

    public function storeCategory(array $data)
    {
        $category = new CategoryService;

        $category->storeMyCategory($data);

    }

    public function destroyCategory($id)
    {
        $category = new CategoryService;

        $category->destroyMyCategory($id);

    }
}
