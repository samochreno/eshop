<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->uuid,
            'email'   => $this->email,
            'address' => $this->address,
            'city'    => $this->city,
            'region'  => $this->region,
            'zip'     => $this->zip,
            'total'   => Number::currency($this->total / 100),
            'items'   => join("\n", $this->items->map(function ($item) {
                return $item->quantity .'x '.$item->product->name;
            })->values()->toArray()),
        ];
    }
}
