@extends('layout')

@section('content')

<div class="cn fullscreen flex">
    <div class="h-full flex">
        <div class="w-[unset] aspect-square h-full bg-tertiary rounded-xl"></div>
        <div class="flex-grow h-full ml-12 flex flex-col">
            <div class="flex-grow">
                <h1 class="text-left text-xl font-semibold">{{ $product->name }}</h1>
                <p class="my-6 text-md">{{ $product->description }}</p>
            </div>

            <div class="flex flex-col">
                <span class="block mb-3 text-xl font-semibold">{{ $product->price }}</span>

                <div class="p-6 bg-tertiary rounded-xl flex flex-row">
                    <span class="product-attribute mr-3 flex-center {{ $product->quantity ? 'text-info' : 'text-danger' }}">
                        <span class="material-symbols-rounded mr-1.5">inventory_2</span>
                        @if($product->quantity == 0)
                            Out of stock
                        @elseif($product->quantity < 10)
                            {{ $product->quantity }} in stock
                        @else
                            > 10 in stock
                        @endif
                    </span>

                    <span class="product-attribute flex-center {{ isset($product->shipping) ? 'text-info' : 'text-success' }}">
                        <span class="material-symbols-rounded mr-2">local_shipping</span>
                        @if(isset($product->shipping))
                            {{ $product->shipping }} shipping
                        @else
                            Free shipping
                        @endif
                    </span>
                </div>

                <button class="button px-10 py-3 mt-6 rounded-xl flex-center">
                    <span class="material-symbols-rounded mr-1.5">add_shopping_cart</span>
                    Add to cart
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
