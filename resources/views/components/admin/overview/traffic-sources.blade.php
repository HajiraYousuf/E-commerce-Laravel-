@php
$traffic = collect([
    (object)['source' => 'Direct', 'total' => 120],
    (object)['source' => 'Organic', 'total' => 200],
    (object)['source' => 'Social media', 'total' => 80],
    (object)['source' => 'Referral', 'total' => 40],
    (object)['source' => 'Email', 'total' => 60],
]);

$totalVisits = $traffic->sum('total');

function getPercent($value, $total) {
    return $total > 0 ? round(($value / $total) * 100) : 0;
}
@endphp

<div class="bg-white dark:bg-[#0F172A] p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-white/10 w-full">

    <!-- Header -->
    <div class="mb-5">
        <h2 class="text-base font-semibold text-gray-900 dark:text-white">
            Traffic Sources
        </h2>

        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
            Where your visitors are coming from
        </p>
    </div>

    <!-- Sources -->
    <div class="space-y-4">

        @foreach($traffic as $item)

            @php
                $percent = getPercent($item->total, $totalVisits);

                $color = match($item->source) {
                    'Direct' => 'bg-blue-500',
                    'Organic' => 'bg-green-500',
                    'Social media' => 'bg-pink-500',
                    'Referral' => 'bg-purple-500',
                    'Email' => 'bg-yellow-500',
                    default => 'bg-gray-400'
                };
            @endphp

            <div class="flex items-center gap-2">

                <!-- Left -->
                <div class="w-[105px] shrink-0">

                    <span class="text-xs font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">
                        {{ $item->source }}
                    </span>

                </div>

                <!-- Progress -->
                <div class="flex-1">

                    <div class="w-full h-1.5 bg-gray-200 dark:bg-white/10 rounded-full overflow-hidden">

                        <div
                            class="h-full rounded-full {{ $color }} transition-all duration-700 ease-in-out"
                            style="width: {{ $percent }}%">
                        </div>

                    </div>

                </div>

                <!-- Right -->
                <div class="w-[34px] text-right shrink-0">

                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">
                        {{ $percent }}%
                    </span>

                </div>

            </div>

        @endforeach

    </div>

</div>