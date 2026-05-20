
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

</div> 