@php
    $user = auth()->user();

    $avatar = $user && $user->avatar
        ? asset('storage/' . $user->avatar)
        : 'https://ui-avatars.com/api/?name=' . urlencode($user?->name ?? 'Guest');
@endphp
<div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200/50 dark:border-slate-700/50 px-6 py-4">

    <div class="flex items-center justify-between">

        <!-- LEFT -->
        <div class="flex items-center space-x-4">

            <button class="p-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>

            <div class="hidden md:block">
                <h1 class="text-2xl font-black text-slate-800 dark:text-white">
                    Dashboard
                </h1>

                <p class="text-slate-800 dark:text-white">
                    Welcome back, {{ $user?->name ?? 'Guest' }}
                </p>
            </div>

        </div>

        <!-- CENTER SEARCH -->
        <!-- CENTER SEARCH -->
<div class="flex-1 max-w-md mx-8">

    <div class="relative">

        <i
            data-lucide="search"
            class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 z-10"
        ></i>

        <input
            type="text"
            id="globalSearch"
            placeholder="Search products, users, orders..."
            class="w-full pl-10 pr-4 py-3 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900"
        >

        <!-- RESULTS -->
        <div
            id="searchResults"
            class="absolute top-full left-0 w-full bg-white dark:bg-slate-900 rounded-2xl shadow-2xl mt-2 hidden z-50 overflow-hidden border border-slate-200 dark:border-slate-700"
        ></div>

    </div>

</div>
        <!-- RIGHT -->
        <div class="flex items-center space-x-3">

            <!-- NEW BUTTON -->
<div class="relative group">

    <!-- MAIN BUTTON -->
    <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl 
                   bg-gradient-to-r from-indigo-500 to-purple-600 
                   text-white text-sm font-medium
                   hover:shadow-lg hover:scale-[1.02] transition-all duration-200">

        <i class="ri-add-line text-lg"></i>
        New
        <i class="ri-arrow-down-s-line text-lg opacity-80"></i>

    </button>

    <!-- DROPDOWN -->
    <div class="absolute right-0 mt-3 w-56 
                bg-white dark:bg-slate-900 
                border border-gray-200 dark:border-slate-700 
                rounded-2xl shadow-xl 
                opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                transition-all duration-200 z-50 overflow-hidden">

        <!-- ITEM -->
        <a href="/admin/products/create"
           class="flex items-center gap-2 px-4 py-3 text-sm 
                  text-gray-700 dark:text-slate-200 
                  hover:bg-gray-50 dark:hover:bg-slate-800 transition">

            <i class="ri-box-3-line text-indigo-500"></i>
            Add Product
        </a>

        <a href="/admin/categories/create"
           class="flex items-center gap-2 px-4 py-3 text-sm 
                  text-gray-700 dark:text-slate-200 
                  hover:bg-gray-50 dark:hover:bg-slate-800 transition">

            <i class="ri-price-tag-3-line text-purple-500"></i>
            Add Category
        </a>

        <div class="border-t border-gray-200 dark:border-slate-700"></div>

        <a href="/admin/orders"
           class="flex items-center gap-2 px-4 py-3 text-sm 
                  text-gray-700 dark:text-slate-200 
                  hover:bg-gray-50 dark:hover:bg-slate-800 transition">

            <i class="ri-shopping-cart-line text-green-500"></i>
            View Orders
        </a>

        <a href="/admin/users-list"
           class="flex items-center gap-2 px-4 py-3 text-sm 
                  text-gray-700 dark:text-slate-200 
                  hover:bg-gray-50 dark:hover:bg-slate-800 transition">

            <i class="ri-user-line text-blue-500"></i>
            View Users
        </a>

    </div>
</div>
            <!-- THEME -->
            <button id="themeToggle" class="p-2.5 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                <i id="themeIcon" data-lucide="sun" class="w-5 h-5"></i>
            </button>

            <!-- NOTIFICATIONS -->
           <div class="relative">

    <!-- BUTTON -->
    <button id="notifBtn"
        class="p-2.5 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors relative">

        <i data-lucide="bell" class="w-5 h-5"></i>

        @if($notificationsCount > 0)
            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                {{ $notificationsCount }}
            </span>
        @endif

    </button>

    <!-- DROPDOWN -->
    <div id="notifDropdown"
    class="hidden absolute right-0 mt-4 w-[380px] max-w-[95vw]
    bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl
    border border-slate-200/70 dark:border-slate-700/70
    rounded-3xl shadow-2xl z-[9999] overflow-hidden">

    <!-- HEADER -->
    <div class="flex items-center justify-between px-5 py-4
        border-b border-slate-200 dark:border-slate-700">

        <div>
            <h3 class="text-sm font-bold text-slate-800 dark:text-white">
                Notifications
            </h3>

            <p class="text-xs text-slate-400 mt-0.5">
                Latest updates & activity
            </p>
        </div>

        <span class="px-2 py-1 text-xs rounded-full
            bg-blue-100 text-blue-600
            dark:bg-blue-500/20 dark:text-blue-400">

            {{ auth()->check() ? auth()->user()->unreadNotifications->count() : 0 }}        </span>
    </div>

    <!-- BODY -->
    <div class="max-h-[400px] overflow-y-auto">

    @auth


@forelse(auth()->user()->unreadNotifications ?? [] as $note)

    @php
        $type = $note->data['type'] ?? 'system';
    @endphp

    <a href="
        @if($type == 'order')
            /admin/orders/{{ $note->data['order_id'] }}
        @elseif($type == 'product')
            /admin/products/{{ $note->data['product_id'] }}
        @elseif($type == 'user')
            /admin/users-list/{{ $note->data['user_id'] }}
        @else
            #
        @endif
    "
    class="group flex gap-3 px-5 py-4
    hover:bg-slate-50 dark:hover:bg-slate-800/70
    transition-all duration-200
    border-b border-slate-100 dark:border-slate-800">

        <!-- ICON -->
        <div class="w-10 h-10 rounded-2xl flex items-center justify-center flex-shrink-0
            @if($type == 'user') bg-purple-100 dark:bg-purple-500/15
            @elseif($type == 'product') bg-green-100 dark:bg-green-500/15
            @elseif($type == 'order') bg-blue-100 dark:bg-blue-500/15
            @else bg-gray-100 dark:bg-gray-500/15
            @endif">

            <i data-lucide="
                @if($type == 'user') user
                @elseif($type == 'product') package
                @elseif($type == 'order') shopping-cart
                @else bell
                @endif
            "
            class="w-5 h-5
            @if($type == 'user') text-purple-600 dark:text-purple-400
            @elseif($type == 'product') text-green-600 dark:text-green-400
            @elseif($type == 'order') text-blue-600 dark:text-blue-400
            @else text-gray-600 dark:text-gray-400
            @endif"></i>

        </div>

        <!-- CONTENT -->
        <div class="flex-1 min-w-0">

            <p class="text-sm font-medium text-slate-700 dark:text-slate-200">
                {{ $note->data['message'] }}
            </p>

            <p class="text-xs text-slate-400 mt-1">
                {{ $note->created_at->diffForHumans() }}
            </p>

        </div>

    </a>

@empty

    <div class="p-6 text-center text-sm text-slate-500">
        No notifications
    </div>

@endforelse


    @else

        <div class="flex items-center justify-center py-10">
            <p class="text-sm text-slate-500">
                Please login first
            </p>
        </div>

    @endauth

</div>

    <!-- FOOTER -->
@if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
        <div class="p-4 border-t border-slate-200 dark:border-slate-700
            bg-slate-50/70 dark:bg-slate-800/40">

            <form action="{{ route('notifications.read') }}" method="POST">
                @csrf

                <button
                    class="w-full py-2.5 rounded-2xl
                    bg-gradient-to-r from-blue-500 to-indigo-600
                    text-white text-sm font-medium
                    hover:shadow-lg hover:scale-[1.01]
                    transition-all duration-200">

                    Mark all as read

                </button>

            </form>

        </div>

    @endif

</div>
</div>
            <!-- SETTINGS -->
            <a href="{{route('admin.settings')}}" class="p-2.5 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                <i data-lucide="settings" class="w-5 h-5"></i>
            </a>

            <!-- USER -->
            <div class="flex items-center space-x-3 pl-3 border-l border-slate-200 dark:border-slate-700">

                <img src="{{ $avatar }}" class="w-8 h-8 rounded-full ring-2 ring-blue-500"
                />

                <div class="hidden md:block">
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                        {{ $user->name ?? "Guest user"}}
                    </p>

                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        {{ $user->role ?? 'User' }}
                    </p>
                </div>

                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
            </div>

        </div>

    </div>
</div><script>

let input = document.getElementById('globalSearch');
let results = document.getElementById('searchResults');

let timeout = null;

input.addEventListener('keyup', function () {

    clearTimeout(timeout);

    timeout = setTimeout(async () => {

        let query = this.value.trim();

        if(query.length < 1){
            results.classList.add('hidden');
            results.innerHTML = '';
            return;
        }

        try {

            let response = await fetch(`/admin/global-search?q=${query}`);
            let data = await response.json();

            let html = '';

            // PRODUCTS
            if(data.products.length){

                html += `<div class="p-2 bg-gray-100 font-bold">Products</div>`;

                data.products.forEach(p => {
                    html += `
                        <a href="/admin/products?highlight=${p.id}" class="block px-4 py-2 hover:bg-gray-50">
                    `;
                });
            }

            // USERS
            if(data.users.length){

                html += `<div class="p-2 bg-gray-100 font-bold">Users</div>`;

                data.users.forEach(u => {
                    html += `
                        <a href="/admin/users-list?highlight=${u.id}" class="block px-4 py-2 hover:bg-gray-50">
                    `;
                });
            }

            // ORDERS
            if(data.orders.length){

                html += `<div class="p-2 bg-gray-100 font-bold">Orders</div>`;

                data.orders.forEach(o => {
                    html += `
                        <a href="/admin/orders?highlight=${o.id}" class="block px-4 py-2 hover:bg-gray-50">
                    `;
                });
            }

            if(html === ''){
                html = `<div class="p-4 text-center text-gray-500">No results found</div>`;
            }

            results.innerHTML = html;
            results.classList.remove('hidden');

        } catch (error) {
            console.log(error);
        }

    }, 300);

});

document.addEventListener('click', function(e){
    if(!input.contains(e.target) && !results.contains(e.target)){
        results.classList.add('hidden');
    }
});
document.addEventListener("DOMContentLoaded", () => {

    const btn = document.getElementById("notifBtn");
    const dropdown = document.getElementById("notifDropdown");

    if (btn && dropdown) {
        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            dropdown.classList.toggle("hidden");
        });

        document.addEventListener("click", () => {
            dropdown.classList.add("hidden");
        });
    }
});

</script>