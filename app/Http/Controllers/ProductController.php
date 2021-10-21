<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRrequest;
use App\Repositories\Product\ProductRepository;

class ProductController extends Controller
{

    private $product;

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return $this->product->index();
    }

    public function show($product_id)
    {
        return $this->product->show($product_id);
    }

    public function store(ProductStoreRrequest $request, $product_id)
    {
        $user = auth()->user();
        $upload = $this->product->photo = $request->file('photo');

        return $this->product->store($user, $product_id, $request->all(), $upload);
    }

    public function update(Request $request, $product_id)
    {
        return $this->product->update($product_id, $request->all());

    }

    public function destroy($product_id)
    {
        $this->product->destroy($product_id);
    }

    public function search(Request $request)
    {
        return $this->product->search($request);
    }
}

