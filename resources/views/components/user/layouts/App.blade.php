<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habon Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Neon Glow Custom Effect */
        .neon-glow {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>
<body class="bg-[#0b0f1a] text-white font-sans">

    <nav class="flex items-center justify-between px-10 py-6 border-b border-gray-800">
        <div class="text-2xl font-bold tracking-tighter text-blue-500">HH</div>
        <div class="hidden md:flex space-x-8 text-sm uppercase tracking-widest">
            <a href="{{ route('home') }}">HOME</a>
            
            <a href="/products" class="hover:text-blue-400">Products</a>
            <a href="{{ url('/wishlist') }}">WISHLIST</a>
            <a href="#" class="hover:text-blue-400">Order</a>
        </div>
        <div class="flex items-center space-x-5">
            <button class="p-2 bg-gray-900 rounded-full hover:bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </button>
            <div class="w-10 h-10 rounded-full bg-blue-600 border-2 border-blue-400 overflow-hidden">
                <img src="https://ui-avatars.com/api/?name=User" alt="Profile">
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="py-10 text-center text-gray-600 text-sm">
        &copy; 2026 Habon Store. All rights reserved.
    </footer>

</body>
</html>