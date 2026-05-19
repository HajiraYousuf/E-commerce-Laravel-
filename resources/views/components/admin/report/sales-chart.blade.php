<!-- resources/views/components/sales-chart.blade.php -->

<div class="w-full bg-white dark:bg-gradient-to-b dark:from-[#0b1220] dark:to-[#0a1324] rounded-3xl p-5 border border-gray-200 dark:border-white/5 shadow-sm dark:shadow-2xl transition-colors duration-300">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <h2 class="text-gray-900 dark:text-white text-xl font-semibold tracking-wide">
            Sales Overview
        </h2>

        <select class="bg-gray-100 dark:bg-[#111827] text-gray-700 dark:text-gray-300 px-3 py-2 rounded-xl border border-gray-200 dark:border-white/10 text-sm">
            <option>Monthly</option>
        </select>

    </div>

    {{-- CHART --}}
    <div class="w-full h-[350px] sm:h-[400px]">
        <canvas id="salesChart"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const salesData = Array.from({ length: 31 }, (_, i) => ({
        day: `May ${i + 1}`,
        sales: Math.floor(Math.random() * 15000) + 5000
    }));

    const labels = salesData.map(i => i.day);
    const values = salesData.map(i => i.sales);

    const ctx = document.getElementById('salesChart').getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, '#6366f1');
    gradient.addColorStop(1, '#4f46e5');

    new Chart(ctx, {
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
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#111827',
                    titleColor: '#fff',
                    bodyColor: '#cbd5e1',
                    displayColors: false,
                    padding: 10,
                    callbacks: {
                        label: c => '$' + c.raw.toLocaleString()
                    }
                }
            },

            scales: {

                x: {
                    grid: { display: false },
                    ticks: {
                        color: '#94a3b8',
                        maxRotation: 0,
                        autoSkip: false,
                        callback: (v, i) => [0,4,10,15,20,25,30].includes(i) ? labels[i] : ''
                    }
                },

                y: {
                    beginAtZero: true,
                    max: 20000,
                    ticks: {
                        stepSize: 5000,
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
</script>