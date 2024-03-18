<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function show()
    {
        $products = Product::latest()->get();

        return view('admin.products', [
            'products' => ProductResource::collection($products)->resolve(),
        ]);
    }

    public function create()
    {
        request()->validate([
            'name'        => 'required|string|min:1|max:255',
            'description' => 'required|string|min:1|max:8192',
            'price'       => 'required|string',
            'image'       => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $price = preg_replace('/[^0-9.]/', '', request('price'));
        if (strlen($price) == 0) {
            return redirect()->back()->withErrors(['Price must be a number.']);
        }

        $price = floatval($price) * 100;

        $imagePath = request('image')->storeAs(
            'public/uploads/',
            Str::uuid().'.'.request('image')->extension()
        );
        $imagePath = '/storage/'.substr($imagePath, 7);
        $imagePath = str_replace('//', '/', $imagePath);

        Product::create([
            'name'        => request('name'),
            'description' => request('description'),
            'price'       => $price,
            'imageUrl'    => $imagePath,
        ]);

        return redirect()->route('admin.products');
    }

    public function delete()
    {
        $product = Product::where('uuid', request('id'));
        if (!$product) {
            abort(404);
        }

        $product->delete();

        return redirect()->route('admin.products');
    }
}
