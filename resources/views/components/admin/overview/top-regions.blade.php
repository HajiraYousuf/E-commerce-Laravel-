@php
    $regions = [
        [
            'name' => 'Maroodi Jeex',
            'users' => '2,521',
            'percent' => '35%',
            'color' => 'bg-purple-500',
            'shadow' => 'shadow-[0_0_10px_#8B5CF6]'
        ],
        [
            'name' => 'Awdal',
            'users' => '1,254',
            'percent' => '18%',
            'color' => 'bg-blue-500',
            'shadow' => 'shadow-[0_0_10px_#3B82F6]'
        ],
        [
            'name' => 'Sahil',
            'users' => '854',
            'percent' => '12%',
            'color' => 'bg-cyan-400',
            'shadow' => 'shadow-[0_0_10px_#22D3EE]'
        ],
        [
            'name' => 'Togdheer',
            'users' => '654',
            'percent' => '19%',
            'color' => 'bg-violet-500',
            'shadow' => 'shadow-[0_0_10px_#7C3AED]'
        ],
        [
            'name' => 'Sool',
            'users' => '521',
            'percent' => '7%',
            'color' => 'bg-amber-400',
            'shadow' => 'shadow-[0_0_10px_#F59E0B]'
        ],
    ];
@endphp

{{-- TOP REGIONS --}}
<div class="bg-white dark:bg-[#0B1120] 
            border border-gray-200 dark:border-white/5 
            rounded-2xl p-6 
            shadow-md dark:shadow-[0_0_40px_rgba(0,0,0,0.45)]">

    {{-- HEADER --}}
    <div class="mb-6">
        <h3 class="text-gray-800 dark:text-white text-xl font-semibold">
            Top Regions
        </h3>

        <p class="text-gray-500 dark:text-slate-400 text-sm mt-1">
            Users by Somaliland regions
        </p>
    </div>

    {{-- CONTENT --}}
    <div class="flex flex-col xl:flex-row items-center gap-8">

       {{-- MAP --}}
        <div class="flex-1 w-full">

            <div class="relative">

                {{-- PURPLE GLOW --}}
                <div class="absolute inset-0 bg-blue-600/10 blur-3xl rounded-full"></div>

                <svg
                    viewBox="0 0 1000 500"
                    class="relative w-full opacity-90 drop-shadow-[0_0_25px_rgba(124,58,237,0.45)]"
                >


                    {{-- MAP IMAGE --}}
                    <image
                        href="https://upload.wikimedia.org/wikipedia/commons/8/80/World_map_-_low_resolution.svg"
                        width="1000"
                        height="500"
                        opacity="1"
                    />

                    {{-- OVERLAY --}}
                    <rect
                        width="1000"
                        height="500"
                        fill="url(#mapGradient)"
                        opacity="0.18"
                    />

                </svg>

            </div>

        </div>

        {{-- LIST --}}
        <div class="w-full xl:w-[280px] space-y-4">

            @foreach ($regions as $region)

                <div class="flex items-center justify-between">

                    {{-- LEFT --}}
                    <div class="flex items-center gap-3">

                        <span class="w-2.5 h-2.5 rounded-full 
                                     {{ $region['color'] }} 
                                     {{ $region['shadow'] }}"></span>

                        <span class="text-sm text-gray-700 dark:text-slate-200">
                            {{ $region['name'] }}
                        </span>

                    </div>

                    {{-- RIGHT --}}
                    <div class="flex items-center gap-4">

                        <span class="text-gray-900 dark:text-white font-semibold text-sm">
                            {{ $region['users'] }}
                        </span>

                        <span class="text-gray-500 dark:text-slate-400 text-sm">
                            {{ $region['percent'] }}
                        </span>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>