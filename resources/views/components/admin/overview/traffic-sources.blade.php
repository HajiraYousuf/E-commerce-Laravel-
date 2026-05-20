<div class="bg-white dark:bg-[#0F172A] p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-white/10 w-full">

    <div class="mb-5">

        <h2 class="text-base font-semibold text-gray-900 dark:text-white">
            Traffic Sources
        </h2>

        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
            Where your visitors are coming from
        </p>

    </div>

    <div class="space-y-4">

        @forelse($traffic as $item)

            @php
                $percent = $totalVisits > 0
                    ? round(($item->total / $totalVisits) * 100)
                    : 0;

                $color = $trafficColors[$item->source] ?? 'bg-gray-400';
            @endphp

            <div class="flex items-center gap-2">

                <div class="w-[105px] shrink-0">

                    <span class="text-xs font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">
                        {{ $item->source }}
                    </span>

                </div>

                <div class="flex-1">

                    <div class="w-full h-1.5 bg-gray-200 dark:bg-white/10 rounded-full overflow-hidden">

                        <div
                            class="h-full rounded-full {{ $color }} transition-all duration-700 ease-in-out"
                            style="width: {{ $percent }}%">
                        </div>

                    </div>

                </div>

                <div class="w-[34px] text-right shrink-0">

                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">
                        {{ $percent }}%
                    </span>

                </div>

            </div>

        @empty

            <p class="text-sm text-gray-500 dark:text-gray-400">
                No traffic data available
            </p>

        @endforelse

    </div>

</div>