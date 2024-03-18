<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'email',
        'address',
        'city',
        'region',
        'zip',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
