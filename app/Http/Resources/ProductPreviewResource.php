<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;

class ProductPreviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'url' => route('product', $this->slug),
            'name' => $this->name,
            'category' => Category::find($this->category_id)->name,
            'price' => '$'.number_format($this->price / 100, 2),
        ];
    }
}
