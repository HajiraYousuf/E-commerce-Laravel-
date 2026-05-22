@extends('components.user.layouts.app')

@section('content')

<!-- DARK MODE SCRIPT -->
<script>
    if (
        localStorage.getItem('theme') === 'dark' ||
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    }
</script>

<div class="bg-white dark:bg-gray-950 text-gray-900 dark:text-white transition-all duration-300">

<!-- HERO -->
<section class="relative overflow-hidden py-24 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 dark:from-black dark:via-gray-900 dark:to-black text-white">

    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_20%_20%,#3b82f6,transparent)]"></div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center relative z-10">

        <div>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                Best Electronics <br> Deals for You ⚡
            </h1>

            <p class="mt-5 text-gray-300 text-lg">
                Shop smartphones, laptops, headphones & accessories at unbeatable prices.
            </p>

            <div class="mt-8 flex gap-4">
                <a href="#" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl font-semibold shadow-lg transition">
                    Shop Now
                </a>

                <a href="#" class="border border-gray-400 px-6 py-3 rounded-xl hover:bg-white hover:text-black transition">
                    Explore
                </a>

                <button onclick="toggleTheme()" class="ml-2 px-4 py-3 rounded-xl bg-gray-700 hover:bg-gray-600 transition">
                    🌙/☀️
                </button>
            </div>
        </div>

        <div class="flex justify-center">
            <img src="{{ asset('images/hero-electronics.png') }}"
                 class="w-full max-w-md drop-shadow-2xl hover:scale-105 transition duration-500" />
        </div>

    </div>
</section>

<!-- CATEGORIES -->
<section class="py-20 bg-gray-100 dark:bg-gray-900 transition">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-bold mb-10">Shop by Categories</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

            @foreach(['Phones','Laptops','Headphones','Accessories'] as $cat)
            <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl hover:-translate-y-1 transition text-center cursor-pointer">
                <h3 class="font-semibold group-hover:text-blue-500 transition">{{ $cat }}</h3>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- FEATURED -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold">Featured Products</h2>
            <a href="#" class="text-blue-500 hover:underline">View All</a>
        </div>

        <div class="grid md:grid-cols-4 gap-6">

            @foreach($featuredProducts as $product)
            <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow hover:shadow-2xl transition group">

                <img src="{{ asset('storage/'.$product->image) }}"
                     class="h-44 w-full object-cover group-hover:scale-105 transition duration-500">

                <div class="p-5">
                    <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $product->category }}</p>

                    <div class="flex justify-between items-center mt-4">
                        <span class="font-bold text-blue-500">${{ $product->price }}</span>

                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                            Buy
                        </a>
                    </div>
                </div>

            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- LATEST -->
<section class="py-20 bg-gray-100 dark:bg-gray-900 transition">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-bold mb-10">Latest Products</h2>

        <div class="grid md:grid-cols-3 gap-6">

            @foreach($latestProducts as $product)
            <div class="flex bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow hover:shadow-xl transition">

                <img src="{{ asset('storage/'.$product->image) }}"
                     class="w-32 h-32 object-cover">

                <div class="p-4 flex-1">
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $product->category }}</p>

                    <div class="mt-3 flex justify-between items-center">
                        <span class="text-blue-500 font-bold">${{ $product->price }}</span>

                        <a href="#" class="text-sm text-white bg-black dark:bg-blue-600 px-3 py-1 rounded-lg">
                            View
                        </a>
                    </div>
                </div>

            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-gray-900 dark:bg-black text-gray-300 py-14">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-10">

        <div>
            <h3 class="text-white font-bold text-xl">ElectroShop</h3>
            <p class="mt-3 text-sm text-gray-400">
                Your trusted store for modern electronics.
            </p>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-4">Quick Links</h4>
            <ul class="space-y-2 text-sm">
                <li><a class="hover:text-white" href="#">Home</a></li>
                <li><a class="hover:text-white" href="#">Shop</a></li>
                <li><a class="hover:text-white" href="#">About</a></li>
                <li><a class="hover:text-white" href="#">Contact</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-4">Newsletter</h4>

            <input type="email" placeholder="Enter email"
                   class="w-full p-3 rounded-xl bg-gray-800 border border-gray-700 focus:ring-2 focus:ring-blue-500">

            <button class="mt-3 w-full bg-blue-600 hover:bg-blue-700 py-3 rounded-xl transition">
                Subscribe
            </button>
        </div>

    </div>

    <div class="text-center text-sm mt-10 border-t border-gray-800 pt-6 text-gray-500">
        © {{ date('Y') }} ElectroShop. All rights reserved.
    </div>
</footer>

</div>

@endsection