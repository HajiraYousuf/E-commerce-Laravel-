@php 
         $salesData = [
        ['name' => 'Electronics', 'value' => 45, 'color' => '#3b82fe'],
        ['name' => 'Clothing', 'value' => 30, 'color' => '#8b5cf6'],
        ['name' => 'Books', 'value' => 15, 'color' => '#10b981'],
        ['name' => 'Other', 'value' => 10, 'color' => '#f59e0b'],
    ];

@endphp
<div class="bg-white dark:bg-slate-900 backdrop-blur-xl rounded-b-2xl p-6 border border-slate-200/50 dark:border-slate-700/50">

    {{-- Header --}}
    <div class="mb-6">
        <h3 class="text-lg font-bold text-slate-800 dark:text-white">
            Sales by Category
        </h3>
        <p class="text-sm text-slate-500 dark:text-slate-400">
            Product Distribution
        </p>
    </div>

    {{-- Chart --}}
    <div class="h-48">
        <canvas id="salesChart"></canvas>
    </div>

    {{-- Legend --}}
    <div class="space-y-3 mt-4">

        @foreach($salesData as $item)
            <div class="flex items-center justify-between">

                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full"
                         style="background-color: {{ $item['color'] }}"></div>

                    <span class="text-sm text-slate-600 dark:text-slate-400">
                        {{ $item['name'] }}
                    </span>
                </div>

                <div class="text-sm font-semibold text-slate-800 dark:text-white">
                    {{ $item['value'] }}%
                </div>

            </div>
        @endforeach

    </div>

</div>

{{-- CHART SCRIPT (merged inside same file) --}}
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