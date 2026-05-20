@php
$genderLabels = collect($genderData)->pluck('label');
$genderValues = collect($genderData)->pluck('value');
$genderColors = collect($genderData)->pluck('color');
@endphp


<div class="relative overflow-hidden rounded-2xl border border-slate-200 dark:border-white/10 
bg-white dark:bg-[#081028]/95 p-4 shadow-xl dark:shadow-2xl h-full flex flex-col min-h-[300px]">

    {{-- Glow --}}
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(139,92,246,0.08),transparent_40%)] dark:bg-[radial-gradient(circle_at_top_right,rgba(139,92,246,0.12),transparent_40%)]"></div>

    <div class="relative z-10 flex flex-col h-full">

        {{-- HEADER --}}
        <div class="mb-3">
            <h2 class="text-lg font-semibold text-slate-800 dark:text-white">
                User Demographics
            </h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Gender & age distribution
            </p>
        </div>

        {{-- BODY --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 flex-1">

            {{-- LEFT --}}
            <div class="flex flex-col">

                {{-- CHART --}}
                <div class="relative h-[120px] flex items-center justify-center">
                    <canvas id="demographicsChart"></canvas>

                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-xl font-bold text-slate-800 dark:text-white">
                            {{ $totalUsers }}
                        </span>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400">
                            Users
                        </span>
                    </div>
                </div>

                {{-- GENDER --}}
                <div class="mt-2 space-y-2 text-sm">
                    @foreach ($genderData as $gender)
                        <div class="flex items-center gap-2">

                            <span class="h-2 w-2 rounded-full"
                                  style="background-color: {{ $gender['color'] }}"></span>

                            <span class="text-slate-600 dark:text-slate-300 text-sm">
                                {{ $gender['label'] }}
                            </span>

                            <span class="text-slate-900 dark:text-white font-medium text-sm ml-1">
                                {{ $gender['value'] }}%
                            </span>

                        </div>
                    @endforeach
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="flex flex-col">

                <h3 class="mb-2 text-sm font-semibold text-slate-800 dark:text-white">
                    Age Groups
                </h3>

                <div class="space-y-3 text-sm">
                    @foreach ($ageData as $age)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-slate-600 dark:text-slate-300">
                                    {{ $age['range'] }}
                                </span>
                                <span class="text-slate-900 dark:text-white font-medium">
                                    {{ $age['value'] }}%
                                </span>
                            </div>

                            <div class="h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r {{ $age['color'] }}"
                                     style="width: {{ $age['value'] }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const ctx = document.getElementById('demographicsChart');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: @json($genderLabels),
            datasets: [{
                data: @json($genderValues),
                backgroundColor: @json($genderColors),
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { display: false }
            }
        }
    });

});
</script>