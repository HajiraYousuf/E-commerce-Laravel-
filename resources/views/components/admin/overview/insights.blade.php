@php
$insights = [
    [
        'title' => 'Revenue Opportunity',
        'desc' => 'Revenue is up 12.5% this period.',
        'tip' => 'Increase ad spend.',
        'icon' => 'ri-arrow-up-line',
        'color' => 'green'
    ],
    [
        'title' => 'User Engagement',
        'desc' => 'User engagement is high.',
        'tip' => 'Keep content consistent.',
        'icon' => 'ri-user-3-line',
        'color' => 'blue'
    ],
    [
        'title' => 'Stock Alert',
        'desc' => 'iPhone 15 Pro stock is low.',
        'tip' => 'Reorder recommended.',
        'icon' => 'ri-error-warning-line',
        'color' => 'red'
    ],
    [
        'title' => 'Growth Opportunity',
        'desc' => 'Mobile traffic increased by 25%.',
        'tip' => 'Improve mobile UX.',
        'icon' => 'ri-rocket-line',
        'color' => 'purple'
    ],
    [
        'title' => 'Performance Tip',
        'desc' => 'Consider A/B testing new product pages.',
        'tip' => 'Optimize conversion rate.',
        'icon' => 'ri-lightbulb-line',
        'color' => 'yellow'
    ],
];

$colorMap = [
    'green' => 'text-green-400',
    'blue' => 'text-blue-400',
    'red' => 'text-red-400',
    'purple' => 'text-purple-400',
    'yellow' => 'text-yellow-400',
];
@endphp

{{-- HEADER --}}
<div class="mb-4">
    <h2 class="text-lg font-semibold text-slate-800 dark:text-white">
        Insights & Recommendations
    </h2>

    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
        Data-driven insights based on your activity
    </p>
</div>

{{-- GRID --}}
<div class="grid grid-cols-5 gap-4 mt-2">

@foreach($insights as $item)

    @php
        $colorClass = $colorMap[$item['color']] ?? 'text-gray-400';
    @endphp

    <div class="bg-slate-50 dark:bg-[#0B1220] p-4 rounded-xl text-slate-800 dark:text-white border border-slate-200 dark:border-white/5 hover:scale-[1.02] transition duration-200">

        {{-- HEADER --}}
        <div class="flex items-center gap-2 mb-2">

            <i class="{{ $item['icon'] }} {{ $colorClass }}"></i>

            <h3 class="text-xs font-semibold {{ $colorClass }}">
                {{ $item['title'] }}
            </h3>

        </div>

        {{-- DESCRIPTION --}}
        <p class="text-[11px] text-slate-500 dark:text-gray-400 leading-relaxed">
            {{ $item['desc'] }}
        </p>

        <p class="text-[11px] text-slate-500 dark:text-gray-400 leading-relaxed mt-1">
            {{ $item['tip'] }}
        </p>

        {{-- BUTTON --}}
        <button class="mt-3 text-xs bg-blue-100 dark:bg-blue-950 text-blue-700 dark:text-blue-300 px-2 py-1 rounded-lg">
            View Details
        </button>

    </div>

@endforeach

</div>