<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductPreviewResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function showAll()
    {
        return view('products', [
            'products' => (ProductPreviewResource::collection(Product::all())->resolve()),
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('product', [
            'product' => (object)(new ProductResource($product))->resolve(),
        ]);
    }

    public function getAll()
    {
    }
}
