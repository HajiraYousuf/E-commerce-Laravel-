@php

$stats = [
    [
        'id' => 'total_products',
        'title' => 'Total Products',
        'value' => 847,
        'subtitle' => 'All products',
        'color' => 'indigo',
        'icon' => 'ri-box-3-line',
        'chart' => [12, 19, 10, 22, 18, 25, 30]
    ],
    [
        'id' => 'in_stock',
        'title' => 'In Stock',
        'value' => 652,
        'subtitle' => '77% of total',
        'color' => 'emerald',
        'icon' => 'ri-checkbox-circle-line',
        'chart' => [10, 15, 12, 18, 20, 22, 28]
    ],
    [
        'id' => 'low_stock',
        'title' => 'Low Stock',
        'value' => 48,
        'subtitle' => '6% of total',
        'color' => 'orange',
        'icon' => 'ri-error-warning-line',
        'chart' => [5, 8, 6, 10, 7, 9, 11]
    ],
    [
        'id' => 'out_stock',
        'title' => 'Out of Stock',
        'value' => 147,
        'subtitle' => '17% of total',
        'color' => 'rose',
        'icon' => 'ri-close-circle-line',
        'chart' => [8, 6, 10, 7, 9, 5, 8]
    ]
];

$colors = [
    'indigo'  => 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 border-indigo-200 dark:border-indigo-500/20',
    'emerald' => 'text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 border-emerald-200 dark:border-emerald-500/20',
    'orange'  => 'text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-500/10 border-orange-200 dark:border-orange-500/20',
    'rose'    => 'text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 border-rose-200 dark:border-rose-500/20',
];

@endphp
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

@foreach($stats as $stat)

<div class="relative bg-white dark:bg-[#0B1220]
            border border-gray-200 dark:border-[#1E293B]
            rounded-2xl p-5 shadow-sm hover:shadow-xl
            transition hover:-translate-y-1">

    <!-- ICON -->
    <div class="flex items-center justify-between">

        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">
                {{ $stat['title'] }}
            </p>

            <h2 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                {{ $stat['value'] }}
            </h2>

            <p class="text-xs mt-1 text-gray-500 dark:text-gray-500">
                {{ $stat['subtitle'] }}
            </p>
        </div>

        <!-- ICON BOX -->
        <div class="w-12 h-12 flex items-center justify-center rounded-xl
                    border {{ $colors[$stat['color']] }}">

            <i class="{{ $stat['icon'] }} text-2xl
                      text-gray-700 dark:text-white"></i>

        </div>

    </div>

    <!-- CHART -->
    <div class="mt-4">
        <canvas id="chart_{{ $stat['id'] }}" height="70"></canvas>
    </div>

</div>

@endforeach

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const stats = @json($stats);

    stats.forEach(stat => {

        const ctx = document.getElementById("chart_" + stat.id);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: stat.chart.map((_, i) => i + 1),
                datasets: [{
                    data: stat.chart,
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 0,
                    borderColor: getColor(stat.color),
                    backgroundColor: getColor(stat.color, true)
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { display: false },
                    y: { display: false }
                }
            }
        });

    });

    function getColor(color, bg = false) {
        const map = {
            indigo: bg ? 'rgba(99,102,241,0.15)' : '#6366f1',
            emerald: bg ? 'rgba(16,185,129,0.15)' : '#10b981',
            orange: bg ? 'rgba(249,115,22,0.15)' : '#f97316',
            rose: bg ? 'rgba(244,63,94,0.15)' : '#f43f5e',
        };

        return map[color] || '#6366f1';
    }

});
</script>