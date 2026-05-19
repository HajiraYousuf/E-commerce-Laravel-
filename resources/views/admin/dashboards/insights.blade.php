<x-layouts.app>

    <div class="space-y-6 p-4 sm:p-6 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">
                    Insights Dashboard
                </h1>

                <p class="text-sm sm:text-base text-gray-500 dark:text-gray-400 mt-1">
                    Track your e-commerce performance and analytics.
                </p>
            </div>

            <button class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition w-full sm:w-auto">
                Export Report
            </button>

        </div>


        {{-- STAT CARDS --}}
        <x-admin.insights.stat-cards />


        {{-- CHART + SALES  --}}
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

            <div class="xl:col-span-6">
                <x-admin.insights.revenue-chart />
            </div>

            <div class="xl:col-span-6">
                <x-admin.insights.sales-channel />
            </div>

        </div>


        {{-- SECOND SECTION --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

            <div class="lg:col-span-4 h-full">
                <x-admin.insights.revenue-category />
            </div>

            {{-- <div class="lg:col-span-4">
                <x-admin.insights.top-products />
            </div> --}}

            <div class="lg:col-span-3 h-full">
                <x-admin.insights.risk-alerts />
            </div>

            <div class="lg:col-span-5 h-full">
                <x-admin.insights.customer-insights />
            </div>

        </div>


        {{-- LAST SECTION --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <div class="lg:col-span-6">
                <x-admin.insights.traffic-overview />
            </div>

            <div class="lg:col-span-6">
                <x-admin.insights.traffic-sources />
            </div>

        </div>

    </div>

</x-layouts.app>
{{-- 
@php

$products = [
    ['name' => 'Wireless Headphones', 'sales' => '$2,420'],
    ['name' => 'Smart Watch', 'sales' => '$1,850'],
    ['name' => 'Running Shoes', 'sales' => '$1,520'],
    ['name' => 'Backpack', 'sales' => '$1,210'],
];

@endphp

<div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">

    <h2 class="text-xl font-bold text-gray-900 mb-6">
        Top Products
    </h2>


    <div class="space-y-4">

        @foreach($products as $product)

            <div class="flex items-center justify-between p-4 rounded-2xl border border-gray-100 hover:bg-gray-50 transition">

                <div class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center">
                        <i class="ri-shopping-bag-line text-gray-500"></i>
                    </div>

                    <span class="font-medium text-gray-800">
                        {{ $product['name'] }}
                    </span>

                </div>

                <span class="font-bold text-indigo-600">
                    {{ $product['sales'] }}
                </span>

            </div>

        @endforeach

    </div>

</div> --}}
