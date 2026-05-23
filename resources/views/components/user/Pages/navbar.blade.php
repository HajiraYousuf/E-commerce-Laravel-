<header
    x-data="{ open: false }"
    class="sticky top-0 z-50 backdrop-blur-xl bg-white/70 dark:bg-gray-900/70 border-b border-gray-200 dark:border-gray-800">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between h-20">

            <!-- LOGO -->
            <a href="{{ route('home') }}"
                class="flex items-center gap-3">

                <div
                    class="w-10 h-10 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-lg">
                    E
                </div>

                <div>
                    <h1 class="font-bold text-xl">
                        ElectroShop
                    </h1>

                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Modern Electronics
                    </p>
                </div>

            </a>

            <!-- DESKTOP MENU -->
            <nav class="hidden lg:flex items-center gap-8">

                <a href="{{ route('home') }}"
                    class="font-medium hover:text-blue-600 transition">
                    Home
                </a>

                <a href="{{ route('shop') }}"
                    class="font-medium hover:text-blue-600 transition">
                    Shop
                </a>

                <a href="{{route('wishlist.index')}}"
                    class="font-medium hover:text-blue-600 transition">
                    My Wishlist
                </a>

                <a href="{{ route('contact') }}"
                    class="font-medium hover:text-blue-600 transition">
                    Contact
                </a>

                <a href="{{ route('contact') }}"
                    class="font-medium hover:text-blue-600 transition">
                    Contact
                </a>

            </nav>

            <!-- RIGHT -->
            <div class="hidden lg:flex items-center gap-4">

                <!-- SEARCH -->
                <form action="{{ route('shop') }}"
                    method="GET"
                    class="relative">

                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products..."
                        class="w-64 bg-gray-100 dark:bg-gray-800 border border-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-500 rounded-2xl pl-12 pr-4 py-3 outline-none transition">

                    <button type="submit">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 absolute left-4 top-3.5 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />

                        </svg>

                    </button>

                </form>

                <!-- CART -->
                <a href="{{ route('cart') }}"
                    class="relative w-12 h-12 rounded-2xl bg-gray-100 dark:bg-gray-800 hover:bg-blue-600 hover:text-white transition flex items-center justify-center">

                    🛒

                    <span
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">

                        {{ $cartCount ?? 0 }}   
                    </span>

                </a>

                <!-- THEME -->
                <button onclick="toggleTheme()"
                    class="w-12 h-12 rounded-2xl bg-gray-100 dark:bg-gray-800 hover:bg-yellow-400 hover:text-black transition flex items-center justify-center text-lg">

                    🌙

                </button>

                <!-- LOGIN / USER -->
                @auth

                <div class="flex items-center gap-3">

                    <span class="font-medium">
                        {{ auth()->user()->name }}
                    </span>

                    <form action="{{ route('logout') }}"
                        method="POST">

                        @csrf

                        <button
                            class="px-5 py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold transition">

                            Logout

                        </button>

                    </form>

                </div>

                @else

                <a href="{{ route('login') }}"
                    class="px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-lg">

                    Login

                </a>

                @endauth

            </div>
        </div>

    </div>


</header>


<!-- ALPINE -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>