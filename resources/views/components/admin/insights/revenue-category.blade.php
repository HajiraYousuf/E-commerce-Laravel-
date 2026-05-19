@php
$categories = [
    ['name'=>'Electronics','percent'=>90,'revenue'=>75000],
    ['name'=>'Fashion','percent'=>85,'revenue'=>9800],
    ['name'=>'Home Living','percent'=>80,'revenue'=>6400],
    ['name'=>'Beauty','percent'=>70,'revenue'=>4200],
    ['name'=>'Sports','percent'=>65,'revenue'=>5300],
];
@endphp

<div class="bg-white dark:bg-gray-900 rounded-3xl p-4 sm:p-6 lg:p-8 border border-gray-100 dark:border-gray-800 shadow-sm transition-all duration-300">

    <div class="flex items-center justify-between mb-8">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">
            Revenue Categories
        </h2>

        <div class="hidden sm:flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-gray-400">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            Live Revenue
        </div>
    </div>

    <div class="space-y-5">

        @foreach($categories as $cat)

            <div class="group">

                {{-- TOP --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-600 to-blue-700 text-white flex items-center justify-center text-sm font-bold shadow-md">
                            {{ substr($cat['name'],0,1) }}
                        </div>

                        <div>
                            <h3 class="text-sm sm:text-base font-semibold text-gray-800 dark:text-gray-100">
                                {{ $cat['name'] }}
                            </h3>

                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $cat['percent'] }}% Performance
                            </p>
                        </div>

                    </div>

                    <div class="text-left sm:text-right">
                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">
                            ${{ number_format($cat['revenue']) }}
                        </h4>

                        <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">
                            Revenue Growth
                        </p>
                    </div>

                </div>

                {{-- PROGRESS BAR --}}
                <div class="relative">

                    {{-- BACKGROUND --}}
                    <div class="h-4 rounded-full bg-gray-100 dark:bg-gray-800 overflow-hidden border border-gray-200 dark:border-gray-700 shadow-inner">

                        {{-- ACTIVE BAR --}}
                        <div
                            class="relative h-full rounded-full bg-gradient-to-r from-violet-600 via-fuchsia-500 to-blue-600 transition-all duration-700 ease-out group-hover:brightness-110"
                            style="width: {{ $cat['percent'] }}%"
                        >

                            {{-- GLOW EFFECT --}}
                            <div class="absolute inset-0 bg-white/20 blur-md"></div>

                            {{-- SHINE --}}
                            <div class="absolute top-0 left-0 h-full w-20 bg-white/30 skew-x-[-20deg] animate-pulse"></div>

                        </div>

                    </div>

                    {{-- PERCENT FLOAT --}}
                    <div
                        class="absolute -top-8 text-xs font-semibold text-violet-700 dark:text-violet-300 transition-all duration-500"
                        style="left: calc({{ $cat['percent'] }}% - 20px)"
                    >
                        {{ $cat['percent'] }}%
                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>