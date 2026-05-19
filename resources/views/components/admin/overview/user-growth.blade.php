{{-- resources/views/components/admin/overview/user-growth.blade.php --}}

@php
$userGrowthData = [
    ['day' => 'Jan 1', 'new_users' => 4200, 'returning_users' => 2100, 'growth_rate' => 42],
    ['day' => 'Jan 3', 'new_users' => 3900, 'returning_users' => 1900, 'growth_rate' => 30],
    ['day' => 'Jan 5', 'new_users' => 4100, 'returning_users' => 2200, 'growth_rate' => 55],
    ['day' => 'Jan 7', 'new_users' => 3800, 'returning_users' => 1800, 'growth_rate' => 35],
    ['day' => 'Jan 9', 'new_users' => 4000, 'returning_users' => 2000, 'growth_rate' => 45],
    ['day' => 'Jan 11', 'new_users' => 3900, 'returning_users' => 1700, 'growth_rate' => 28],
    ['day' => 'Jan 13', 'new_users' => 4050, 'returning_users' => 2100, 'growth_rate' => 60],
    ['day' => 'Jan 15', 'new_users' => 3980, 'returning_users' => 1850, 'growth_rate' => 52],
];

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
            <span class="text-sm text-slate-600 dark:text-slate-300">New Users</span>
        </div>

        <div class="flex items-center gap-2">
            <div class="h-3 w-3 rounded-full bg-blue-500"></div>
            <span class="text-sm text-slate-600 dark:text-slate-300">Returning Users</span>
        </div>

        <div class="flex items-center gap-2">
            <div class="h-3 w-3 rounded-full bg-emerald-400"></div>
            <span class="text-sm text-slate-600 dark:text-slate-300">Growth Rate</span>
        </div>

    </div>

    {{-- CHART --}}
    <div class="h-auto">
        <canvas id="userGrowthChart"></canvas>
    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', () => {

    const ctx = document.getElementById('userGrowthChart');

    new Chart(ctx, {

        data: {

            labels: @json($labels),

            datasets: [

               {
    type: 'bar',
    label: 'New Users',
    data: @json($newUsers),

    backgroundColor: '#8B5CF6',

    borderRadius: 4,
    borderSkipped: false,

    // ❌ remove barThickness

    categoryPercentage: 0.6, // 🔥 space between groups
    barPercentage: 0.7,      // 🔥 space inside group

    yAxisID: 'y'
},

{
    type: 'bar',
    label: 'Returning Users',
    data: @json($returningUsers),

    backgroundColor: '#3B82F6',

    borderRadius: 4,
    borderSkipped: false,

    // ❌ remove barThickness

    categoryPercentage: 0.6,
    barPercentage: 0.7,

    yAxisID: 'y'
},
                {
    type: 'line',
    label: 'Growth Rate',
    data: @json($growthRate),

    borderColor: '#22C55E',
    backgroundColor: '#22C55E',

    yAxisID: 'y1',

    tension: 0.4,

    borderWidth: 1.5, // 🔥 thin line

    pointRadius: 2, // 🔥 small dots
    pointHoverRadius: 4,

    pointBackgroundColor: '#22C55E',

    fill: false
},
            ]
        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }
            },

            scales: {

                x: {

                    ticks: {
                        color: '#94A3B8'
                    },

                    grid: {
                        display: false
                    }
                },

                y: {

                    beginAtZero: true,

                    ticks: {

                        color: '#94A3B8',

                        callback: function(value) {
                            return value / 1000 + 'K';
                        }
                    },

                    grid: {
                        color: 'rgba(255,255,255,0.05)'
                    }
                },

                y1: {

                    position: 'right',

                    beginAtZero: true,

                    max: 100,

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