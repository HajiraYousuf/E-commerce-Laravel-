  @extends('components.user.layouts.app')

@section('content')
<style>
    /* 1. QURXINTA LINE-KA IYO BADHAMADA (CSS) */
    .category-btn {
        padding-bottom: 1rem;
        color: #6b7280;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        position: relative;
        transition: all 0.3s ease;
        background: none;
        border: none;
        cursor: pointer;
        min-width: max-content;
    }

    .category-btn.active { 
        color: white; 
    }

    /* Line-ka hoos mara badhanka la doortay */
    .category-btn::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 0;
        height: 3px;
        background-color: #2563eb;
        transition: width 0.3s ease;
        border-radius: 99px;
    }

    .category-btn.active::after {
        width: 100%;
        box-shadow: 0 0 15px rgba(37, 99, 235, 0.8);
    }

    .no-scrollbar::-webkit-scrollbar { display: none; }
    
    /* Animation-ka marka sawiradu soo baxayaan ama qarsoomayaan */
    .product-item { 
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
    }
</style>

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
            <p class="mt-4 text-gray-400 text-lg max-w-xl mx-auto leading-relaxed italic">
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

        <div class="py-10">
            <div class="mb-10">
                <h2 class="text-4xl md:text-6xl font-black italic uppercase leading-none text-white">
                    CRAFTED <br> WITH CARE.
                </h2>
                <p class="text-gray-400 mt-4 font-medium">Dooro qaybta aad rabto - waxaan kuu haynaa tayada ugu sarreysa.</p>
            </div>

            <div class="flex items-center gap-10 border-b border-gray-800/50 mb-12 overflow-x-auto pb-4 no-scrollbar">
                <button class="category-btn active" onclick="filterProducts('all', this)">ALL</button>
                <button class="category-btn" onclick="filterProducts('laptops', this)">LAPTOPS</button>
                <button class="category-btn" onclick="filterProducts('samsung', this)">SAMSUNG</button>
                <button class="category-btn" onclick="filterProducts('iphone', this)">IPHONE</button>
                <button class="category-btn" onclick="filterProducts('headphone', this)">HEADPHONE</button>
                <button class="category-btn" onclick="filterProducts('smartwatch', this)">SMART WATCH</button>
            </div>

<div id="product-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">

    @php
    $products = [

        // HEADPHONES
        [
            'name' => 'Airpods Pro',
            'price' => '$50',
            'img' => 'image1.jpg',
            'cat' => 'headphone'
        ],

        [
            'name' => 'Gaming Headset',
            'price' => '$60',
            'img' => 'image6.jpg',
            'cat' => 'headphone'
        ],

        [
            'name' => 'Sony Headphones',
            'price' => '$60',
            'img' => 'image9.jpg',
            'cat' => 'headphone'
        ],

        [
            'name' => 'Beats Solo',
            'price' => '$60',
            'img' => 'image10.jpg',
            'cat' => 'headphone'
        ],

        // IPHONE
        [
            'name' => 'iPhone 16 PRO',
            'price' => '$1000',
            'img' => 'image2.jpg',
            'cat' => 'iphone'
        ],

        // LAPTOPS
        [
            'name' => 'MacBook Air',
            'price' => '$570',
            'img' => 'image8.jpg',
            'cat' => 'laptops'
        ],

       

        [
            'name' => 'HP Spectre',
            'price' => '$300',
            'img' => 'image3.jpg',
            'cat' => 'laptops'
        ],

        [
            'name' => 'HP Spectre',
            'price' => '$300',
            'img' => 'image4.jpg',
            'cat' => 'laptops'
        ],

        // SAMSUNG
        [
            'name' => 'Samsung S24 Ultra',
            'price' => '$900',
            'img' => 'image14.jpg',
            'cat' => 'samsung'
        ],

        // SMARTWATCH
        [
            'name' => 'Apple Watch 8',
            'price' => '$80',
            'img' => 'image11.jpg',
            'cat' => 'smartwatch'
        ],

        [
            'name' => 'Samsung Watch 6',
            'price' => '$80',
            'img' => 'image5.jpg',
            'cat' => 'samsung smartwatch'
        ],

        [
            'name' => 'Samsung Watch 6',
            'price' => '$80',
            'img' => 'image5.jpg',
            'cat' => 'samsung smartwatch'
        ],
        
        [
            'name' => 'Pixel Watch',
            'price' => '$80',
            'img' => 'image2.jpg',
            'cat' => 'smartwatch'
        ],

    ];
    @endphp
                @foreach($products as $item)
                <div class="product-item {{ $item['cat'] }} group bg-[#111827] border border-gray-800 rounded-2xl p-3 transition-all duration-300 hover:shadow-[0_0_25px_rgba(59,130,246,0.1)] active:scale-95 cursor-pointer">
                    <div class="relative h-36 w-full bg-gray-900/50 rounded-xl mb-3 flex justify-center items-center overflow-hidden">
                        <img src="{{ asset('images/' . $item['img']) }}" 
                             class="max-h-[80%] object-contain group-hover:rotate-3 group-hover:scale-110 transition-transform duration-500 brightness-110">
                    </div>
                    

                    <div class="text-center">
                        <h3 class="text-gray-300 text-[11px] font-bold truncate uppercase tracking-tighter">{{ $item['name'] }}</h3>
                        <p class="text-blue-500 font-black text-sm mt-1">{{ $item['price'] }}</p>
 <a href="{{ route('products.show', ['id' => $item['cat']]) }}" class="block w-full text-center mt-3 py-2 bg-blue-600 hover:bg-blue-500 text-[10px] text-white font-bold rounded-lg uppercase transition-all shadow-lg shadow-blue-900/20">
    Add to cart
</a>
                    </div>
                    
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <footer class="mt-24 py-12 border-t border-gray-800 bg-[#0f172a]">
        <div class="container mx-auto px-6 text-center">
            <a href="/more-info" class="text-blue-500 hover:text-blue-400 font-bold text-sm transition-all inline-flex items-center group">
                For More Information 
                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
            <p class="text-gray-600 text-[10px] mt-6 tracking-[0.3em] uppercase">
                HH Electronics &copy; 2026
            </p>
        </div>
    </footer>
</div>

<script>
    function filterProducts(category, btn) {
        // A. Isbeddelka Badhamada (Line-ka Buluugga ah)
        const buttons = document.querySelectorAll('.category-btn');
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // B. Kala Sifeynta Sawirrada
        const items = document.querySelectorAll('.product-item');
        
        items.forEach(item => {
            // Haddii la doortay 'all' ama category-gu uu u jiro class-ka item-ka
            if (category === 'all' || item.classList.contains(category)) {
                item.style.display = 'block';
                // Animasiyo yar oo soo boodaya ah
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'scale(1)';
                }, 10);
            } else {
                // Qarinta kuwa aan loo baahnayn
                item.style.opacity = '0';
                item.style.transform = 'scale(0.7)';
                setTimeout(() => {
                    item.style.display = 'none';
                }, 300);
            }
        });
    }

    // Marka bogga la furo, tusi dhammaan (All) si default ah
    document.addEventListener('DOMContentLoaded', () => {
        filterProducts('all', document.querySelector('.category-btn'));
    });
</script>
@endsection