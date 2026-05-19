@php

$stats = [
    ['title'=>'Revenue','value'=>'$24,890','growth'=>'+18%','icon'=>'ri-money-dollar-circle-line','color'=>'emerald'],
    ['title'=>'Orders','value'=>'1,429','growth'=>'+12%','icon'=>'ri-shopping-bag-3-line','color'=>'blue'],
    ['title'=>'Customers','value'=>'1,250','growth'=>'+9%','icon'=>'ri-group-line','color'=>'purple'],
    ['title'=>'AOV','value'=>'$17.42','growth'=>'+8%','icon'=>'ri-funds-box-line','color'=>'orange'],
    ['title'=>'Conversion','value'=>'2.73%','growth'=>'+6%','icon'=>'ri-line-chart-line','color'=>'rose'],
];

@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6">

@foreach($stats as $stat)

<div class="bg-white dark:bg-gray-900 rounded-3xl p-5 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-lg transition">

    <div class="flex items-start justify-between gap-3">

        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $stat['title'] }}
            </p>

            <h2 class="text-2xl sm:text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                {{ $stat['value'] }}
            </h2>
        </div>

        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-{{ $stat['color'] }}-100 dark:bg-{{ $stat['color'] }}-500/10 flex items-center justify-center flex-shrink-0">

            <i class="{{ $stat['icon'] }} text-[20px] sm:text-[24px] leading-none text-{{ $stat['color'] }}-600 dark:text-{{ $stat['color'] }}-400"></i>

        </div>

    </div>

    <div class="mt-5 flex items-center justify-between">

        <div class="flex items-center gap-2 text-sm">
            <span class="text-green-600 dark:text-green-400 font-semibold">
                {{ $stat['growth'] }}
            </span>

            <span class="text-gray-400 dark:text-gray-500">
                vs last month
            </span>
        </div>

        <div class="w-20 h-2 rounded-full bg-gray-100 dark:bg-gray-800 overflow-hidden">
            <div class="h-full w-[70%] rounded-full bg-{{ $stat['color'] }}-500"></div>
        </div>

    </div>

</div>

@endforeach

</div>