<?php

namespace App\Traits;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Number;

trait Cart
{
    private function getCartDetails($items)
    {
        if ($items == null) {
            $items = [];
        }

        $details = [
            'items' => [],
            'total' => 0,
        ];

        foreach ($items as $productId => $quantity) {
            $product = Product::find($productId);

            $total = $quantity * $product->price;
            $details['total'] += $total;

            $details['items'][] = [
                'product'  => (new ProductResource($product))->resolve(),
                'quantity' => $quantity,
                'total'    => Number::currency($total / 100),
            ];
        }

        $details['total'] = Number::currency($details['total'] / 100);

        return $details;
    }
}
