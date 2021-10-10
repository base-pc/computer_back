<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\UploadService;
use Illuminate\Support\Facades\Storage;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Search;

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
        $product = Product::with('comments')
            ->where('id', $id)
            ->get();

        return $product;
    }

    public function storeProduct(User $user, array $data, $upload, $id)
    {
        $product  = new Product;
        $photo    = new UploadService;

        try {
            $check_id = Category::where('id', $id)->first();
        } catch(\Illuminate\Database\QueryException $exception) {
            //return response()->json(['Category not found']);
            dd('category not found');
        }

        //$check_id = Category::findOrFail($id);

        $photo->setImage($upload);

        $product->user_id       = $user->id;
        $product->category_id   = $id;
        $product->product_owner = $user->fullname;
        $product->photo_url     = $photo->getPhotoUrl();
        $product->photo_name    = $photo->getPhotoName();

        $product->fill($data);


        $product->save();
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
    }

    public function updateProduct($id, array $data, $upload)
    {
        $product = Product::findOrFail($id);
        $photo = new UploadService;

        if($upload)
        {
            $photo->setImage($upload);

            Storage::disk('products')->delete($product->photo_name);

            $product->photo_url  = $photo->getPhotoUrl();
            $product->photo_name = $photo->getPhotoName();

            $product->update($data);

        }else {
            $product->update($data);
        }
    }

    public function performSearch ($request)
    {
        $searchResults = (new Search())
            ->registerModel(Product::class, [
                'name',
                'manufacturer',
                'price',
                'quantity',
            ])
            ->perform($request->get('search'));

        return $searchResults;
    }


}
