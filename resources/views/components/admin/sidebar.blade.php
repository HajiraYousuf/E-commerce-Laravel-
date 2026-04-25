<x-admin.navbar>
<div x-data="{ open: '' }"
     class="w-72 flex flex-col bg-white/80 dark:bg-slate-900/80
     backdrop-blur-xl border-r border-slate-200/50 dark:border-slate-700/50">

    {{-- LOGO --}}
    <div class="p-6 border-b border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center gap-3">

            <div class="w-11 h-11 bg-gradient-to-r from-blue-600 to-purple-600
                        rounded-xl flex items-center justify-center shadow-md">
                <span class="text-white font-bold text-lg">⚡</span>
            </div>

            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Nexus</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400">Admin Panel</p>
            </div>

        </div>
    </div>

    {{-- NAV --}}
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto text-[15px]">

        {{-- DASHBOARD --}}
        <a href="/dashboard"
           class="flex items-center justify-between px-4 py-3 rounded-xl
           bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg">
            <span>📊 Dashboard</span>
            <span class="text-xs bg-red-500 px-2 py-0.5 rounded-full">New</span>
        </a>

        {{-- ANALYTICS --}}
        <div>
            <button @click="open = open === 'analytics' ? '' : 'analytics'"
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl
                text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800/50">

                <span>📈 Analytics</span>

                <svg class="w-4 h-4 transition-transform"
                     :class="open === 'analytics' ? 'rotate-180' : ''"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open === 'analytics'" x-transition
                 class="ml-6 mt-2 space-y-1 border-l border-slate-200 dark:border-slate-700 pl-3">

                <a href="/analytics/overview"
                   class="block text-sm text-slate-600 dark:text-slate-300 hover:text-blue-500">
                    Overview
                </a>

                <a href="/analytics/reports"
                   class="block text-sm text-slate-600 dark:text-slate-300 hover:text-blue-500">
                    Reports
                </a>

                <a href="/analytics/insights"
                   class="block text-sm text-slate-600 dark:text-slate-300 hover:text-blue-500">
                    Insights
                </a>

            </div>
        </div>

        {{-- USERS --}}
        <div>
            <button @click="open = open === 'users' ? '' : 'users'"
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl
                text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800/50">

                <span>👥 Users</span>
                <span class="text-xs bg-slate-200 dark:bg-slate-700 px-2 py-0.5 rounded-full">2.4k</span>
            </button>

            <div x-show="open === 'users'" x-transition
                 class="ml-6 mt-2 space-y-1 border-l border-slate-200 dark:border-slate-700 pl-3">

                <a href="/users" class="block text-sm text-slate-600 dark:text-slate-300 hover:text-blue-500">
                    All Users
                </a>

                <a href="/users/roles" class="block text-sm text-slate-600 dark:text-slate-300 hover:text-blue-500">
                    Roles
                </a>

                <a href="/users/activity" class="block text-sm text-slate-600 dark:text-slate-300 hover:text-blue-500">
                    Activity
                </a>

            </div>
        </div>

        {{-- ECOMMERCE --}}
        <div>
            <button @click="open = open === 'ecom' ? '' : 'ecom'"
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl
                text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800/50">

                <span>🛒 E-commerce</span>
            </button>

            <div x-show="open === 'ecom'" x-transition
                 class="ml-6 mt-2 space-y-1 border-l border-slate-200 dark:border-slate-700 pl-3 ">

                <a href="/products" class="block text-sm text-slate-600 dark:text-slate-300 hover:text-blue-500">
                    Products
                </a>

                <a href="/orders" class="block text-sm text-slate-600 dark:text-slate-300 hover:text-blue-500">
                    Orders
                </a>

                <a href="/customers" class="block text-sm text-slate-600 dark:text-slate-300 hover:text-blue-500">
                    Customers
                </a>

            </div>
        </div>

        {{-- SIMPLE LINKS (FIXED ALIGNMENT) --}}
        <a href="/inventory"
           class="flex items-center justify-between px-4 py-3 rounded-xl
           hover:bg-slate-100 dark:hover:bg-slate-800/50 dark:text-slate-300">

            <span>📦 Inventory</span>

            <span class="text-xs bg-slate-200 dark:bg-slate-700 px-2 py-0.5 rounded-full">
                847
            </span>
        </a>

        <a href="/transactions"
           class=" dark:text-slate-300 px-4 py-3 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800/50">
            💳 Transactions
        </a>

        <a href="/messages"
           class=" dark:text-slate-300 flex items-center justify-between px-4 py-3 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800/50">

            <span >💬 Messages</span>

            <span class="text-xs bg-red-500 text-white px-2 py-0.5 rounded-full">
                12
            </span>
        </a>

        {{-- FIXED (THIS WAS CAUSING ROW ISSUE) --}}
        <a href="/calendar"
           class="block px-4 py-3 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800/50">
            📅 Calendar
        </a>

        <a href="/reports"
           class="block px-4 py-3 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800/50">
            📄 Reports
        </a>

        <a href="/settings"
           class="block px-4 py-3 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800/50">
            ⚙️ Settings
        </a>

    </nav>

    {{-- PROFILE --}}
    <div class="p-4 border-t border-slate-200/50 dark:border-slate-700/50">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50">

            <img src="/images/user.jpg"
                 class="w-11 h-11 rounded-full ring-2 ring-blue-500"
                 alt="user">

            <div class="min-w-0">
                <p class="text-sm font-semibold text-slate-800 dark:text-white truncate">
                    Amal
                </p>
                <p class="text-xs text-slate-500">
                    Administrator
                </p>
            </div>

        </div>
    </div>

</div>
</x-admin.navbar>