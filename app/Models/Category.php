<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'iconu_url',
        'icon_name'
    ];

    protected $hidden = [
        'icon',
        'icon_name',
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

}

