<x-layouts.app>
    {{-- Stats Grid --}}
    <x-admin.dashboard.stats-grid  />

    {{-- Charts Section --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="xl:col-span-2">
            <x-admin.dashboard.revenue-chart />
        </div>

        <div class="space-y-6">
            <x-admin.dashboard.sales-chart />
        </div>

    </div>

    {{-- Bottom Section --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="xl:col-span-2">
            <x-admin.dashboard.table-section/>
        </div>

        <div>
            <x-admin.dashboard.activity-feed />
        </div>

    </div>

</x-layouts.app>