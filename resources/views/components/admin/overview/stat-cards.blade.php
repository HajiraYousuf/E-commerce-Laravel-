{{-- =========================
DYNAMIC STATS CARDS
DESIGN UNCHANGED
========================= --}}

@php

$colors = [
    'green' => [
        'bg' => 'bg-green-100 dark:bg-green-500/15',
        'icon' => 'text-green-600 dark:text-green-400',
        'line' => '#22c55e',
        'gradient' => 'from-green-500/20'
    ],

    'blue' => [
        'bg' => 'bg-blue-100 dark:bg-blue-500/15',
        'icon' => 'text-blue-600 dark:text-blue-400',
        'line' => '#3b82f6',
        'gradient' => 'from-blue-500/20'
    ],

    'purple' => [
        'bg' => 'bg-purple-100 dark:bg-purple-500/15',
        'icon' => 'text-purple-600 dark:text-purple-400',
        'line' => '#a855f7',
        'gradient' => 'from-purple-500/20'
    ],

    'orange' => [
        'bg' => 'bg-orange-100 dark:bg-orange-500/15',
        'icon' => 'text-orange-600 dark:text-orange-400',
        'line' => '#f97316',
        'gradient' => 'from-orange-500/20'
    ],

    'red' => [
        'bg' => 'bg-red-100 dark:bg-red-500/15',
        'icon' => 'text-red-600 dark:text-red-400',
        'line' => '#ef4444',
        'gradient' => 'from-red-500/20'
    ]

];

@endphp


<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6">

@foreach($stats as $stat)

@php

    $currentColor = $colors[$stat['color']];

    $max = max($stat['chart']) > 0 ? max($stat['chart']) : 1;

    $points = collect($stat['chart'])->map(function ($value, $index) use ($max) {

        $x = $index * 18;

        $y = 55 - (($value / $max) * 45);

        return "$x,$y";

    })->implode(' ');

@endphp


<div class="relative overflow-hidden rounded-3xl border border-slate-200/70 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 shadow-sm hover:shadow-2xl transition-all duration-500 group">

    {{-- Glow background --}}
    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500 bg-gradient-to-br {{ $currentColor['gradient'] }} to-transparent"></div>

    <div class="relative z-10">

        {{-- TOP --}}
        <div class="flex items-start justify-between mb-6">

            <div>

                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">
                    {{ $stat['title'] }}
                </p>

                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">
                    {{ $stat['value'] }}
                </h2>

            </div>

            <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $currentColor['bg'] }}">

                <i class="{{ $stat['icon'] }} text-2xl {{ $currentColor['icon'] }}"></i>

            </div>

        </div>

        {{-- BOTTOM --}}
        <div class="flex items-end justify-between gap-3">

            <div>

                <div class="flex items-center gap-2 mb-1">

                    <span class="text-sm font-semibold {{ str_contains($stat['growth'], '-') ? 'text-red-500' : 'text-green-500' }}">

                        {{ $stat['growth'] }}

                    </span>

                    <i class="{{ str_contains($stat['growth'], '-') ? 'ri-arrow-right-down-line text-red-500' : 'ri-arrow-right-up-line text-green-500' }}"></i>

                </div>

                <p class="text-xs text-slate-400 dark:text-slate-500">
                    {{ $stat['date'] }}
                </p>

            </div>

            {{-- GRAPH --}}
            <div class="w-32 h-16">

                <svg viewBox="0 0 140 60" class="w-full h-full">

                    <defs>

                        {{-- GLOW --}}
                        <filter id="glow-{{ $loop->index }}">

                            <feGaussianBlur stdDeviation="2.5" result="blur"/>

                            <feMerge>
                                <feMergeNode in="blur"/>
                                <feMergeNode in="SourceGraphic"/>
                            </feMerge>

                        </filter>

                        {{-- LINE GRADIENT --}}
                        <linearGradient
                            id="lineGradient-{{ $loop->index }}"
                            x1="0"
                            y1="0"
                            x2="1"
                            y2="0"
                        >

                            <stop
                                offset="0%"
                                stop-color="{{ $currentColor['line'] }}"
                                stop-opacity="0.4"
                            />

                            <stop
                                offset="100%"
                                stop-color="{{ $currentColor['line'] }}"
                                stop-opacity="1"
                            />

                        </linearGradient>

                        {{-- AREA GRADIENT --}}
                        <linearGradient
                            id="areaGradient-{{ $loop->index }}"
                            x1="0"
                            y1="0"
                            x2="0"
                            y2="1"
                        >

                            <stop
                                offset="0%"
                                stop-color="{{ $currentColor['line'] }}"
                                stop-opacity="0.25"
                            />

                            <stop
                                offset="100%"
                                stop-color="{{ $currentColor['line'] }}"
                                stop-opacity="0"
                            />

                        </linearGradient>

                    </defs>

                    {{-- AREA --}}
                    <polygon
                        points="0,60 {{ $points }} 140,60"
                        fill="url(#areaGradient-{{ $loop->index }})"
                    />

                    {{-- LINE --}}
                    <polyline
                        fill="none"
                        stroke="url(#lineGradient-{{ $loop->index }})"
                        stroke-width="3"
                        stroke-linecap="round"
                        filter="url(#glow-{{ $loop->index }})"
                        points="{{ $points }}"
                    />

                    {{-- DOTS --}}
                    @foreach($stat['chart'] as $i => $v)

                        @php

                            $x = $i * 18;

                            $y = 55 - (($v / $max) * 45);

                        @endphp

                        <circle
                            cx="{{ $x }}"
                            cy="{{ $y }}"
                            r="2.5"
                            fill="{{ $currentColor['line'] }}"
                        />

                    @endforeach

                </svg>

            </div>

        </div>

    </div>

</div>

@endforeach

</div>