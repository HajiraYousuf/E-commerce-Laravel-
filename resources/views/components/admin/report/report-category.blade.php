{{-- =========================
ReportCategories.blade.php (COMPACT DARK + LIGHT)
========================= --}}

@php
$categories=[
['title'=>'Sales Reports','desc'=>'View all sales related reports','color'=>'blue','icon'=>'ri-line-chart-line'],
['title'=>'User Reports','desc'=>'View user activity and growth','color'=>'green','icon'=>'ri-user-3-line'],
['title'=>'Financial Reports','desc'=>'View financial statements','color'=>'yellow','icon'=>'ri-coin-line'],
['title'=>'Inventory Reports','desc'=>'View inventory and stock reports','color'=>'purple','icon'=>'ri-stack-line'],
['title'=>'Product Reports','desc'=>'View product performance','color'=>'cyan','icon'=>'ri-box-3-line'],
];

$colors=[
'blue'=>'from-blue-500/20 to-blue-600/5 text-blue-400 dark:text-blue-400 shadow-blue-500/20',
'green'=>'from-green-500/20 to-green-600/5 text-green-400 dark:text-green-400 shadow-green-500/20',
'yellow'=>'from-yellow-500/20 to-yellow-600/5 text-yellow-400 dark:text-yellow-400 shadow-yellow-500/20',
'purple'=>'from-purple-500/20 to-purple-600/5 text-purple-400 dark:text-purple-400 shadow-purple-500/20',
'cyan'=>'from-cyan-500/20 to-cyan-600/5 text-cyan-400 dark:text-cyan-400 shadow-cyan-500/20',
];
@endphp

<div class="bg-white dark:bg-[#0B1220] border border-gray-200 dark:border-white/10 rounded-3xl p-5 shadow-sm dark:shadow-2xl">

    {{-- HEADER --}}
    <div class="mb-5">
        <h2 class="text-gray-900 dark:text-white text-xl font-bold">
            Report Categories
        </h2>

        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
            Manage and analyze all system reports
        </p>
    </div>

    {{-- LIST --}}
    <div class="space-y-2">

        @foreach($categories as $item)
        @php $c=$colors[$item['color']]; @endphp

        <div class="group flex items-center justify-between p-3 rounded-2xl
                    bg-gray-50 dark:bg-[#0F172A]/60
                    border border-gray-200 dark:border-white/5
                    hover:bg-gray-100 dark:hover:bg-[#111C33]
                    transition">

            {{-- LEFT --}}
            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl flex items-center justify-center
                            bg-gradient-to-br {{ $c }}
                            group-hover:scale-105 transition">

                    <i class="{{ $item['icon'] }} text-lg"></i>
                </div>

                <div>
                    <h3 class="text-gray-900 dark:text-white font-semibold text-sm">
                        {{ $item['title'] }}
                    </h3>

                    <p class="text-gray-500 dark:text-gray-400 text-xs">
                        {{ $item['desc'] }}
                    </p>
                </div>

            </div>

            {{-- ARROW --}}
            <span class="text-gray-400 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white transition">
                →
            </span>

        </div>

        @endforeach

    </div>
</div>
{{-- 
@php
$colors = [
    'emerald' => ['iconText' => 'text-emerald-500 dark:text-emerald-400', 'line' => '#10b981'],
    'blue'    => ['iconText' => 'text-blue-500 dark:text-blue-400', 'line' => '#3b82f6'],
    'violet'  => ['iconText' => 'text-violet-500 dark:text-violet-400', 'line' => '#8b5cf6'],
    'rose'    => ['iconText' => 'text-rose-500 dark:text-rose-400', 'line' => '#f43f5e'],
];
@endphp

<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

@foreach($stats as $stat)

@php
$currentColor = $colors[$stat['color']];

// SAFE max (avoid crash when chart empty)
$max = !empty($stat['chart']) ? max($stat['chart']) : 1;

// build points safely
$points = collect($stat['chart'])->map(function ($v, $i) use ($max) {
    return [
        $i * 20,
        55 - (($v / $max) * 35)
    ];
});

// build SVG line
$line = "M ";

foreach ($points as $i => $p) {
    if ($i == 0) {
        $line .= "{$p[0]} {$p[1]} ";
    } else {
        $prev = $points[$i - 1];
        $cx = ($prev[0] + $p[0]) / 2;

        $line .= "C $cx {$prev[1]}, $cx {$p[1]}, {$p[0]} {$p[1]} ";
    }
}

$area = $line . " L 120 60 L 0 60 Z";

// ✅ dynamic growth (IMPORTANT FIX)
$growth = (float) $stat['growth'];
$isNegative = $growth < 0;
@endphp

<div class="group relative rounded-2xl p-4 sm:p-5
bg-white dark:bg-[#0F172A]/80
border border-gray-200 dark:border-white/5
backdrop-blur-xl
hover:shadow-lg dark:hover:shadow-black/30
transition-all duration-300">

    {{-- SVG --}}
    <div class="absolute bottom-0 right-0 w-28 h-18 opacity-60 group-hover:opacity-80 transition">
        <svg viewBox="0 0 120 60" class="w-full h-full">
            <defs>
                <linearGradient id="line-{{ $loop->index }}">
                    <stop offset="0%" stop-color="{{ $currentColor['line'] }}" stop-opacity="0.2"/>
                    <stop offset="100%" stop-color="{{ $currentColor['line'] }}" stop-opacity="1"/>
                </linearGradient>

                <linearGradient id="area-{{ $loop->index }}">
                    <stop offset="0%" stop-color="{{ $currentColor['line'] }}" stop-opacity="0.12"/>
                    <stop offset="100%" stop-color="{{ $currentColor['line'] }}" stop-opacity="0"/>
                </linearGradient>
            </defs>

            <path d="{{ $area }}" fill="url(#area-{{ $loop->index }})"/>
            <path d="{{ $line }}" fill="none" stroke="url(#line-{{ $loop->index }})" stroke-width="2"/>
        </svg>
    </div>

    {{-- CONTENT --}}
    <div class="relative z-10 flex flex-col gap-3">

        {{-- TOP --}}
        <div class="flex items-center justify-between">

            <div>
                <p class="text-gray-500 dark:text-slate-400 text-xs">
                    {{ $stat['title'] }}
                </p>

                <h2 class="text-gray-900 dark:text-white text-xl sm:text-2xl font-semibold mt-1">
                    {{ $stat['value'] }}
                </h2>
            </div>

            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl
                        bg-gray-100 dark:bg-white/5
                        border border-gray-200 dark:border-white/10
                        flex items-center justify-center
                        group-hover:scale-110 transition">

                <i class="{{ $stat['icon'] }} text-lg {{ $currentColor['iconText'] }}"></i>
            </div>

        </div>

        {{-- BOTTOM --}}
        <div class="flex items-center gap-2">

            <span class="px-2 py-0.5 rounded-md text-xs font-medium
                {{ $isNegative
                    ? 'bg-red-100 text-red-600 dark:bg-red-500/10 dark:text-red-400'
                    : 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400'
                }}">

                <i class="ri-arrow-{{ $isNegative ? 'down' : 'up' }}-line"></i>

                {{ $growth }}%
            </span>

            <span class="text-gray-400 dark:text-slate-500 text-xs">
                vs last month
            </span>

        </div>

    </div>

</div>

@endforeach

</div> --}}