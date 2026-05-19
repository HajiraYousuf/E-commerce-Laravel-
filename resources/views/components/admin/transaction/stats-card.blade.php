{{-- =========================
Transaction Stats Cards
Responsive + Light/Dark + Mini Charts
========================= --}}

@php

$stats = [

    [
        'id' => 'transactions',
        'title' => 'Total Transactions',
        'value' => '1,246',
        'subtitle' => 'All time',
        'color' => 'indigo',
        'icon' => 'ri-exchange-dollar-line',
        'chart' => [12,18,15,22,19,26,30]
    ],

    [
        'id' => 'revenue',
        'title' => 'Total Revenue',
        'value' => '$258,975',
        'subtitle' => 'All time',
        'color' => 'emerald',
        'icon' => 'ri-money-dollar-circle-line',
        'chart' => [8,12,14,16,22,28,35]
    ],

    [
        'id' => 'pending',
        'title' => 'Pending Amount',
        'value' => '$12,650',
        'subtitle' => '23 transactions',
        'color' => 'amber',
        'icon' => 'ri-time-line',
        'chart' => [18,14,17,13,16,12,15]
    ],

    [
        'id' => 'refunds',
        'title' => 'Refunds',
        'value' => '$4,250',
        'subtitle' => '12 transactions',
        'color' => 'rose',
        'icon' => 'ri-refund-2-line',
        'chart' => [4,6,5,8,7,6,9]
    ],

];



$colors = [

    'indigo' =>
        'bg-indigo-500/10
         text-indigo-600
         border-indigo-200
         dark:bg-indigo-500/15
         dark:text-indigo-400
         dark:border-indigo-500/20',

    'emerald' =>
        'bg-emerald-500/10
         text-emerald-600
         border-emerald-200
         dark:bg-emerald-500/15
         dark:text-emerald-400
         dark:border-emerald-500/20',

    'amber' =>
        'bg-amber-500/10
         text-amber-600
         border-amber-200
         dark:bg-amber-500/15
         dark:text-amber-400
         dark:border-amber-500/20',

    'rose' =>
        'bg-rose-500/10
         text-rose-600
         border-rose-200
         dark:bg-rose-500/15
         dark:text-rose-400
         dark:border-rose-500/20',
];

@endphp



{{-- REMIX ICON --}}
<link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"
/>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<div class="grid grid-cols-1 sm:grid-cols-2 2xl:grid-cols-4 gap-5">

    @foreach($stats as $stat)

    <div class="relative overflow-hidden

                rounded-3xl

                border border-gray-200 dark:border-slate-800

                bg-white dark:bg-[#0F172A]

                p-5 lg:p-6

                shadow-sm hover:shadow-xl

                transition-all duration-300

                hover:-translate-y-1">

        {{-- TOP --}}
        <div class="flex items-start justify-between gap-4">

            {{-- LEFT --}}
            <div class="min-w-0">

                <p class="text-sm font-medium
                          text-gray-500 dark:text-slate-400">

                    {{ $stat['title'] }}

                </p>

                <h2 class="mt-3
                           text-3xl lg:text-4xl
                           font-bold tracking-tight
                           text-gray-900 dark:text-white">

                    {{ $stat['value'] }}

                </h2>

                <p class="mt-2 text-sm
                          text-gray-500 dark:text-slate-500">

                    {{ $stat['subtitle'] }}

                </p>

            </div>



            {{-- ICON --}}
            <div class="w-14 h-14 shrink-0

                        flex items-center justify-center

                        rounded-2xl border

                        {{ $colors[$stat['color']] }}">

                <i class="{{ $stat['icon'] }} text-2xl leading-none"></i>

            </div>

        </div>



        {{-- CHART --}}
        <div class="mt-5 h-[70px]">

            <canvas id="chart_{{ $stat['id'] }}"></canvas>

        </div>



        {{-- GLOW EFFECT --}}
        <div class="absolute -top-10 -right-10
                    w-32 h-32 rounded-full blur-3xl opacity-10

                    @if($stat['color'] == 'indigo') bg-indigo-500 @endif
                    @if($stat['color'] == 'emerald') bg-emerald-500 @endif
                    @if($stat['color'] == 'amber') bg-amber-500 @endif
                    @if($stat['color'] == 'rose') bg-rose-500 @endif">
        </div>

    </div>

    @endforeach

</div>



<script>

document.addEventListener("DOMContentLoaded", function () {

    const stats = @json($stats);

    stats.forEach(stat => {

        const ctx = document.getElementById('chart_' + stat.id);

        if (!ctx) return;

        new Chart(ctx, {

            type: 'line',

            data: {

                labels: stat.chart.map((_, i) => i + 1),

                datasets: [{

                    data: stat.chart,

                    borderWidth: 2.5,

                    tension: 0.45,

                    fill: true,

                    pointRadius: 0,

                    borderColor: getColor(stat.color),

                    backgroundColor: getColor(stat.color, true),

                }]
            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {
                        enabled: false
                    }
                },

                scales: {

                    x: {
                        display: false,
                        grid: {
                            display: false
                        }
                    },

                    y: {
                        display: false,
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

    });



    function getColor(color, bg = false) {

        const map = {

            indigo: bg
                ? 'rgba(99,102,241,0.18)'
                : '#6366f1',

            emerald: bg
                ? 'rgba(16,185,129,0.18)'
                : '#10b981',

            amber: bg
                ? 'rgba(245,158,11,0.18)'
                : '#f59e0b',

            rose: bg
                ? 'rgba(244,63,94,0.18)'
                : '#f43f5e',
        };

        return map[color] || '#6366f1';
    }

});

</script>