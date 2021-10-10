<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $category = Category::with('products')
            ->where('id', $id)
            ->get();

        return $category;
    }

    public function storeCategory(array $data)
    {
        $category = new Category;

        $category->fill($data);

        $category->save();
    }

    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();
    }
}
