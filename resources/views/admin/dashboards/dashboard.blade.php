<x-layouts.app>
    {{-- Stats Grid --}}
    <x-admin.dashboard.stats-grid :stats="$stats"  />

    {{-- Charts Section --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="xl:col-span-2">
            <x-admin.dashboard.revenue-chart :revenueData="$revenueData"/>
        </div>

        <div class="space-y-6">
            <x-admin.dashboard.sales-chart :salesByCategory="$salesByCategory"/>
        </div>

    </div>

    {{-- Bottom Section --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="xl:col-span-2">
            <x-admin.dashboard.table-section
                :recentOrders="$recentOrders"
                :topProducts="$topProducts"
            />
        </div>

        <div>
            <x-admin.dashboard.activity-feed   :activities="$activities" />
        </div>

    </div>

</x-layouts.app>