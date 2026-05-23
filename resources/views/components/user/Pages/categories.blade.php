@extends('components.user.layouts.app')

@section('content')

<!-- HERO -->
<section class="bg-gradient-to-r from-indigo-700 via-blue-700 to-gray-900 text-white py-24">

    <div class="max-w-7xl mx-auto px-6 text-center">

        <h1 class="text-5xl font-extrabold">
            Explore Categories
        </h1>

        <p class="mt-6 text-gray-200 text-lg max-w-2xl mx-auto">
            Browse all product categories and discover your favorite electronics, gadgets and accessories.
        </p>

    </div>

</section>

<!-- CATEGORIES GRID -->
<section class="py-24 bg-gray-50 dark:bg-black">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">

            @foreach($categories as $category)

            <a href="#"
                class="group relative bg-white dark:bg-gray-900 rounded-[30px] overflow-hidden shadow hover:shadow-2xl transition duration-500 hover:-translate-y-2">

                <!-- IMAGE -->
                <div class="h-56 overflow-hidden bg-gray-100 dark:bg-gray-800">

                    <img src="{{ asset('storage/' . $category->image) }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700">

                </div>

                <!-- CONTENT -->
                <div class="p-6">

                    <h2 class="text-2xl font-bold group-hover:text-blue-600 transition">
                        {{ $category->name }}
                    </h2>

                    <p class="mt-3 text-gray-500 text-sm line-clamp-2">
                        {{ $category->description }}
                    </p>

                    <!-- PRODUCT COUNT -->
                    <div class="mt-6 flex items-center justify-between">

                        <span class="text-sm text-gray-400">
                            {{ $category->products_count ?? 0 }} Products
                        </span>

                        <span
                            class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                            →
                        </span>

                    </div>

                </div>

                <!-- BORDER GLOW -->
                <div
                    class="absolute inset-0 border border-transparent group-hover:border-blue-500/30 rounded-[30px] transition pointer-events-none">
                </div>

            </a>

            @endforeach

        </div>

    </div>

</section>

@endsection