  @extends('components.user.layouts.app')

@section('content')
<section class="relative min-h-[80vh] flex items-center px-10 overflow-hidden">
    
    <div class="absolute top-20 -left-20 w-72 h-72 bg-blue-600 rounded-full blur-[120px] opacity-20"></div>
    <div class="absolute bottom-10 right-0 w-96 h-96 bg-purple-600 rounded-full blur-[150px] opacity-10"></div>

    <div class="container mx-auto grid md:grid-cols-2 gap-12 items-center relative z-10">
        
        <div class="space-y-6">
            <span class="text-blue-500 font-semibold tracking-widest uppercase text-sm">Ku soo dhowaad HH Store</span>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Upgrade Your <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Digital Style</span>
            </h1>
            <p class="text-gray-400 text-lg max-w-md leading-relaxed">
                Hel qalabka ugu casrisan ee Laptops iyo Phones, annagoo kuu keenayna tayadii ugu sarreysay iyo qiimo ku qanciya.
            </p>
            <div class="flex space-x-4 pt-4">
                <a href="#" class="px-8 py-4 bg-blue-600 hover:bg-blue-500 rounded-xl font-bold transition-all neon-glow">
                    Shop Now
                </a>
                <a href="#" class="px-8 py-4 border border-gray-700 hover:bg-gray-800 rounded-xl font-bold transition-all">
                    View Deals
                </a>
            </div>
        </div>

        <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
            <div class="relative bg-gray-900 rounded-2xl p-4 border border-gray-800">
                <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&q=80&w=1000" 
                     alt="Hero Laptop" 
                     class="rounded-xl shadow-2xl">
            </div>
        </div>

    </div>
</section>
@endsection