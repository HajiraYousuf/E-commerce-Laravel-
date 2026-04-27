<div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4">

@foreach($stats as $stat)

@php
    $isUp = $stat['trend'] === 'up';

    $icons = [
        'revenue' => 'dollar-sign',
        'users' => 'users',
        'orders' => 'shopping-cart',
        'views' => 'eye',
    ];

    $icon = $icons[$stat['type']] ?? 'bar-chart';

    $colors = [
        'emerald' => 'from-emerald-500 to-teal-600 text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/20',
        'blue'    => 'from-blue-500 to-indigo-600 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20',
        'purple'  => 'from-purple-500 to-pink-600 text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/20',
        'orange'  => 'from-orange-500 to-red-600 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/20',
    ];

    $color = $colors[$stat['color']];
@endphp

<div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-2xl p-6 border border-slate-200/50 dark:border-slate-700/50 transition-all duration-300 group">

    {{-- Header --}}
    <div class="flex items-start justify-between">

        <div class="flex-1">

            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-2">
                {{ $stat['title'] }}
            </p>

            <p class="text-3xl font-bold text-slate-800 dark:text-white mb-4">
                {{ $stat['value'] }}
            </p>

            <div class="flex items-center space-x-2">

    @if($isUp)
        <i data-lucide="arrow-up-right" class="w-4 h-4 text-emerald-500 stroke-width="2.5""></i>
        <span class="text-sm font-semibold text-emerald-500">
            {{ $stat['change'] }}
        </span>
    @else
        <i data-lucide="arrow-down-right" class="w-4 h-4 text-red-500"></i>
        <span class="text-sm font-semibold text-red-500">
            {{ $stat['change'] }}
        </span>
    @endif

    <span class="text-sm text-slate-500 dark:text-slate-400">
        vs Last
    </span>

</div>
        </div>

        {{-- ICON (FIXED like React) --}}
        <div class="p-3 rounded-xl {{ $color }} group-hover:scale-110 transition">
            <i data-lucide="{{ $icon }}" class="w-6 h-6"></i>
        </div>

    </div>

    {{-- Progress bar --}}
    <div class="mt-4 h-2 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">

        <div class="h-full bg-gradient-to-r {{ $color }} rounded-full transition-all duration-300"
             style="width: {{ $isUp ? '75%' : '45%' }}">
        </div>

    </div>

</div>

@endforeach

</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>