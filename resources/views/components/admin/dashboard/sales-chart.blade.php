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

        @php
            $colors = ['#3b82fe', '#8b5cf6', '#10b981', '#f59e0b', '#ef4444', '#06b6d4'];
        @endphp

        @forelse($salesByCategory as $index => $item)
            <div class="flex items-center justify-between">

                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full"
                         style="background-color: {{ $colors[$index % count($colors)] }}"></div>

                    <span class="text-sm text-slate-600 dark:text-slate-400">
                        {{ $item->name }}
                    </span>
                </div>

                <div class="text-sm font-semibold text-slate-800 dark:text-white">
                    {{ $item->value }}
                </div>

            </div>
        @empty
            <p class="text-sm text-gray-500">No data available</p>
        @endforelse

    </div>

</div>

{{-- CHART SCRIPT --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const salesData = @json($salesByCategory ?? []);

    const colors = ['#3b82fe', '#8b5cf6', '#10b981', '#f59e0b', '#ef4444', '#06b6d4'];

    new Chart(document.getElementById('salesChart'), {
        type: 'doughnut',
        data: {
            labels: salesData.map(i => i.name),
            datasets: [{
                data: salesData.map(i => i.value),
                backgroundColor: salesData.map((_, index) => colors[index % colors.length]),
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

});
</script>
@endpush