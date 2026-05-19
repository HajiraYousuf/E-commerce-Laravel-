<x-layouts.app>

    <x-admin.overview.header/>
    <x-admin.overview.stat-cards/>

    {{-- MAIN SECTION --}}
    <div class="flex gap-4 mt-6 items-stretch">

        {{-- LEFT --}}
        <div class="w-1/2 flex">
            <div class="h-full w-full">
                <x-admin.overview.revenue-section/>
            </div>
        </div>

        {{-- RIGHT --}}
        <div class="w-1/2 flex flex-col gap-4">

            <div class="flex-1">
                <x-admin.overview.user-growth/>
            </div>

            <div class="flex-1">
                <x-admin.overview.user-demographics/>
            </div>

        </div>

    </div>
    <div class="grid grid-cols-3 gap-4">
    <x-admin.overview.sales-chart/>
    <x-admin.overview.traffic-sources/>
    <x-admin.overview.top-regions/>
    </div>
    <x-admin.overview.insights/>

</x-layouts.app>