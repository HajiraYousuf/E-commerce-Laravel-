@extends('components.user.layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    <h1 class="text-2xl font-bold mb-6 dark:text-white">
        ❤️ My Wishlist
    </h1>

    <div class="grid md:grid-cols-3 gap-6">

        @forelse($wishlists as $item)

            <div class="bg-white dark:bg-gray-900 shadow rounded-xl p-4">

                <img src="{{ $item->product->image }}"
                    class="w-full h-48 object-cover rounded-lg">

                <h2 class="mt-3 font-bold dark:text-white">
                    {{ $item->product->name }}
                </h2>

                <p class="text-blue-600 font-semibold">
                    ${{ $item->product->price }}
                </p>

                <div class="mt-3 flex gap-2">

                    <a href="{{ route('product.show', $item->product->id) }}"
                       class="text-sm bg-gray-200 dark:bg-gray-800 px-3 py-1 rounded">
                        View
                    </a>

                    <form action="{{ route('wishlist.toggle', $item->product->id) }}" method="POST">
                        @csrf
                        <button class="text-sm bg-red-500 text-white px-3 py-1 rounded">
                            Remove
                        </button>
                    </form>

                </div>

            </div>

        @empty

            <p class="text-gray-500 dark:text-gray-300">
                No items in wishlist
            </p>

        @endforelse

    </div>

</div>

@endsection