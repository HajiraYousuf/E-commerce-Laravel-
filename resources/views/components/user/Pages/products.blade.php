@extends('components.user.layouts.app')

@section('content')

<!-- HERO -->
<section class="relative overflow-hidden bg-gradient-to-r from-blue-700 via-indigo-700 to-gray-900 py-24 text-white">

    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_right,#ffffff,transparent)]"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <div class="text-center">

            <span class="px-5 py-2 rounded-full bg-white/10 border border-white/20 text-sm">
                🛍️ Premium Electronics Collection
            </span>

            <h1 class="mt-6 text-5xl md:text-6xl font-extrabold leading-tight">
                Explore Our Modern Shop
            </h1>

            <p class="mt-6 text-lg text-gray-200 max-w-2xl mx-auto">
                Discover top quality electronics, gadgets, laptops,
                accessories and smart devices with premium experience.
            </p>

        </div>

    </div>

</section>

<!-- SHOP -->
<section class="py-20 bg-gray-50 dark:bg-black min-h-screen">

    <div class="max-w-7xl mx-auto px-6">

        <!-- FILTER FORM -->
        <form method="GET" action="{{ route('shop') }}"
            class="flex flex-col lg:flex-row gap-5 justify-between mb-12">

            <!-- SEARCH -->
            <div class="relative w-full lg:w-[400px]">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search products..."
                    class="w-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl px-5 py-4 pl-14 outline-none focus:ring-2 focus:ring-blue-500 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 absolute left-5 top-4.5 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />

                </svg>

            </div>

            <!-- FILTERS -->
            <div class="flex flex-wrap gap-4">

                <!-- CATEGORY -->
                <select
                    name="category"
                    class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl px-5 py-4 outline-none">

                    <option value="">All Categories</option>

                    @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>

                    @endforeach

                </select>

                <!-- SORT -->
                <select
                    name="sort"
                    class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl px-5 py-4 outline-none">

                    <option value="">Sort By</option>

                    <option value="latest"
                        {{ request('sort') == 'latest' ? 'selected' : '' }}>
                        Latest
                    </option>

                    <option value="price_low"
                        {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                        Price Low
                    </option>

                    <option value="price_high"
                        {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                        Price High
                    </option>

                    <option value="sold"
                        {{ request('sort') == 'sold' ? 'selected' : '' }}>
                        Best Selling
                    </option>

                </select>

                <!-- BUTTON -->
                <button
                    class="px-6 py-4 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                    Apply

                </button>

            </div>

        </form>

        <!-- PRODUCTS GRID -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">

            @forelse($products as $product)

            <div
                class="group relative overflow-hidden rounded-3xl bg-white dark:bg-[#0f172a] border border-gray-200/60 dark:border-white/10 hover:border-blue-500/30 transition-all duration-500 shadow-sm hover:shadow-2xl hover:-translate-y-2">

                <!-- IMAGE -->
                <div class="relative h-72 overflow-hidden bg-gray-100 dark:bg-black">

                    <!-- BADGES -->
                    <div class="absolute top-4 left-4 z-20 flex flex-col gap-2">

                        @if($product->sold > 50)

                        <span class="px-3 py-1 rounded-full bg-red-500 text-white text-[11px] font-semibold">
                            Trending
                        </span>

                        @endif

                        @if($product->stock < 10)

                        <span class="px-3 py-1 rounded-full bg-orange-500 text-white text-[11px] font-semibold">
                            Low Stock
                        </span>

                        @endif

                    </div>

                    <!-- ACTIONS -->
                    <div
                        class="absolute top-4 right-4 z-20 flex flex-col gap-2 opacity-0 group-hover:opacity-100 translate-x-4 group-hover:translate-x-0 transition duration-500">

                        <!-- WISHLIST -->
                        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="w-10 h-10 rounded-xl bg-white/90 dark:bg-gray-900/90 backdrop-blur flex items-center justify-center shadow-lg hover:bg-red-500 hover:text-white transition">

                                <i class="ri-heart-line"></i>

                            </button>

                        </form>

                        <!-- VIEW -->
                        <a href="{{ route('product.show', $product->id) }}"
                            class="w-10 h-10 rounded-xl bg-white/90 dark:bg-gray-900/90 backdrop-blur flex items-center justify-center shadow-lg hover:bg-black hover:text-white transition">

                            <i class="ri-eye-line"></i>

                        </a>

                    </div>

                    <!-- IMAGE -->
                    <img
                        src="{{ $product->image }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">

                    <!-- OVERLAY -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>

                    <!-- CATEGORY -->
                    <div class="absolute bottom-4 left-4 z-20">

                        <span
                            class="px-3 py-1 rounded-full bg-white/90 dark:bg-black/70 backdrop-blur text-xs font-medium text-gray-800 dark:text-white">

                            {{ $product->category->name ?? 'Category' }}

                        </span>

                    </div>

                </div>

                <!-- CONTENT -->
                <div class="p-5">

                    <!-- TITLE -->
                    <h2
                        class="text-lg font-bold text-gray-900 dark:text-white line-clamp-1 group-hover:text-blue-600 transition">

                        {{ $product->name }}

                    </h2>

                    <!-- DESC -->
                    <p
                        class="mt-2 text-sm text-gray-500 dark:text-gray-400 line-clamp-2 leading-relaxed">

                        {{ $product->description }}

                    </p>

                    <!-- STOCK -->
                    <div class="flex items-center justify-between mt-4">

                        <div class="flex items-center gap-3">

                            <span
                                class="px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 text-xs font-bold">

                                In Stock

                            </span>

                            <span class="text-sm text-gray-400">

                                {{ $product->stock }} Available

                            </span>

                        </div>

                        <span class="text-xs font-medium text-orange-500">

                            {{ $product->sold }} sold

                        </span>

                    </div>

                    <!-- PRICE -->
                    <div class="mt-5 flex items-center justify-between">

                        <div>

                            <h3 class="text-2xl font-extrabold text-blue-600">

                                ${{ number_format($product->price, 2) }}

                            </h3>

                            <p class="text-xs text-gray-400 mt-1">

                                SKU: {{ $product->sku }}

                            </p>

                        </div>

                        <!-- CART -->
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf

                            <button
                                class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold transition">

                                Add To Cart

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-span-full text-center py-20">

                <h2 class="text-3xl font-bold text-gray-700 dark:text-white">
                    No Products Found
                </h2>

                <p class="mt-3 text-gray-500">
                    Try another search or filter.
                </p>

            </div>

            @endforelse

        </div>

        <!-- PAGINATION -->
        <div class="mt-16">

            {{ $products->withQueryString()->links() }}

        </div>

    </div>

</section>

@endsection