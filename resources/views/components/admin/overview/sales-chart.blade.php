@php
    // Dynamic data (monthly sales)
    $data = [4000,5500,7000,5000,3500,6000,5000,6500,3500,5500,4500,7000,4000,5000,10000,6500,5000,3000,4000,5500,7500,6500,5500,5000,3000,3500,5000,6500,4500,7000,8000];

    // Days (1–31)
    $labels = range(1, count($data));
@endphp

<div class="bg-gradient-to-br from-[#0F172A] to-[#020617] border border-white/10 rounded-2xl p-6 shadow-xl">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-white text-xl font-semibold tracking-wide">
            Sales Overview
        </h2>

        <select class="bg-[#111827] border border-white/10 text-gray-300 rounded-lg px-3 py-1 text-sm">
            <option>Monthly</option>
        </select>
    </div>

    {{-- CANVAS --}}
    <div class="h-[350px]">
        <canvas id="salesChart"></canvas>
    </div>

</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    const chartData = {
        labels: @json($labels),
        datasets: [{
            label: 'Sales',
            data: @json($data),

            backgroundColor: 'rgba(59,130,246,0.7)',
            borderRadius: 6,
            barThickness: 8,
            hoverBackgroundColor: 'rgba(96,165,250,1)',
        }]
    };

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#111827',
                titleColor: '#fff',
                bodyColor: '#ddd',
                callbacks: {
                    label: function(context) {
                        return context.raw / 1000 + 'k';
                    }
                }
            }
        },

        scales: {

            // X AXIS (DAYS)
            x: {
                grid: { display: false },
                ticks: {
                    color: '#9CA3AF',
                    maxRotation: 0,
                    autoSkip: true,
                    maxTicksLimit: 8
                }
            },

            // Y AXIS (LEFT ONLY)
            y: {
                beginAtZero: true,
                max: 20000,

                ticks: {
                    stepSize: 5000,
                    color: '#9CA3AF',
                    callback: function(value) {
                        return value / 1000 + 'k';
                    }
                },

                grid: {
                    color: 'rgba(255,255,255,0.05)'
                }
            }
        }
    };

    new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: chartOptions
    });
</script>