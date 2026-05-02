@php
    $menuItems = [
    [
        "id" => "dashboard",
        "icon" => "LayoutDashboard",
        "label" => "Dashboard",
        "active" => true,
        "badge" => "New",
    ],
    [
        "id" => "analytics",
        "icon" => "BarChart3",
        "label" => "Analytics",
        "submenu" => [
            ["id" => "overview", "label" => "Overview"],
            ["id" => "reports", "label" => "Reports"],
            ["id" => "insights", "label" => "Insights"],
        ],
    ],
    [
        "id" => "users",
        "icon" => "Users",
        "label" => "Users",
        "count" => "2.4k",
        "submenu" => [
            ["id" => "all_users", "label" => "All Users"],
            ["id" => "roles", "label" => "Roles & Permissions"],
            ["id" => "activity", "label" => "User Activity"],
        ],
    ],
    [
        "id" => "ecommerce",
        "icon" => "ShoppingBag",
        "label" => "E-commerce",
        "submenu" => [
            ["id" => "products", "label" => "Products"],
            ["id" => "orders", "label" => "Orders"],
            ["id" => "customers", "label" => "Customers"],
        ],
    ],
    [
        "id" => "inventory",
        "icon" => "Package",
        "label" => "Inventory",
        "count" => "847",
    ],
    [
        "id" => "transactions",
        "icon" => "CreditCard",
        "label" => "Transactions",
    ],
    [
        "id" => "messages",
        "icon" => "MessagesSquare",
        "label" => "Messages",
        "badge" => "12",
    ],
    [
        "id" => "calendar",
        "icon" => "Calendar",
        "label" => "Calendar",
    ],
    [
        "id" => "reports",
        "icon" => "FileText",
        "label" => "Reports",
    ],
    [
        "id" => "settings",
        "icon" => "Settings",
        "label" => "Settings",
    ],
];

@endphp
<div class="w-72 h-full transition-all duration-300 ease-in-out bg-white/80 dark:bg-slate-900/80
backdrop-blur-xl border-r border-slate-200/50 dark:border-slate-700/50 flex flex-col">

    {{-- Logo --}}
    <div class="p-6 border-b border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl
            flex items-center justify-center shadow-lg">
                <i data-lucide="zap" class="w-6 h-6 text-white"></i>
            </div>

            <div>
                <h1 class="text-xl font-bold text-slate-800 dark:text-white">Nexus</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400">Admin Panel</p>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">

        @foreach($menuItems as $item)
            <div x-data="{ open: false }">

                {{-- Main Button --}}
                <button @click="open = !open"
                    class="w-full flex items-center justify-between p-3 rounded-xl transition-all duration-200
                    {{ request()->is($item['id']) || ($item['active'] ?? false)
                        ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white'
                        : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800/50'
                    }}">

                    <div class="flex items-center space-x-3">
                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5"></i>

                        <span class="font-medium ml-2">{{ $item['label'] }}</span>

                        {{-- Badge --}}
                        @if(isset($item['badge']))
                            <span class="px-2 py-1 text-xs bg-red-500 text-white rounded-full">
                                {{ $item['badge'] }}
                            </span>
                        @endif

                        {{-- Count --}}
                        @if(isset($item['count']))
                            <span class="px-2 py-1 text-xs bg-slate-200 dark:bg-slate-700
                            text-slate-600 dark:text-slate-300 rounded-full">
                                {{ $item['count'] }}
                            </span>
                        @endif
                    </div>

                    {{-- Arrow --}}
                    @if(isset($item['submenu']))
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    @endif
                </button>

                {{-- Submenu --}}
                @if(isset($item['submenu']))
                    <div x-show="open" class="ml-8 mt-2 space-y-1">
                        @foreach($item['submenu'] as $sub)
                            <a href="#"
                               class="block w-full text-left p-2 text-sm text-slate-600 
                               dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200
                               hover:bg-slate-100 dark:hover:bg-slate-800/50 rounded-lg transition-all">
                                {{ $sub['label'] }}
                            </a>
                        @endforeach
                    </div>
                @endif

            </div>
        @endforeach

    </nav>

    {{-- User Profile --}}
    <div class="p-4 border-t border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center space-x-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 p-2">
            <img src="/images/user.jpg" class="w-10 h-10 rounded-full ring-2 ring-blue-500" />
            <p class="text-sm font-medium text-slate-800 dark:text-white">Amal</p>
        </div>
    </div>

</div>

{{-- Lucide Icons --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
