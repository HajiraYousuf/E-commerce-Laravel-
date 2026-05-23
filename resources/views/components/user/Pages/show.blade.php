@extends('components.user.layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10 grid md:grid-cols-2 gap-8">

    {{-- IMAGE --}}
    <div class="bg-white dark:bg-gray-900 p-5 rounded-xl shadow">
        <img src="{{ asset('storage/'.$product->image) }}"
            class="w-full h-96 object-cover rounded-xl">
    </div>

    {{-- INFO --}}
    <div class="bg-white dark:bg-gray-900 p-5 rounded-xl shadow">

        <h1 class="text-3xl font-bold dark:text-white">
            {{ $product->name }}
        </h1>

        <p class="text-gray-500 mt-2 dark:text-gray-300">
            {{ $product->description }}
        </p>

        <div class="mt-4 text-2xl font-bold text-blue-600">
            ${{ $product->price }}
        </div>

        {{-- ACTIONS --}}
        <div class="mt-6 flex gap-3">

            {{-- ADD TO CART --}}
            <a href="{{ route('cart.add', $product->id) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                Add to Cart
            </a>

            {{-- WISHLIST TOGGLE --}}
            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="px-5 py-2 rounded-lg border dark:border-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800">
                    ❤️ Wishlist
                </button>
            </form>

        </div>

    </div>

</div>

@endsection