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