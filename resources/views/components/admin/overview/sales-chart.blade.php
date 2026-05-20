<div class="bg-white dark:bg-slate-900 backdrop-blur-xl rounded-b-2xl p-6 border border-slate-200/50 dark:border-slate-700/50">

    {{-- Header --}}
    <div class="mb-6">
        <h3 class="text-lg font-bold text-slate-800 dark:text-white">
            Sales by Category
        </h3>
        <p class="text-sm text-slate-500 dark:text-slate-400">
            Detailed breakdown by product category
        </p>
    </div>

    {{-- MAIN ROW --}}
    <div class="flex items-center justify-between gap-6">

        {{-- LEFT: CHART --}}
        <div class="w-1/2 flex justify-center">
            <div class="h-48 w-48">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        {{-- RIGHT: LEGEND --}}
        <div class="w-1/2 space-y-4">

            @foreach($salesData as $item)
                <div class="flex justify-between items-center">

                    {{-- LEFT --}}
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 rounded-full"
                             style="background-color: {{ $item['color'] }}"></div>

                        <span class="text-sm text-slate-600 dark:text-slate-400">
                            {{ $item['name'] }}
                        </span>
                    </div>

                    {{-- RIGHT --}}
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-slate-500">
                            {{ number_format($item['total']) }}
                        </span>

                        <span class="text-sm font-semibold text-slate-800 dark:text-white">
                            {{ $item['value'] }}%
                        </span>
                    </div>

                </div>
            @endforeach

        </div>

    </div>

</div>
{{-- CHART --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const salesData = @json($salesData);

    new Chart(document.getElementById('salesChart'), {
        type: 'doughnut',
        data: {
            labels: salesData.map(i => i.name),
            datasets: [{
                data: salesData.map(i => i.value),
                backgroundColor: salesData.map(i => i.color),
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            cutout: '65%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush