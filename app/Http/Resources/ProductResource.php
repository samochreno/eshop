<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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
        $array = [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => Number::currency($this->price / 100),
            'quantity'    => $this->quantity,
            'href'        => route('product', $this->slug),
            'imageUrl'    => $this->imageUrl,
            'rating'      => (round($this->price / 0.31) % 5) + 1,
        ];

        return $array;
    }
}
