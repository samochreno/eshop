<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;
use Illuminate\Support\Number;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $shipping = $this->price / 100 / 175;
        if ($shipping > 10) {
            $shipping = 0;
        }

        $array = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => Number::currency($this->price / 100),
            'quantity' => $this->quantity,
        ];

        $shipping = $this->price / 100 / 175;
        if ($shipping < 10) {
            $array['shipping'] = Number::currency($shipping);
        }

        return $array;
    }
}
