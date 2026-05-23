@extends('components.user.layouts.app')

@section('content')

<!-- HERO -->
<section class="bg-gradient-to-r from-blue-700 via-indigo-700 to-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl font-extrabold">Your Shopping Cart 🛒</h1>
        <p class="text-gray-200 mt-3">Review your products before checkout</p>
    </div>
</section>

<!-- CART -->
<section class="py-20 bg-gray-50 dark:bg-black">

    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-3 gap-10">

        <!-- LEFT: CART ITEMS -->
        <div class="lg:col-span-2 space-y-6">

            @forelse($cartItems as $item)

            <div
                class="flex flex-col md:flex-row items-center gap-6 bg-white dark:bg-gray-900 rounded-3xl p-6 shadow hover:shadow-xl transition">

                <!-- IMAGE -->
                <img src="{{ asset('storage/'.$item->product->image) }}"
                    class="w-28 h-28 object-cover rounded-2xl">

                <!-- INFO -->
                <div class="flex-1">

                    <h2 class="text-xl font-bold">
                        {{ $item->product->name }}
                    </h2>

                    <p class="text-gray-500 text-sm mt-1">
                        SKU: {{ $item->product->sku }}
                    </p>

                    <p class="text-blue-600 font-bold mt-2">
                        ${{ number_format($item->product->price, 2) }}
                    </p>

                </div>

                <!-- QTY -->
                <div class="flex items-center gap-3">

                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">

                        <button class="w-10 h-10 rounded-xl bg-gray-200 hover:bg-gray-300">
                            -
                        </button>
                    </form>

                    <span class="font-bold">
                        {{ $item->quantity }}
                    </span>
                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">

                        <button class="w-10 h-10 rounded-xl bg-gray-200 hover:bg-gray-300">
                            +
                        </button>
                    </form>

                </div>

                <!-- TOTAL -->
                <div class="text-right">

                    <p class="text-lg font-bold text-blue-600">
                        ${{ number_format($item->product->price * $item->quantity, 2) }}   
                    </p>

                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-500 text-sm mt-2 hover:underline">
                            Remove
                        </button>
                    </form>

                </div>

            </div>

            @empty

            <div class="text-center py-20 text-gray-500">
                Your cart is empty 🛒
            </div>

            @endforelse

        </div>

        <!-- RIGHT: SUMMARY -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl p-8 shadow h-fit">

            <h2 class="text-2xl font-bold mb-6">Order Summary</h2>

            <div class="space-y-4 text-gray-600 dark:text-gray-300">

                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>${{ $subtotal }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Shipping</span>
                    <span>$5.00</span>
                </div>

                <div class="flex justify-between">
                    <span>Total Items</span>
                    <span>{{ $cartItems->sum('quantity') }}</span>
                </div>

                <hr class="border-gray-200 dark:border-gray-700">

                <div class="flex justify-between text-xl font-bold text-black dark:text-white">
                    <span>Total</span>
                    <span>${{ $total }}</span>
                </div>

            </div>

            <a href="/checkout"
                class="mt-8 block text-center bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-semibold transition">
                Proceed to Checkout
            </a>

        </div>

    </div>

</section>

@endsection