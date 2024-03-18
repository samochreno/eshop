<?php

namespace App\Http\Resources\Admin;

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
        return [
            'id'          => $this->uuid,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => Number::currency($this->price / 100),
            'quantity'    => $this->quantity,
            'href'        => route('product', $this->slug),
            'imageUrl'    => $this->imageUrl,
        ];
    }
}
