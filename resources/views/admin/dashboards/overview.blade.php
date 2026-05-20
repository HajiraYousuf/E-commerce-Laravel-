<x-layouts.app>

    <x-admin.overview.header/>
    <x-admin.overview.stat-cards :stats="$stats"/>

    {{-- MAIN SECTION --}}
    <div class="flex gap-4 mt-6 items-stretch">

        {{-- LEFT --}}
        <div class="w-1/2 flex">
            <div class="h-full w-full">
                <x-admin.overview.revenue-section
    :analytics="$analytics"
    :labels="$labels"
    :revenues="$revenues"
    :expenses="$expenses"
    :totalRevenue="$totalRevenue"
    :totalExpenses="$totalExpenses"
    :netProfit="$netProfit"
/>
            </div>
        </div>

        {{-- RIGHT --}}
        <div class="w-1/2 flex flex-col gap-4">

            <div class="flex-1">
                <x-admin.overview.user-growth :userGrowthData="$userGrowthData" />
            </div>

            <div class="flex-1">
                <x-admin.overview.user-demographics :genderData="$genderData" :totalUsers="$totalUsers" :ageData="$ageData" />
            </div>

        </div>

    </div>
    <div class="grid grid-cols-3 gap-4">
    <x-admin.overview.sales-chart 
            :salesData="$salesData"/>
    <x-admin.overview.traffic-sources :traffic="$traffic" :totalVisits="$totalVisits" :trafficColors="$trafficColors" />
    <x-admin.overview.top-regions :regions="$regions"/>
    </div>
    <x-admin.overview.insights :insights="$insights"/>

</x-layouts.app>