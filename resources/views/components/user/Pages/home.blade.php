 @extends('components.user.layouts.app')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
 
<div class="min-h-screen bg-[#0b0f1a] text-white overflow-x-hidden">
    
    <section class="relative min-h-screen flex items-center px-8 md:px-20 overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px]"></div>

        <div class="grid md:grid-cols-2 gap-12 items-center z-10 w-full">
            <div data-aos="fade-right" data-aos-duration="1200">
                <span class="text-blue-500 font-bold tracking-[0.3em] uppercase text-xs mb-4 block">WELCOME TO HAPON STORE</span>
                <h1 class="text-5xl md:text-8xl font-black mb-6 leading-tight italic">
                    UPGRADE <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">YOUR STYLE</span>
                </h1>
                <p class="text-gray-400 text-lg mb-8 max-w-md">Hel qalabka ugu casrisan ee Laptops iyo Phones.</p>
                <div class="flex gap-4">
                    <button class="px-10 py-4 bg-blue-600 rounded-full font-bold shadow-[0_0_20px_rgba(37,99,235,0.4)] hover:scale-105 transition-transform">Shop Now</button>
                    <button class="px-10 py-4 border border-gray-700 rounded-full font-bold hover:border-blue-500 transition-all">View Deals</button>
                </div>
            </div>

            <div class="relative flex justify-center items-center" data-aos="fade-left">
    <div style="position: absolute; width: 300px; height: 300px; background: rgba(59, 130, 246, 0.2); filter: blur(80px); border-radius: 50%;"></div>
    
    <img src="{{ asset('images/image1.jpg') }}" 
         class="relative z-20 animate-float"
         style="
            width: 70%; 
            max-width: 450px; 
            mix-blend-mode: multiply; 
            filter: contrast(1.1);
         ">
</div>
        </div>
    </section>

    <section class="py-24 px-8 md:px-20 bg-[#0d121f]">
        <div class="mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-black italic uppercase">Featured & Trending</h2>
            <div class="h-1 w-20 bg-blue-600 mt-2"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="group bg-[#161b22] border border-gray-800 p-6 rounded-[2.5rem] hover:border-blue-500/50 transition-all" data-aos="fade-up">
                <div class="h-48 flex items-center justify-center mb-6 overflow-hidden rounded-2xl bg-[#0b0f1a]">
                    <img src="{{ asset('images/image2.jpg') }}" class="h-full w-full object-cover group-hover:scale-110 transition-all duration-500">
                </div>
                <h3 class="font-bold text-gray-200">Modern Device</h3>
                <div class="flex justify-between items-center mt-4">
                    <span class="text-blue-400 font-black text-xl">$850</span>
                    <button class="p-3 bg-blue-600 rounded-full hover:bg-blue-500 transition-all">🛒</button>
                </div>
            </div>

            <div class="group bg-[#161b22] border border-gray-800 p-6 rounded-[2.5rem] hover:border-blue-500/50 transition-all" data-aos="fade-up" data-aos-delay="100">
                <div class="h-48 flex items-center justify-center mb-6 overflow-hidden rounded-2xl bg-[#0b0f1a]">
                    <img src="{{ asset('images/image3.jpg') }}" class="h-full w-full object-cover group-hover:scale-110 transition-all duration-500">
                </div>
                <h3 class="font-bold text-gray-200">Premium Laptop</h3>
                <div class="flex justify-between items-center mt-4">
                    <span class="text-blue-400 font-black text-x11">$1,400</spa>
                    <button class="p-3 bg-blue-600 rounded-full hover:bg-blue-500 transition-all">🛒</button>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 px-8 md:px-20 relative overflow-hidden">
        <div style="position: absolute; bottom: 0; right: 0; width: 400px; height: 400px; background: rgba(37, 99, 235, 0.1); border-radius: 50%; filter: blur(100px); z-index: 0;"></div>

        <div class="flex justify-between items-end mb-12 relative z-10" data-aos="fade-up">
            <div>
                <span class="text-blue-500 font-bold tracking-widest text-xs uppercase mb-2 block">Best Sellers</span>
                <h2 class="text-4xl md:text-5xl font-black italic">LOVED BY EVERYONE.</h2>
            </div>
            <a href="#" class="text-gray-400 hover:text-blue-400 font-bold transition-all border-b border-gray-800">See full menu →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 relative z-10">
            <div class="group relative bg-[#161b22]/50 backdrop-blur-md border border-gray-800 p-8 rounded-[3rem] hover:bg-[#1c232d] transition-all duration-500" data-aos="zoom-in-up">
                <div class="absolute top-6 left-6 bg-blue-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase">Bestseller</div>
                <div class="h-64 flex items-center justify-center mb-6">
                    <img src="{{ asset('images/image4.jpg') }}" class="h-full object-contain group-hover:scale-110 transition-all duration-700 drop-shadow-[0_20px_30px_rgba(0,0,0,0.5)]">
                </div>
                <div class="text-center">
                    <h3 class="text-xl font-bold text-white mb-2 italic">Classic Headphone</h3>
                    <p class="text-gray-500 text-sm mb-4">High fidelity sound, crafted for comfort.</p>
                    <span class="text-2xl font-black text-blue-400">$299.00</span>
                </div>
            </div>

            <div class="group relative bg-[#161b22]/50 backdrop-blur-md border border-gray-800 p-8 rounded-[3rem] hover:bg-[#1c232d] transition-all duration-500" data-aos="zoom-in-up" data-aos-delay="200">
                <div class="h-64 flex items-center justify-center mb-6">
                    <img src="{{ asset('images/image5.jpg') }}" class="h-full object-contain group-hover:scale-110 transition-all duration-700 drop-shadow-[0_20px_30px_rgba(0,0,0,0.5)]">
                </div>
                <div class="text-center">
                    <h3 class="text-xl font-bold text-white mb-2 italic">Smart Watch S8</h3>
                    <p class="text-gray-500 text-sm mb-4">Your health, on your wrist, every day.</p>
                    <span class="text-2xl font-black text-blue-400">$350.00</span>
                </div>
            </div>

            <div class="group relative bg-[#161b22]/50 backdrop-blur-md border border-gray-800 p-8 rounded-[3rem] hover:bg-[#1c232d] transition-all duration-500" data-aos="zoom-in-up" data-aos-delay="400">
                <div class="absolute top-6 left-6 bg-orange-500 text-[10px] font-bold px-3 py-1 rounded-full uppercase">Hot</div>
                <div class="h-64 flex items-center justify-center mb-6">
                    <img src="{{ asset('images/image6.jpg') }}" class="h-full object-contain group-hover:scale-110 transition-all duration-700 drop-shadow-[0_20px_30px_rgba(0,0,0,0.5)]">
                </div>
                <div class="text-center">
                    <h3 class="text-xl font-bold text-white mb-2 italic">Pro Earbuds</h3>
                    <p class="text-gray-500 text-sm mb-4">Noise cancellation with crystal clarity.</p>
                    <span class="text-2xl font-black text-blue-400">$180.00</span>
                </div>
            </div>
        </div>
    </section>
    <section class="py-24 px-8 md:px-20 relative bg-[#0b0f1a]">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 600px; height: 300px; background: rgba(37, 99, 235, 0.05); border-radius: 50%; filter: blur(120px); z-index: 0;"></div>

        <div class="grid md:grid-cols-2 gap-16 items-center relative z-10">
            <div class="relative order-2 md:order-1" data-aos="fade-right">
                <div class="absolute inset-0 bg-blue-600/10 blur-[80px] rounded-full"></div>
                <img src="{{ asset('images/image7.jpg') }}" class="relative z-20 w-full rounded-[3rem] shadow-2xl border border-gray-400/50">
            </div>

            <div class="order-1 md:order-2" data-aos="fade-left">
                <span class="text-blue-500 font-bold tracking-widest text-xs uppercase mb-4 block">Quality Control</span>
                <h2 class="text-4xl md:text-6xl font-black mb-8 italic leading-tight">EVERY LAYER <br> <span class="text-blue-400">MATTERS.</span></h2>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="mt-1 p-2 bg-blue-600/20 rounded-lg">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-lg">100% Genuine Products</h4>
                            <p class="text-gray-500 text-sm">Dhammaan qalabkayagu waa kuwo orinal ah oo la hubiyey.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="mt-1 p-2 bg-blue-600/20 rounded-lg">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-lg">Rigorous Testing</h4>
                            <p class="text-gray-500 text-sm">Qalab kasta wuxuu maraa baadhitaan farsamo ka hor intaan la soo bandhigin.</p>
                        </div>
                        
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="mt-1 p-2 bg-blue-600/20 rounded-lg">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-lg">Full Warranty</h4>
                            <p class="text-gray-500 text-sm">Waxaan bixinaa dammaanad buuxda si aad ugu qanacdo iibsashadaada.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: false });
</script>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    .animate-float { animation: float 4s ease-in-out infinite; }
</style>
@endsection