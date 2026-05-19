  @extends('components.user.layouts.app')

@section('content')
<div class="bg-[#0b0f1a] min-h-screen text-white font-sans py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-black mb-8 uppercase italic tracking-wider text-blue-500">My Saved Wishlist</h1>

        @if(count($wishlistItems) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($wishlistItems as $id => $item)
                    <div class="bg-[#111827]/40 border border-gray-800 p-4 rounded-2xl backdrop-blur-sm flex flex-col justify-between">
                        <div>
                            <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="h-40 w-full object-contain mb-4">
                            <h3 class="text-sm font-bold uppercase tracking-wide">{{ $item['name'] }}</h3>
                            <span class="text-blue-400 font-black text-lg block mt-1">{{ $item['price'] }}</span>
                        </div>
                        <a href="{{ route('products.show', ['id' => $id]) }}" class="block text-center mt-4 py-2 bg-blue-600 hover:bg-blue-500 text-[10px] text-white font-bold rounded-lg uppercase tracking-wider">
                            View Product
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 border border-dashed border-gray-800 rounded-3xl">
                <p class="text-gray-500 text-sm mb-4">Your wishlist is currently empty saxiib.</p>
                <a href="/products" class="inline-block px-6 py-2 bg-blue-600 text-xs font-bold rounded-lg uppercase">Go Shopping</a>
            </div>
        @endif
    </div>
</div>
@endsection