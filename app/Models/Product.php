<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Treestoneit\ShoppingCart\Buyable;
use Treestoneit\ShoppingCart\BuyableTrait;

class Product extends Model implements Buyable
{
    use HasFactory, Searchable, BuyableTrait ;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'product_owner',
        'fullname',
        'manufacturer',
        'price',
        'photo',
        'photo_url',
    ];

    protected $hidden = [
        'photo',
        'created_at',
        'updated_at'

    ];

    public function getBuyablePrice()
    {
        return $this->price;
    }

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

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
