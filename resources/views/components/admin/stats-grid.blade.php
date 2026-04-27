<div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4">

    @foreach($stats as $stat)

        @php
            $isUp = $stat['trend'] === 'up';

            $colors = [
    'emerald' => 'from-emerald-500 to-teal-600 text-emerald-600 dark:text-emerald-400',
    'blue'    => 'from-blue-500 to-indigo-600 text-blue-600 dark:text-blue-400',
    'purple'  => 'from-purple-500 to-pink-600 text-purple-600 dark:text-purple-400',
    'orange'  => 'from-orange-500 to-red-600 text-orange-600 dark:text-orange-400',
];
            $colorClass = $colors[$stat['color']];
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
                            <span class="text-emerald-500 font-semibold text-sm">
                                ▲ {{ $stat['change'] }}
                            </span>
                        @else
                            <span class="text-red-500 font-semibold text-sm">
                                ▼ {{ $stat['change'] }}
                            </span>
                        @endif

                        <span class="text-sm text-slate-500 dark:text-slate-400">
                            vs Last
                        </span>

                    </div>

                </div>

                {{-- Icon --}}
                <div class="p-3 rounded-xl bg-slate-100 dark:bg-slate-800 group-hover:scale-110 transition">
                    <div class="w-6 h-6 text-slate-600 dark:text-slate-300">
                        {{-- Simple icon placeholder --}}
<i data-lucide="users"></i>                    </div>
                </div>

            </div>

            {{-- Progress bar --}}
            <div class="mt-4 h-2 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">

                <div class="h-full bg-gradient-to-r {{ str_replace('text-', '', $colorClass) }} rounded-full transition-all duration-300"
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