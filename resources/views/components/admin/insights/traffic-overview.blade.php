@php

$traffic = [
    ['title'=>'Sessions','value'=>'45,890','growth'=>'+12.5%','up'=>true],
    ['title'=>'Users','value'=>'32,450','growth'=>'+8.2%','up'=>true],
    ['title'=>'Page Views','value'=>'128,450','growth'=>'+18.4%','up'=>true],
    ['title'=>'Bounce Rate','value'=>'38.6%','growth'=>'-2.1%','up'=>false],
];

@endphp


<div class="bg-white dark:bg-gray-900 rounded-3xl p-4 sm:p-6 border border-gray-100 dark:border-gray-800 shadow-sm">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">
            Traffic Overview
        </h2>

        <button class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-700">
            View Report
        </button>

    </div>


    {{-- CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        @foreach($traffic as $item)

            <div class="relative overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-800 bg-gradient-to-br from-white dark:from-gray-900 to-gray-50 dark:to-gray-800 p-4 sm:p-5 hover:shadow-md transition">

                {{-- TOP --}}
                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ $item['title'] }}
                        </p>

                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mt-2">
                            {{ $item['value'] }}
                        </h2>
                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="flex items-center gap-2 mt-5">

                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full
                        {{ $item['up']
                            ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400'
                            : 'bg-red-100 text-red-700 dark:bg-red-500/10 dark:text-red-400'
                        }}">
                        {{ $item['growth'] }}
                    </span>

                </div>

            </div>

        @endforeach

    </div>

</div>