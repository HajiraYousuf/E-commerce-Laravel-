@extends('components.user.layouts.app')

@section('content')

<!-- HERO -->
<section class="relative overflow-hidden bg-gradient-to-br from-blue-700 via-indigo-700 to-gray-900 text-white">

    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_right,#ffffff,transparent)]"></div>

    <div class="max-w-7xl mx-auto px-6 py-24 relative z-10">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div>

                <span class="px-4 py-2 rounded-full bg-white/10 border border-white/20 text-sm">
                    ⚡ Best Electronics Store
                </span>

                <h1 class="mt-6 text-5xl lg:text-6xl font-extrabold leading-tight">
                    Discover Modern
                    Electronics For
                    Everyday Life
                </h1>

                <p class="mt-6 text-lg text-gray-200 leading-relaxed">
                    Shop trending gadgets, premium laptops, smartphones,
                    headphones and accessories at unbeatable prices.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">

                    <a href="{{ route('shop') }}"
                        class="px-7 py-4 bg-white text-black rounded-2xl font-semibold hover:scale-105 transition">
                        Shop Now
                    </a>

                    <a href="#categories"
                        class="px-7 py-4 border border-white/30 rounded-2xl hover:bg-white hover:text-black transition">
                        Explore Categories
                    </a>

                </div>

            </div>

            <div class="flex justify-center">

                <img src="{{ asset('images/image11.jpg') }}"
                    class="w-full max-w-xl drop-shadow-2xl hover:scale-105 transition duration-500">

            </div>

        </div>

    </div>

</section>

<!-- SEARCH -->
<section class="py-10 bg-white dark:bg-black border-b border-gray-200 dark:border-gray-800">

    <div class="max-w-7xl mx-auto px-6">

        <form action="{{ route('shop') }}" method="GET"
            class="grid md:grid-cols-4 gap-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search products..."
                class="md:col-span-2 px-5 py-4 rounded-2xl border border-gray-200 dark:border-gray-700 dark:bg-gray-900 outline-none">

            <select
                name="category"
                class="px-5 py-4 rounded-2xl border border-gray-200 dark:border-gray-700 dark:bg-gray-900 outline-none">

                <option value="">
                    All Categories
                </option>

                @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>

                    {{ $category->name }}

                </option>

                @endforeach

            </select>

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-semibold transition">
                Search
            </button>

        </form>

    </div>

</section>

<!-- STATS -->
<section class="py-10 bg-white dark:bg-black border-b border-gray-200 dark:border-gray-800">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            <div class="bg-gray-100 dark:bg-gray-900 rounded-3xl p-6 text-center">
                <h3 class="text-3xl font-extrabold">
                    {{ $productsCount ?? 0 }}+
                </h3>
                <p class="text-gray-500 mt-2">
                    Products
                </p>
            </div>

            <div class="bg-gray-100 dark:bg-gray-900 rounded-3xl p-6 text-center">
                <h3 class="text-3xl font-extrabold">
                    {{ $categoriesCount ?? 0 }}+
                </h3>
                <p class="text-gray-500 mt-2">
                    Categories
                </p>
            </div>

            <div class="bg-gray-100 dark:bg-gray-900 rounded-3xl p-6 text-center">
                <h3 class="text-3xl font-extrabold">
                    {{ $topSellingProducts->sum('sold') ?? 0 }}+
                </h3>
                <p class="text-gray-500 mt-2">
                    Products Sold
                </p>
            </div>

            <div class="bg-gray-100 dark:bg-gray-900 rounded-3xl p-6 text-center">
                <h3 class="text-3xl font-extrabold">
                    24/7
                </h3>
                <p class="text-gray-500 mt-2">
                    Support
                </p>
            </div>

        </div>

    </div>

</section>

<!-- CATEGORIES -->
<section id="categories" class="py-24 bg-gray-50 dark:bg-gray-950">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between mb-12">

            <div>
                <h2 class="text-4xl font-extrabold">
                    Explore By Category
                </h2>

                <p class="text-gray-500 mt-3">
                    Browse products from popular categories
                </p>
            </div>

            <a href="{{ route('shop') }}"
                class="hidden md:block text-blue-600 font-semibold hover:underline">
                View All
            </a>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            @foreach($categories as $category)

            <a href="{{ route('category.show', $category->id) }}"
                class="group bg-white dark:bg-gray-900 rounded-3xl overflow-hidden shadow hover:shadow-2xl transition duration-300 hover:-translate-y-2">

                <div class="h-52 overflow-hidden">

<img
    src="{{asset('storage/' . $category->image) }}"
    alt="{{ $category->name }}"
    class="w-full h-64 object-cover">
                </div>

                <div class="p-6">

                    <h3 class="text-xl font-bold group-hover:text-blue-600 transition">
                        {{ $category->name }}
                    </h3>

                    <p class="text-gray-500 mt-2 text-sm line-clamp-2">
                        {{ $category->description }}
                    </p>

                    <div class="mt-5 flex items-center justify-between">

                        <span class="text-sm text-gray-400">
                            Explore Now
                        </span>

                        <span
                            class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                            →
                        </span>

                    </div>

                </div>

            </a>

            @endforeach

        </div>

    </div>

</section>

<!-- TOP SELLING PRODUCTS -->
<section id="products" class="py-24 bg-white dark:bg-black">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between mb-12">

            <div>

                <h2 class="text-4xl font-extrabold">
                    Top Selling Products
                </h2>

                <p class="text-gray-500 mt-3">
                    Most popular products loved by customers
                </p>

            </div>

            <a href="{{ route('shop') }}"
                class="hidden md:block text-blue-600 font-semibold hover:underline">
                View All Products
            </a>

        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">

            @foreach($topSellingProducts as $product)

            <div
                class="group bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl overflow-hidden shadow hover:shadow-2xl transition duration-300 hover:-translate-y-2">

                <div class="relative overflow-hidden">
                    <img
                        src="{{ asset('storage/' . $product->image) }}"    
                    alt="{{ $product->name }}"
                        class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">  
                      <div
                        class="absolute top-4 left-4 px-3 py-1 rounded-full bg-blue-600 text-white text-xs font-semibold shadow">
                        🔥 Best Seller
                    </div>

                </div>

                <div class="p-6">

                    <div class="flex items-center justify-between">

                        <span
                            class="text-xs px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300">
                            {{ $product->category->name ?? 'Category' }}
                        </span>

                        <span class="text-sm text-orange-500 font-semibold">
                            Sold {{ $product->sold }}
                        </span>

                    </div>

                    <h3 class="mt-4 text-xl font-bold line-clamp-1">
                        {{ $product->name }}
                    </h3>

                    <p class="mt-3 text-gray-500 text-sm line-clamp-2">
                        {{ $product->description }}
                    </p>

                    <div class="mt-6 flex items-center justify-between">

                        <div>

                            <h4 class="text-2xl font-extrabold text-blue-600">
                                ${{ number_format($product->price, 2) }}
                            </h4>

                            <p class="text-xs text-gray-400">
                                Stock: {{ $product->stock }}
                            </p>

                        </div>

                        <form action="{{ route('cart.add', $product->id) }}"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-lg">

                                Add To Cart

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

<!-- CTA -->
<section class="py-24 bg-gradient-to-r from-blue-700 to-indigo-700 text-white">

    <div class="max-w-4xl mx-auto px-6 text-center">

        <h2 class="text-5xl font-extrabold leading-tight">
            Upgrade Your Tech Experience
        </h2>

        <p class="mt-6 text-lg text-blue-100">
            Discover premium electronics with fast delivery and secure shopping.
        </p>

        <div class="mt-10">

            <a href="{{ route('shop') }}"
                class="px-8 py-4 bg-white text-black rounded-2xl font-bold hover:scale-105 transition">
                Start Shopping
            </a>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="relative overflow-hidden bg-black text-white">

    <div class="max-w-7xl mx-auto px-6 py-20">

        <div class="grid lg:grid-cols-4 gap-12">

            <!-- BRAND -->
            <div>

                <div class="flex items-center gap-3">

                    <div
                        class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center text-2xl font-bold shadow-lg">
                        E
                    </div>

                    <div>
                        <h2 class="text-2xl font-extrabold">
                            ElectroShop
                        </h2>

                        <p class="text-sm text-gray-400">
                            Modern Electronics Store
                        </p>
                    </div>

                </div>

                <p class="mt-6 text-gray-400 leading-relaxed">
                    Discover premium electronics, gadgets, laptops,
                    smartphones and accessories with unbeatable prices
                    and fast delivery.
                </p>

            </div>

            <!-- QUICK LINKS -->
            <div>

                <h3 class="text-xl font-bold mb-6">
                    Quick Links
                </h3>

                <ul class="space-y-4 text-gray-400">

                    <li>
                        <a href="{{ route('home') }}"
                            class="hover:text-white transition">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('shop') }}"
                            class="hover:text-white transition">
                            Products
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}"
                            class="hover:text-white transition">
                            Contact
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('cart') }}"
                            class="hover:text-white transition">
                            Cart
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}"
                            class="hover:text-white transition">
                            Contact
                        </a>
                    </li>

                </ul>

            </div>

            <!-- CATEGORIES -->
            <div>

                <h3 class="text-xl font-bold mb-6">
                    Categories
                </h3>

                <ul class="space-y-4 text-gray-400">

                    @foreach($categories->take(5) as $category)

                    <li>

                        <a href="{{ route('category.show', $category->id) }}"
                            class="hover:text-white transition">

                            {{ $category->name }}

                        </a>

                    </li>

                    @endforeach

                </ul>

            </div>

            <!-- NEWSLETTER -->
            <div>

                <h3 class="text-xl font-bold mb-6">
                    Newsletter
                </h3>

                <p class="text-gray-400 mb-6">
                    Subscribe to receive latest offers, discounts and updates.
                </p>

                <form class="space-y-4">

                    <input type="email"
                        placeholder="Enter your email"
                        class="w-full px-5 py-4 rounded-2xl bg-gray-900 border border-gray-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none transition">

                    <button
                        class="w-full py-4 rounded-2xl bg-blue-600 hover:bg-blue-700 transition font-semibold shadow-lg">

                        Subscribe Now

                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- BOTTOM -->
    <div class="border-t border-gray-900">

        <div
            class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-gray-500 text-sm">
                © {{ date('Y') }} ElectroShop. All rights reserved.
            </p>

            <div class="flex items-center gap-6 text-sm text-gray-500">

                <a href="#"
                    class="hover:text-white transition">
                    Privacy Policy
                </a>

                <a href="#"
                    class="hover:text-white transition">
                    Terms & Conditions
                </a>

                <a href="#"
                    class="hover:text-white transition">
                    Support
                </a>

            </div>

        </div>

    </div>

    <div
        class="absolute top-0 right-0 w-96 h-96 bg-blue-600/10 blur-3xl rounded-full">
    </div>

</footer>

@endsection