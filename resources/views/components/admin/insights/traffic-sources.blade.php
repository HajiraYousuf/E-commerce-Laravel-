@php

$sources = [
    ['name'=>'Direct','percent'=>40,'growth'=>'+12%','color'=>'bg-indigo-500','light'=>'bg-indigo-100 text-indigo-700','icon'=>'ri-global-line'],
    ['name'=>'Organic','percent'=>28,'growth'=>'+8%','color'=>'bg-emerald-500','light'=>'bg-emerald-100 text-emerald-700','icon'=>'ri-search-2-line'],
    ['name'=>'Social','percent'=>17,'growth'=>'+5%','color'=>'bg-pink-500','light'=>'bg-pink-100 text-pink-700','icon'=>'ri-instagram-line'],
    ['name'=>'Referral','percent'=>9,'growth'=>'-2%','color'=>'bg-orange-500','light'=>'bg-orange-100 text-orange-700','icon'=>'ri-links-line'],
];

@endphp


<div class="bg-white dark:bg-gray-900 rounded-3xl p-4 sm:p-6 border border-gray-100 dark:border-gray-800 shadow-sm">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-4">

        <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">
            Traffic Sources
        </h2>

        <button class="text-sm font-medium text-indigo-600 dark:text-indigo-400">
            View Report
        </button>

    </div>


    {{-- CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        @foreach($sources as $source)

            <div class="rounded-2xl border border-gray-100 dark:border-gray-800 
                        bg-white dark:bg-gray-900 p-3">

                {{-- TOP --}}
                <div class="flex items-center justify-between">

                    <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $source['light'] }}">
                        <i class="{{ $source['icon'] }} text-lg"></i>
                    </div>

                    <span class="text-xs font-semibold
                        {{ str_contains($source['growth'], '-') ? 'text-red-500 dark:text-red-400' : 'text-emerald-500 dark:text-emerald-400' }}">
                        {{ $source['growth'] }}
                    </span>

                </div>


                {{-- CONTENT --}}
                <div class="mt-3">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $source['name'] }}
                    </p>

                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-1">
                        {{ $source['percent'] }}%
                    </h3>

                </div>


                {{-- PROGRESS --}}
                <div class="mt-3 h-2 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">

                    <div class="h-full rounded-full {{ $source['color'] }}"
                         style="width: {{ $source['percent'] }}%"></div>

                </div>

            </div>

        @endforeach

    </div>

</div>