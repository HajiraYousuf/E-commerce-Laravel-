<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50
dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 transition-all duration-500">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    <x-admin.sidebar :menu-items="$menuItems" />

    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Navbar --}}
        <x-admin.navbar />

        {{-- MAIN CONTENT --}}
        <main class="flex-1 overflow-y-auto">
            <div class="p-6 space-y-6">

                {{-- ✅ Stats Grid (FIXED) --}}
                <x-admin.stats-grid :stats="$stats" />

                {{-- Charts Section --}}
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                    <div class="xl:col-span-2">
                        <x-admin.revenue-chart :revenue-data="$revenueData" />                    </div>

                    <div class="space-y-6">
                        <x-admin.sales-chart :sales-data="$salesData" />
                    </div>

                </div>

                {{-- Bottom Section --}}
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                    <div class="xl:col-span-2">
                        <x-admin.table-section
                            :recent-orders="$recentOrders"
                            :top-products="$topProducts"
                        />
                    </div>

                    <div>
                        <x-admin.activity-feed :activities="$activities" />                    </div>

                </div>

            </div>
        </main>

    </div>
</div>

{{-- ✅ IMPORTANT: scripts stack --}}
@stack('scripts')

</body>
</html>