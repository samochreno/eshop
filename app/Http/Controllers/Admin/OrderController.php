<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    public function show()
    {
        return view('admin.orders', [
            'orders' => OrderResource::collection(Order::all())->resolve(),
        ]);
    }
}
