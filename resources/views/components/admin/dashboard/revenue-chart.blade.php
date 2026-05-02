@php 
    $revenueData = [
        ['month' => 'Jan', 'revenue' => 45000, 'expenses' => 32000],
        ['month' => 'Feb', 'revenue' => 52000, 'expenses' => 38000],
        ['month' => 'Mar', 'revenue' => 48000, 'expenses' => 35000],
        ['month' => 'Apr', 'revenue' => 61000, 'expenses' => 42000],
        ['month' => 'May', 'revenue' => 55000, 'expenses' => 48000],
        ['month' => 'Jun', 'revenue' => 67000, 'expenses' => 45000],
        ['month' => 'Jul', 'revenue' => 72000, 'expenses' => 48000],
        ['month' => 'Aug', 'revenue' => 69000, 'expenses' => 46000],
        ['month' => 'Sep', 'revenue' => 78000, 'expenses' => 52000],
        ['month' => 'Oct', 'revenue' => 74000, 'expenses' => 50000],
        ['month' => 'Nov', 'revenue' => 82000, 'expenses' => 55000],
        ['month' => 'Dec', 'revenue' => 89000, 'expenses' => 58000],
    ];
@endphp
<div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-2xl border border-slate-200/50 dark:border-slate-700/50 p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h3 class="text-xl font-bold text-slate-800 dark:text-white">
                Revenue Chart
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Monthly revenue and expenses
            </p>
        </div>

        {{-- Legend --}}
        <div class="flex items-center space-x-4">

            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                <span class="text-sm text-slate-600 dark:text-slate-400">Revenue</span>
            </div>

            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-slate-500 rounded-full"></div>
                <span class="text-sm text-slate-600 dark:text-slate-400">Expenses</span>
            </div>

        </div>

    </div>

    {{-- Chart --}}
    <div class="h-80">
        <canvas id="revenueChart"></canvas>
    </div>

</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const revenueData = @json($revenueData);

    const labels = revenueData.map(item => item.month);
    const revenue = revenueData.map(item => item.revenue);
    const expenses = revenueData.map(item => item.expenses);

    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Revenue',
                    data: revenue,
                    backgroundColor: '#3b82f6',
                    borderRadius: 6
                },
                {
                    label: 'Expenses',
                    data: expenses,
                    backgroundColor: '#64748b',
                    borderRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return '$' + context.raw.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: function(value) {
                            return '$' + value / 1000 + 'k';
                        }
                    }
                }
            }
        }
    });
</script>
@endpush