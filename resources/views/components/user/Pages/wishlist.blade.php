@extends('components.user.layouts.app')  

@section('content')
<div class="min-h-screen bg-[#0b0f1a] text-white p-8">
    
    <!-- Header-ka Bogga -->
    <div class="mb-10 border-b border-gray-800 pb-5">
        <h1 class="text-3xl font-black uppercase tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-blue-400">
            My Wishlist ❤️
        </h1>
        <p class="text-gray-500 text-xs mt-2 uppercase tracking-widest">Alaabta aad jeclaystay ee kuu keydsan</p>
    </div>

    <!-- Wishlist Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Hal Card oo tusaale ah (Product Card) -->
        <div class="group relative bg-[#111827] border border-gray-800 rounded-[2rem] p-5 transition-all duration-500 hover:border-purple-500/50 hover:shadow-[0_0_30px_rgba(168,85,247,0.15)]">
            
            <!-- Glow Effect (Gadaal ka muuqda) -->
            <div class="absolute inset-0 bg-gradient-to-br from-purple-600/10 to-blue-600/10 rounded-[2rem] opacity-0 group-hover:opacity-100 transition-opacity"></div>

            <!-- Image Section -->
            <div class="relative h-48 w-full bg-[#0b0f1a] rounded-2xl mb-4 flex justify-center items-center overflow-hidden border border-gray-800">
                <img src="{{ asset('images/image1.jpg') }}" class="max-h-[80%] group-hover:scale-110 transition-transform duration-500">
                
                <!-- Remove Button (X) -->
                <button class="absolute top-3 right-3 w-8 h-8 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                    ✕
                </button>
            </div>

            <!-- Info Section -->
            <div class="relative z-10 text-center">
                <h3 class="text-lg font-bold text-gray-200">iPhone 16 Pro</h3>
                <p class="text-purple-400 font-black text-xl my-2">$1,000</p>
                
                <!-- Move to Cart Button -->
                <button class="w-full py-3 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl font-bold text-xs uppercase tracking-widest hover:from-purple-500 hover:to-blue-500 active:scale-95 transition-all shadow-lg shadow-purple-900/20">
                    Add to Cart 🛒
                </button>
            </div>
        </div>

        <!-- Haddii Wishlist-ka uu faaruq yahay (Empty State Example) -->
        <!-- 
        <div class="col-span-full py-20 text-center">
            <div class="text-6xl mb-5 opacity-20 text-purple-500">❤️</div>
            <h2 class="text-xl font-bold text-gray-400">Wishlist-kaagu waa faaruq!</h2>
            <a href="/products" class="text-blue-500 hover:underline mt-4 block">Hadda billow inaad alaab jeclaato</a>
        </div> 
        -->

    </div>
</div>
@endsection