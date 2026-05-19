{{-- =========================
resources/views/dashboard.blade.php
========================= --}}

<x-layouts.app>
<div class="min-h-screen p-4 sm:p-6 transition-colors duration-300">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white">
            Reports Dashboard
        </h1>

        <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm sm:text-base">
            View and export detailed reports
        </p>
    </div>

    {{-- STATS CARDS --}}
    <div class="mb-6">
        <x-admin.report.stats />
    </div>

    {{-- MIDDLE SECTION --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

        {{-- LEFT (CHART) --}}
        <div class="xl:col-span-2">
            <x-admin.report.sales-chart />
        </div>

        {{-- RIGHT (CATEGORY) --}}
        <div>
            <x-admin.report.report-category />
        </div>

    </div>


    {{-- TABLE + EXPORT + RECENT --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

        {{-- LEFT SIDE (TABLE + EXPORT stacked) --}}
        <div class="xl:col-span-2 flex flex-col gap-6">

            {{-- TOP SELLING TABLE --}}
            <x-admin.report.top-products />

            {{-- EXPORT REPORTS --}}
            <x-admin.report.export-report />

        </div>

        {{-- RIGHT SIDE --}}
        <div>
            <x-admin.report.recent-report />
        </div>

    </div>

</div>
</x-layouts.app>