<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Cart;

class CartController extends Controller
{
    use Cart;

    public function index()
    {
        request()->validate([
            'cart' => 'nullable|array'
        ]);

        return response($this->getCartDetails(request()->input('cart')));
    }
}
