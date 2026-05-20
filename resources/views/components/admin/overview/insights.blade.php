
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