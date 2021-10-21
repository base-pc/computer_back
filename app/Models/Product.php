<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
