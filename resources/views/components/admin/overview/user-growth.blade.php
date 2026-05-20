{{-- resources/views/components/admin/overview/user-growth.blade.php --}}

@php

$labels = collect($userGrowthData)->pluck('day');

$newUsers = collect($userGrowthData)->pluck('new_users');

$returningUsers = collect($userGrowthData)->pluck('returning_users');

$growthRate = collect($userGrowthData)->pluck('growth_rate');

@endphp


<div class="rounded-3xl border border-slate-200 dark:border-white/10 
bg-white dark:bg-[#081028] p-6 shadow-xl dark:shadow-2xl h-auto">

    {{-- HEADER --}}
    <div class="mb-6 flex items-start justify-between">

        <div>

            <h2 class="text-xl font-semibold text-slate-800 dark:text-white">
                User Growth
            </h2>

            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                User growth and retention analysis
            </p>

        </div>

        <button
            class="rounded-xl border border-slate-200 dark:border-white/10 
            bg-slate-100 dark:bg-[#111827] px-4 py-2 text-sm 
            text-slate-700 dark:text-slate-300"
        >
            Daily
        </button>

    </div>

    {{-- LEGEND --}}
    <div class="mb-6 flex flex-wrap gap-5">

        <div class="flex items-center gap-2">
            <div class="h-3 w-3 rounded-full bg-violet-500"></div>
            <span class="text-sm text-slate-600 dark:text-slate-300">
                New Users
            </span>
        </div>

        <div class="flex items-center gap-2">
            <div class="h-3 w-3 rounded-full bg-blue-500"></div>
            <span class="text-sm text-slate-600 dark:text-slate-300">
                Returning Users
            </span>
        </div>

        <div class="flex items-center gap-2">
            <div class="h-3 w-3 rounded-full bg-emerald-400"></div>
            <span class="text-sm text-slate-600 dark:text-slate-300">
                Growth Rate
            </span>
        </div>

    </div>

    {{-- CHART --}}
    <div class="h-auto">

        <canvas id="userGrowthChart"></canvas>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', () => {

    const labels = @json($labels);
    const newUsers = @json($newUsers);
    const returningUsers = @json($returningUsers);
    const growthRate = @json($growthRate);

    const ctx = document.getElementById('userGrowthChart');

    new Chart(ctx, {

        data: {
            labels: labels,

            datasets: [

                // NEW USERS
                {
                    type: 'bar',
                    label: 'New Users',
                    data: newUsers,
                    backgroundColor: '#8B5CF6',
                    borderRadius: 6,
                    borderSkipped: false,
                    categoryPercentage: 0.6,
                    barPercentage: 0.7,
                    yAxisID: 'y'
                },

                // RETURNING USERS
                {
                    type: 'bar',
                    label: 'Returning Users',
                    data: returningUsers,
                    backgroundColor: '#3B82F6',
                    borderRadius: 6,
                    borderSkipped: false,
                    categoryPercentage: 0.6,
                    barPercentage: 0.7,
                    yAxisID: 'y'
                },

                // GROWTH RATE
                {
                    type: 'line',
                    label: 'Growth Rate',
                    data: growthRate,
                    borderColor: '#22C55E',
                    backgroundColor: '#22C55E',
                    yAxisID: 'y1',
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    fill: false
                }
            ]
        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                },

                tooltip: {
                    callbacks: {
                        label: function(context) {

                            // show % for growth rate
                            if (context.dataset.label === 'Growth Rate') {
                                return context.raw + '%';
                            }

                            return context.dataset.label + ': ' + context.raw;
                        }
                    }
                }
            },

            scales: {

                // X AXIS (DAYS)
                x: {
                    ticks: {
                        color: '#94A3B8',
                        maxRotation: 0,
                        autoSkip: true,
                        maxTicksLimit: 7
                    },
                    grid: {
                        display: false
                    }
                },

                // LEFT Y AXIS (USERS COUNT)
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#94A3B8'
                    },
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)'
                    }
                },

                // RIGHT Y AXIS (GROWTH %)
                y1: {
                    position: 'right',
                    beginAtZero: false,

                    // FIX: dynamic scaling (IMPORTANT)
                    suggestedMin: Math.min(...growthRate) - 10,
                    suggestedMax: Math.max(...growthRate) + 10,

                    ticks: {
                        color: '#94A3B8',
                        callback: function(value) {
                            return value + '%';
                        }
                    },

                    grid: {
                        display: false
                    }
                }
            }
        }
    });

});
</script>