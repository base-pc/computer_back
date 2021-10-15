<?php

namespace App\Services;

use App\Models\Product;
use App\Services\UploadService;
use Illuminate\Support\Facades\Storage;
use Spatie\Searchable\Search;
use App\Models\Category;

class ProductService
{


    public function showProductById($id)
    {
        $product = Product::with('comments')
            ->where('id', $id)
            ->get();

        return $product;

    }

    public function storeMyProduct($user, array $data, $upload, $id)
    {
        $product  = new Product;
        $photo    = new UploadService;

        $category = Category::findOrFail($id);

        $photo->setImage($upload);

        $product->user_id       = $user->id;
        $product->category_id   = $id;
        $product->product_owner = $user->fullname;
        $product->photo_url     = $photo->getPhotoUrl();
        $product->photo_name    = $photo->getPhotoName();

        $product->fill($data);

        $product->save();
    }

    public function updateMyProduct($id, array $data, $upload)
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

    public function destroyMyProduct($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
    }

    public function searchProduct($request)
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









?>
