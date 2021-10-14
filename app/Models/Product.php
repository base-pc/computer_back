<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ProductService;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Product extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'product_owner',
        'fullname',
        'manufacturer',
        'price',
        'quantity',
        'photo',
        'photo_name',
        'photo_url',
    ];

    protected $hidden = [
        'photo',
        'photo_name',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
        );
    }

    public function showProduct($id)
    {
        $product = new ProductService;

        return $product->showProductById($id);
    }

    public function storeProduct(User $user, array $data, $upload, $id)
    {

        $product = new ProductService;

        $product->storeMyProduct($user, $data, $upload, $id);
    }

    public function destroyProduct($id)
    {
        $product = new ProductService;

        $product->destroyMyProduct($id);
    }

    public function updateProduct($id, array $data, $upload)
    {

        $product = new ProductService;

        $product->updateMyProduct($id, $data, $upload);

    }

    public function performSearch ($request)
    {
        $product = new ProductService;

        return $product->searchProduct($request);

    }


}
