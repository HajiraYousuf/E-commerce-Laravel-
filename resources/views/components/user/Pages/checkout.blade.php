  @extends('components.user.layouts.app')

@section('content')
<div class="bg-[#0b0f1a] min-h-screen text-white font-sans py-16">
    <div class="container mx-auto px-6 max-w-xl">
        
        <div class="bg-[#111827]/60 border border-gray-800 rounded-3xl p-8 shadow-2xl backdrop-blur-md">
            <h2 class="text-2xl font-black text-center text-white uppercase tracking-tight mb-2">
                Complete Your Order
            </h2>
            <p class="text-gray-400 text-xs text-center mb-8">Fadlan buuxi foomka hoose si lagugu soo raddo alaabtaada.</p>

            <form action="#" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wide">✅ User Name</label>
                    <input type="text" name="username" required placeholder="Geli magacaaga oo buuxa" 
                           class="w-full bg-[#0b0f1a] border border-gray-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition-colors">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wide">✅ Phone Number</label>
                    <input type="tel" name="phone" required placeholder="Tusaale: +252 63 XXXXXXX" 
                           class="w-full bg-[#0b0f1a] border border-gray-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition-colors">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wide">✅ Location / Address</label>
                    <input type="text" name="location" required placeholder="Magaalada iyo Xaafada aad joogto" 
                           class="w-full bg-[#0b0f1a] border border-gray-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 transition-colors">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wide">✅ Product Selected</label>
                    <input type="text" name="product" value="{{ $productName }}" readonly 
                           class="w-full bg-gray-900/50 border border-gray-800 rounded-xl px-4 py-3 text-sm text-blue-400 font-bold focus:outline-none cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wide">✅ Delivery or Pickup</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="flex items-center justify-center gap-2 border border-gray-800 rounded-xl p-3 cursor-pointer hover:bg-blue-600/5 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-600/10 transition-all">
                            <input type="radio" name="shipping_method" value="delivery" checked class="accent-blue-500">
                            <span class="text-xs font-bold">🚚 Delivery</span>
                        </label>
                        
                        <label class="flex items-center justify-center gap-2 border border-gray-800 rounded-xl p-3 cursor-pointer hover:bg-blue-600/5 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-600/10 transition-all">
                            <input type="radio" name="shipping_method" value="pickup" class="accent-blue-500">
                            <span class="text-xs font-bold">🏬 Pickup Store</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full mt-4 py-4 bg-blue-600 hover:bg-blue-500 text-xs font-black text-white rounded-xl uppercase tracking-widest transition-all shadow-lg shadow-blue-900/20 active:scale-95">
                    Confirm Order (Gudbi Dalabka) 📦
                </button>
            </form>

        </div>
    </div>
</div>
@endsection