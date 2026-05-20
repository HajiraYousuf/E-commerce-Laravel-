@extends('components.user.layouts.app')

@section('content')
<div class="bg-[#0b0f1a] min-h-screen text-white font-sans pb-10">
    
    <div class="relative py-16 flex flex-col items-center justify-center overflow-hidden">
        <div class="absolute opacity-10 animate-pulse">
            <svg class="w-80 h-80 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>
        
        <div class="relative z-10 text-center px-4">
            <h1 class="text-4xl md:text-5xl font-black text-white drop-shadow-lg">
                Kusoo Dhawoow <span class="text-red-500">HH</span> Electronics
            </h1>
            <p class="mt-4 text-gray-400 text-lg max-w-xl mx-auto leading-relaxed">
                Halkan waxaan u joognaa inaan macmiilkayaga qancino. ❤️
            </p>
        </div>
    </div>

    <div class="container mx-auto px-6">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            <div class="flex items-center p-5 bg-[#111827]/50 border border-gray-800 rounded-2xl hover:bg-blue-600/10 transition-colors">
                <span class="text-3xl mr-4">🚚</span>
                <div><h4 class="font-bold text-sm">Free Shipping</h4><p class="text-xs text-gray-500">Orders over $100</p></div>
            </div>
            <div class="flex items-center p-5 bg-[#111827]/50 border border-gray-800 rounded-2xl hover:bg-blue-600/10 transition-colors">
                <span class="text-3xl mr-4">🔄</span>
                <div><h4 class="font-bold text-sm">7 Days Return</h4><p class="text-xs text-gray-500">100% money back</p></div>
            </div>
            <div class="flex items-center p-5 bg-[#111827]/50 border border-gray-800 rounded-2xl hover:bg-blue-600/10 transition-colors">
                <span class="text-3xl mr-4">💳</span>
                <div><h4 class="font-bold text-sm">Secure Payments</h4><p class="text-xs text-gray-500">Safe & Fast</p></div>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-8 border-l-4 border-blue-600 pl-4 uppercase tracking-wider">Featured Products</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
            @php
                $products = [
                    ['name' => 'Airpods', 'price' => '$50', 'img' => 'image1.jpg'],
                    ['name' => 'iPhone 16 PRO', 'price' => '$1000', 'img' => 'image2.jpg'],
                    ['name' => 'Laptop Pro', 'price' => '$570', 'img' => 'image3.jpg'],
                    ['name' => 'Laptop pro', 'price' => '$300', 'img' => 'image4.jpg'],
                    ['name' => 'Smart watch', 'price' => '$80', 'img' => 'image5.jpg'],
                    ['name' => 'Headphones', 'price' => '$60', 'img' => 'image6.jpg'],
                    ['name' => 'Laptop pro', 'price' => '$300', 'img' => 'image7.jpg'],
                    ['name' => 'Smart watch', 'price' => '$80', 'img' => 'image8.jpg'],
                    ['name' => 'Headphones', 'price' => '$60', 'img' => 'image9.jpg'],
                    ['name' => 'Headphones', 'price' => '$60', 'img' => 'image10.jpg'],
                    ['name' => 'Laptop pro', 'price' => '$300', 'img' => 'image11.jpg'],
                    ['name' => 'Smart watch', 'price' => '$80', 'img' => 'image12.jpg'],
                    ['name' => 'Headphones', 'price' => '$60', 'img' => 'image13.jpg'],
                    ['name' => 'Headphones', 'price' => '$60', 'img' => 'image14.jpg'],
                ];
            @endphp

            @foreach($products as $item)
            <div class="group bg-[#111827] border border-gray-800 rounded-2xl p-3 transition-all duration-300 hover:shadow-[0_0_20px_rgba(59,130,246,0.15)] active:scale-95 cursor-pointer">
                <div class="relative h-36 w-full bg-gray-900 rounded-xl mb-3 flex justify-center items-center overflow-hidden">
                    <img src="{{ asset('images/' . $item['img']) }}" 
                         class="max-h-[80%] object-contain group-hover:rotate-3 group-hover:scale-110 transition-transform duration-500">
                </div>

                <div class="text-center">
                    <h3 class="text-gray-300 text-[11px] font-bold truncate">{{ $item['name'] }}</h3>
                    <p class="text-blue-500 font-black text-sm mt-1">{{ $item['price'] }}</p>
                    <button class="w-full mt-3 py-2 bg-blue-600 hover:bg-blue-500 text-[9px] text-white font-bold rounded-lg uppercase transition-all">
                        Add to cart
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <footer class="mt-24 py-12 border-t border-gray-800 bg-[#0f172a]">
        <div class="container mx-auto px-6 text-center">
            <a href="/more-info" class="text-blue-500 hover:text-blue-400 font-bold text-sm transition-all inline-flex items-center group">
                For More Information 
                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
            <p class="text-gray-600 text-[10px] mt-6 tracking-[0.3em] uppercase">
                Electronics for more information
            </p>
        </div>
    </footer>
</div>
@endsection