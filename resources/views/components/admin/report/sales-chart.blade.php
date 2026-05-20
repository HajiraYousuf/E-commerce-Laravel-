<!-- resources/views/components/sales-chart.blade.php -->

<div class="w-full bg-white dark:bg-gradient-to-b dark:from-[#0b1220] dark:to-[#0a1324] rounded-3xl p-5 border border-gray-200 dark:border-white/5 shadow-sm dark:shadow-2xl transition-colors duration-300">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <h2 class="text-gray-900 dark:text-white text-xl font-semibold tracking-wide">
            Sales Overview
        </h2>

        <form method="GET" class="flex items-center mb-4">
            <select name="range"
                    onchange="this.form.submit()"
                    class="bg-gray-100 dark:bg-[#111827] text-gray-700 dark:text-gray-300 px-3 py-2 rounded-xl border border-gray-200 dark:border-white/10 text-sm">

                <option value="daily" {{ $range=='daily'?'selected':'' }}>Daily</option>
                <option value="weekly" {{ $range=='weekly'?'selected':'' }}>Weekly</option>
                <option value="monthly" {{ $range=='monthly'?'selected':'' }}>Monthly</option>
                <option value="yearly" {{ $range=='yearly'?'selected':'' }}>Yearly</option>

            </select>
        </form>
    </div>

    {{-- CHART --}}
    <div class="w-full h-[350px] sm:h-[400px]">
        <canvas id="salesChart"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const salesData = @json($salesChart);

    const labels = salesData.map(i => i.day);
    const values = salesData.map(i => i.sales);

    const canvas = document.getElementById('salesChart');

    if (!canvas) return; // safety

    const ctx = canvas.getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, '#6366f1');
    gradient.addColorStop(1, '#4f46e5');

    if (window.salesChartInstance) {
        window.salesChartInstance.destroy();
    }

    window.salesChartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                data: values,
                backgroundColor: gradient,
                borderRadius: 6,
                borderSkipped: false,
                barThickness: 9,
                hoverBackgroundColor: '#818cf8'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
    grid: { display: false },
    ticks: {
        color: '#94a3b8',
        autoSkip: false,

        callback: function(value, index) {

            const range = "{{ $range }}";

            // DAILY → tus 5-6 points
            if (range === 'daily') {
                return [0, 4, 8, 12, 16, 20, 23].includes(index) ? this.getLabelForValue(value) : '';
            }

            // WEEKLY → tus dhammaan (7 days only)
            if (range === 'weekly') {
                return this.getLabelForValue(value);
            }

            // MONTHLY → tus only few days
            if (range === 'monthly') {
                return [0, 5, 10, 15, 20, 25, 30].includes(index) ? this.getLabelForValue(value) : '';
            }

            // YEARLY → tus months muhiim ah
            if (range === 'yearly') {
                return [0, 2, 4, 6, 8, 10].includes(index) ? this.getLabelForValue(value) : '';
            }

            return '';
        }
    }
},

                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#94a3b8',
                        callback: v => v === 0 ? '0' : (v/1000)+'K'
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.05)',
                        drawBorder: false
                    }
                }
            }
        }
    });

});
</script>