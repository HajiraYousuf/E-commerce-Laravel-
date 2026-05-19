@extends('components.user.layouts.app')

@section('content')
<div class="bg-[#0b0f1a] min-h-screen text-white font-sans py-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center bg-[#111827]/40 border border-gray-800 p-8 rounded-3xl backdrop-blur-sm">
            
            <!-- Product Image -->
            <div class="relative bg-gray-900/50 rounded-2xl p-8 flex justify-center items-center border border-gray-800 overflow-hidden group">
                <div class="absolute inset-0 bg-blue-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}" class="max-h-[400px] object-contain brightness-110 group-hover:scale-105 transition-transform duration-500">
            </div>

            <!-- Product Details -->
            <div>
                <span class="text-blue-500 text-xs font-bold tracking-widest uppercase">The Anatomy of a Premium Device</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mt-2 mb-4 leading-tight uppercase italic">
                    {{ $product['name'] }}
                </h1>
                
                <p class="text-gray-400 text-base leading-relaxed mb-8">
                    {{ $product['desc'] }}
                </p>

                <ul class="space-y-3 mb-8 text-sm text-gray-300 font-medium">
                    <li class="flex items-center gap-3">
                        <span class="text-blue-500">✔</span> 100% Authentic & Ethically Sourced
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-blue-500">✔</span> Factory Sealed with Official Warranty
                    </li>
                </ul>

                <!-- Price and Action Buttons -->
                <div class="flex items-center gap-6 border-t border-gray-800/60 pt-6">
                    <div>
                        <span class="text-gray-500 text-xs block uppercase font-bold">Price</span>
                        <span class="text-3xl font-black text-blue-500">{{ $product['price'] }}</span>
                    </div>
                    
                    <!-- Buy Now Button -->
                    <a href="{{ route('products.checkout', ['product_id' => $id]) }}" class="flex-1 text-center py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-xs text-white font-black rounded-xl uppercase tracking-wider transition-all shadow-lg shadow-blue-900/30 active:scale-95">
                        Buy Now 🚀
                    </a>
                    
                    <!-- Wishlist Button (Halkan ayaan ku saxay) -->
                    <form action="{{ route('wishlist.store', ['id' => $id]) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="px-6 py-4 bg-gray-900 border border-gray-800 hover:bg-gray-800 text-xs text-gray-300 hover:text-white font-bold rounded-xl uppercase tracking-wider transition-all active:scale-95 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            Add Wishlist
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection