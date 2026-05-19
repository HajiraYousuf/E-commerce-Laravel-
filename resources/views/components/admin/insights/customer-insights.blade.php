<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php
$customers = [
    ['title'=>'Total','value'=>1250,'trend'=>12,'color'=>'emerald','icon'=>'ri-user-line'],
    ['title'=>'New','value'=>320,'trend'=>8,'color'=>'blue','icon'=>'ri-user-add-line'],
    ['title'=>'Returning','value'=>930,'trend'=>-4,'color'=>'orange','icon'=>'ri-user-follow-line'],
];

$chartLabels = ["May 12","May 19","May 26","Jun 02","Jun 09"];
$chartData   = [200,350,500,700,1000];
@endphp

{{-- ROOT CARD --}}
<div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm h-full flex flex-col p-6">

    {{-- HEADER CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        @foreach($customers as $c)

            <div class="flex items-center justify-between p-4 rounded-2xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700">

                {{-- ICON --}}
                <div class="w-11 h-11 rounded-xl bg-{{ $c['color'] }}-100 flex items-center justify-center shrink-0">
                    <i class="{{ $c['icon'] }} text-lg text-{{ $c['color'] }}-600"></i>
                </div>

                {{-- TEXT --}}
                <div class="flex-1 px-3">
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $c['title'] }}</p>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                        {{ number_format($c['value']) }}
                    </h2>
                </div>

                {{-- TREND --}}
                <div class="text-right text-sm font-semibold">
                    @if($c['trend'] > 0)
                        <span class="text-emerald-600">+{{ $c['trend'] }}%</span>
                    @else
                        <span class="text-red-500">{{ $c['trend'] }}%</span>
                    @endif
                </div>

            </div>

        @endforeach

    </div>

    {{-- CHART AREA (PRO FIX) --}}
    <div class="flex-1 min-h-[280px] relative">

        <canvas id="customerChart"></canvas>

    </div>

</div>

{{-- CHART SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('customerChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                data: @json($chartData),

                borderColor: '#6366f1',
                borderWidth: 3,
                tension: 0.45,

                fill: true,
                backgroundColor: (context) => {
                    const chart = context.chart.ctx;
                    const gradient = chart.createLinearGradient(0, 0, 0, 300);
                    gradient.addColorStop(0, 'rgba(99,102,241,0.25)');
                    gradient.addColorStop(1, 'rgba(99,102,241,0)');
                    return gradient;
                },

                pointRadius: 4,
                pointHoverRadius: 7,
                pointBackgroundColor: '#6366f1',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: { display: false },

                tooltip: {
                    backgroundColor: document.documentElement.classList.contains('dark')
                        ? '#111827'
                        : '#ffffff',
                    titleColor: document.documentElement.classList.contains('dark')
                        ? '#fff'
                        : '#111827',
                    bodyColor: '#6b7280',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: (ctx) => '$' + ctx.raw.toLocaleString()
                    }
                }
            },

            interaction: {
                mode: 'index',
                intersect: false
            },

            scales: {

                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        color: '#9ca3af'
                    }
                },

                x: {
                    grid: { display: false },
                    ticks: {
                        color: '#9ca3af'
                    }
                }
            }
        }
    });

});
</script>