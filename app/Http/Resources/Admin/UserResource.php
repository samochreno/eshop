<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->uuid,
            'isAdmin'   => $this->is_admin,
            'email'     => $this->email,
            'firstName' => $this->first_name,
            'lastName'  => $this->last_name,
        ];
    }
}
