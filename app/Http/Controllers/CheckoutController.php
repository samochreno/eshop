<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\Cart;
use NumberFormatter;

class CheckoutController extends Controller
{
    use Cart;

    public function show()
    {
        return view('checkout');
    }

    public function order()
    {
        if (!request()->has('email') && !auth()->check()) {
            return redirect()->back()->withErrors(['Email is required when not signed in.']);
        }

        request()->validate([
            'cart'      => 'required|json',
            'email'     => 'sometimes|email|min:5|max:255',
            'address'   => 'required|string|min:1|max:255',
            'city'      => 'required|string|min:1|max:255',
            'region'    => 'required|string|min:1|max:255',
            'zip'       => 'required|string|min:1|max:255',
        ]);

        $cart = $this->getCartDetails(json_decode(request()->input('cart')));

        $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        $total = $fmt->parseCurrency($cart['total'], $currency) * 100;

        $order = Order::create([
            'email'   => auth()->check() ? auth()->user()->email : request()->input('email'),
            'address' => request()->input('address'),
            'city'    => request()->input('city'),
            'region'  => request()->input('region'),
            'zip'     => request()->input('zip'),
            'total'   => $total,
        ]);

        foreach ($cart['items'] as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product']['id'],
                'quantity'   => $item['quantity'],
            ]);
        }

        return view('ordered');
    }
}
