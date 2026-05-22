
<div class="rounded-3xl border border-slate-200 dark:border-white/10 bg-white dark:bg-[#081028] p-6 shadow-xl dark:shadow-2xl">

    {{-- HEADER --}}
    <div class="mb-6 flex items-start justify-between">

        <div>
            <h2 class="text-xl font-semibold text-slate-800 dark:text-white">
                Revenue Analysis
            </h2>

            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                Detailed revenue performance over time
            </p>
        </div>

        <button
            class="rounded-xl border border-slate-200 dark:border-white/10 bg-slate-100 dark:bg-[#111827] px-4 py-2 text-sm text-slate-700 dark:text-slate-300"
        >
            Daily
        </button>

    </div>

    {{-- CHART --}}
    <div class="h-[340px]">
        <canvas id="revenueChart"></canvas>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">

    @foreach ($bottomCards as $card)

        <div class="rounded-2xl bg-slate-50 dark:bg-[#0F172A] p-5 border border-slate-200 dark:border-white/5">

            <p class="text-sm text-slate-500 dark:text-slate-400">
                {{ $card['title'] }}
            </p>

            <div class="mt-3 flex items-center justify-between">

                <h3 class="text-3xl font-bold text-slate-800 dark:text-white">
                    ${{ number_format($card['value']) }}
                </h3>

                <span class="text-sm font-semibold 
                    {{ $card['growth'] >= 0 ? 'text-emerald-500' : 'text-red-500' }}">

                    {{ $card['growth'] >= 0 ? '↑' : '↓' }}
                    {{ abs($card['growth']) }}%

                </span>

            </div>

        </div>

    @endforeach

</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {

    const ctx = document.getElementById('revenueChart');

    const gradientPurple = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);

    gradientPurple.addColorStop(0, 'rgba(139,92,246,0.45)');
    gradientPurple.addColorStop(1, 'rgba(139,92,246,0)');

    const gradientBlue = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);

    gradientBlue.addColorStop(0, 'rgba(59,130,246,0.40)');
    gradientBlue.addColorStop(1, 'rgba(59,130,246,0)');

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: @json($labels),

            datasets: [

                {
                    label: 'Revenue',
                    data: @json($revenues),

                    borderColor: '#8B5CF6',
                    backgroundColor: gradientPurple,

                    fill: true,
                    tension: 0.45,
                    borderWidth: 3,

                    pointRadius: 4,
                    pointHoverRadius: 6,

                    pointBackgroundColor: '#8B5CF6'
                },

                {
                    label: 'Expenses',
                    data: @json($expenses),

                    borderColor: '#3B82F6',
                    backgroundColor: gradientBlue,

                    fill: true,
                    tension: 0.45,
                    borderWidth: 3,

                    pointRadius: 4,
                    pointHoverRadius: 6,

                    pointBackgroundColor: '#3B82F6'
                }
            ]
        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            plugins: {

                legend: {
    labels: {
        color: '#CBD5E1',

        usePointStyle: true,
        pointStyle: 'rect',

        boxWidth: 8,   // 🔥 yar
        boxHeight: 8,  // 🔥 yar

        padding: 12
    }
}
            },

            scales: {

                x: {
                    ticks: {
    color: '#94A3B8',

    callback: function(value, index) {
        // 👉 kaliya muuji even index (0,2,4...)
        return index % 2 === 0 ? this.getLabelForValue(value) : '';
    }
},

                    grid: {
                        display: false
                    }
                },

                y: {
    min: 0,
    max: 100000, // waxaad beddeli kartaa haddii data ka bato

    ticks: {
        stepSize: 20000, // 🔥 20K step

        color: '#94A3B8',

        callback: function(value) {
            return '$' + (value / 1000) + 'K';
        }
    },

    grid: {
        color: 'rgba(255,255,255,0.05)'
    }
}
            }
        }
    });

});
</script>