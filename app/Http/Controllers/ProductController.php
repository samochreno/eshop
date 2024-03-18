<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function showAll()
    {
        $products = Product::latest()->get();

        return view('products', [
            'products' => (ProductResource::collection($products)->resolve()),
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('product', [
            'product' => (object)(new ProductResource($product))->resolve(),
        ]);
    }
}
