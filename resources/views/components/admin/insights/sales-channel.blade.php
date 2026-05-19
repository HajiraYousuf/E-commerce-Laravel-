<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php
$channels = [
    ['name'=>'Online Store','value'=>14250,'color'=>'#6366f1','icon'=>'ri-shopping-bag-3-line'],
    ['name'=>'Mobile App','value'=>6180,'color'=>'#3b82f6','icon'=>'ri-smartphone-line'],
    ['name'=>'Social Media','value'=>2850,'color'=>'#22c55e','icon'=>'ri-instagram-line'],
    ['name'=>'Marketplace','value'=>1610,'color'=>'#f97316','icon'=>'ri-store-2-line'],
];

$total = array_sum(array_column($channels,'value'));
@endphp


<div class="bg-white dark:bg-gray-900 rounded-[28px] border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden h-full">

    {{-- HEADER --}}
    <div class="p-4 sm:p-6 pb-4 flex items-start justify-between gap-4">

        <div class="flex items-start gap-3">

            <div class="w-10 h-10 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center shrink-0">
                <i class="ri-pie-chart-2-line text-indigo-600 dark:text-indigo-400 text-lg"></i>
            </div>

            <div>
                <h2 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">
                    Sales Channels
                </h2>

                <p class="text-xs sm:text-sm text-gray-400 dark:text-gray-500 mt-0.5">
                    Revenue performance by platform
                </p>
            </div>

        </div>

        <button class="h-9 sm:h-10 px-3 sm:px-4 rounded-xl border border-gray-200 dark:border-gray-700 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
            View Report
        </button>

    </div>


    {{-- BODY --}}
    <div class="px-4 sm:px-6 pb-6">

        <div class="grid grid-cols-1 xl:grid-cols-[220px_1fr] gap-6 sm:gap-8 items-center">

            {{-- DONUT --}}
            <div class="flex justify-center">

                <div class="relative w-[180px] sm:w-[210px] h-[180px] sm:h-[210px]">

                    <canvas id="donutChart"></canvas>

                    <div class="absolute inset-0 flex flex-col items-center justify-center">

                        <span class="text-[10px] sm:text-xs uppercase tracking-wide text-gray-400 dark:text-gray-500">
                            Total Revenue
                        </span>

                        <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-1">
                            ${{ number_format($total) }}
                        </h3>

                        <div class="mt-2 sm:mt-3 flex items-center gap-1 text-emerald-600 dark:text-emerald-400 text-xs sm:text-sm font-medium">
                            <i class="ri-arrow-up-line"></i>
                            +18.4%
                        </div>

                    </div>

                </div>

            </div>


            {{-- LIST --}}
            <div class="space-y-3 sm:space-y-4">

                @foreach($channels as $channel)

                    @php
                        $percent = round(($channel['value']/$total)*100);
                    @endphp

                    <div class="rounded-2xl border border-gray-100 dark:border-gray-800 hover:shadow-sm transition p-3 sm:p-4 bg-white dark:bg-gray-900">

                        <div class="flex items-center justify-between gap-3">

                            <div class="flex items-center gap-3 min-w-0">

                                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl flex items-center justify-center text-lg shrink-0"
                                     style="background:{{ $channel['color'] }}15; color:{{ $channel['color'] }}">

                                    <i class="{{ $channel['icon'] }}"></i>

                                </div>

                                <div class="min-w-0">

                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate">
                                        {{ $channel['name'] }}
                                    </h4>

                                    <p class="text-xs text-gray-400 dark:text-gray-500">
                                        {{ $percent }}% of total sales
                                    </p>

                                </div>

                            </div>

                            <div class="text-right shrink-0">

                                <div class="text-sm font-bold text-gray-900 dark:text-white">
                                    ${{ number_format($channel['value']) }}
                                </div>

                                <div class="text-xs text-emerald-600 dark:text-emerald-400 mt-1 font-medium">
                                    +{{ rand(8,24) }}%
                                </div>

                            </div>

                        </div>

                        <div class="mt-3 sm:mt-4 w-full h-2 rounded-full bg-gray-100 dark:bg-gray-800 overflow-hidden">

                            <div class="h-full rounded-full transition-all duration-700"
                                 style="width:{{ $percent }}%; background:{{ $channel['color'] }}"></div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const data = @json($channels);

    let labels = [], values = [], colors = [];

    data.forEach(item => {
        labels.push(item.name);
        values.push(item.value);
        colors.push(item.color);
    });

    const ctx = document.getElementById('donutChart');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{
                data: values,
                backgroundColor: colors,
                borderWidth: 0,
                hoverOffset: 10,
                spacing: 4,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '74%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: document.documentElement.classList.contains('dark') ? '#111827' : '#111827',
                    padding: 12,
                    cornerRadius: 12,
                    displayColors: true
                }
            }
        }
    });

});
</script>