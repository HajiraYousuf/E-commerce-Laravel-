{{-- =========================
RecentReports.blade.php (Dark + Light UPGRADED)
========================= --}}

@php
$reports = [
['title'=>'Sales Report - May 2024','date'=>'May 31, 2024','type'=>'pdf','ext'=>'.pdf'],
['title'=>'User Activity Report','date'=>'May 30, 2024','type'=>'excel','ext'=>'.xlsx'],
['title'=>'Financial Report - Q2','date'=>'May 29, 2024','type'=>'pdf','ext'=>'.pdf'],
['title'=>'Inventory Report','date'=>'May 28, 2024','type'=>'csv','ext'=>'.csv'],
['title'=>'Product Performance Report','date'=>'May 27, 2024','type'=>'excel','ext'=>'.xlsx'],
];

$types = [
'pdf'=>[
    'icon'=>'ri-file-pdf-2-line',
    'bg'=>'bg-red-500/10 dark:bg-red-500/15',
    'text'=>'text-red-500 dark:text-red-400',
    'border'=>'border-red-200 dark:border-red-500/20',
    'hover'=>'hover:border-red-400 dark:hover:border-red-500/40 hover:bg-red-50 dark:hover:bg-red-500/10'
],
'excel'=>[
    'icon'=>'ri-file-excel-2-line',
    'bg'=>'bg-emerald-500/10 dark:bg-emerald-500/15',
    'text'=>'text-emerald-600 dark:text-emerald-400',
    'border'=>'border-emerald-200 dark:border-emerald-500/20',
    'hover'=>'hover:border-emerald-400 dark:hover:border-emerald-500/40 hover:bg-emerald-50 dark:hover:bg-emerald-500/10'
],
'csv'=>[
    'icon'=>'ri-file-text-line',
    'bg'=>'bg-yellow-500/10 dark:bg-yellow-500/15',
    'text'=>'text-yellow-600 dark:text-yellow-300',
    'border'=>'border-yellow-200 dark:border-yellow-500/20',
    'hover'=>'hover:border-yellow-400 dark:hover:border-yellow-500/40 hover:bg-yellow-50 dark:hover:bg-yellow-500/10'
],
];
@endphp

<div class="bg-white dark:bg-[#0B1220] border border-gray-200 dark:border-white/10 rounded-3xl p-6 shadow-sm dark:shadow-[0_20px_60px_rgba(0,0,0,0.45)] transition-colors duration-300">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h2 class="text-gray-900 dark:text-white text-2xl font-bold">
                Recent Reports
            </h2>

            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                Latest generated analytics & inventory reports
            </p>
        </div>

        <div class="px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-medium border border-blue-200 dark:border-blue-500/20">
            5 Reports
        </div>

    </div>

    {{-- LIST --}}
    <div class="space-y-4">

        @foreach($reports as $report)
        @php $t=$types[$report['type']]; @endphp

        <div class="group relative overflow-hidden rounded-2xl border {{ $t['border'] }} bg-gray-50 dark:bg-[#111827]/70 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:hover:shadow-2xl {{ $t['hover'] }}">

            <div class="relative flex items-center justify-between">

                {{-- LEFT --}}
                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center border {{ $t['bg'] }} {{ $t['border'] }} group-hover:scale-110 transition">
                        <i class="{{ $t['icon'] }} text-xl {{ $t['text'] }}"></i>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">

                            <h3 class="text-gray-900 dark:text-white font-semibold text-[15px]">
                                {{ $report['title'] }}
                            </h3>

                            <span class="text-[10px] px-2 py-1 rounded-full font-semibold uppercase tracking-wide {{ $t['bg'] }} {{ $t['text'] }}">
                                {{ $report['ext'] }}
                            </span>

                        </div>

                        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                            <i class="ri-time-line"></i>
                            <span>{{ $report['date'] }}</span>
                        </div>
                    </div>

                </div>

                {{-- ACTIONS --}}
                <div class="flex items-center gap-2">

                    <button class="w-10 h-10 rounded-xl bg-white dark:bg-[#1E293B] border border-gray-200 dark:border-white/5 hover:bg-blue-500 hover:scale-110 transition flex items-center justify-center">
                        <i class="ri-download-line text-gray-700 dark:text-white"></i>
                    </button>

                    <button class="w-10 h-10 rounded-xl bg-white dark:bg-[#1E293B] border border-gray-200 dark:border-white/5 hover:bg-gray-100 dark:hover:bg-white/10 hover:scale-110 transition flex items-center justify-center">
                        <i class="ri-more-2-fill text-gray-500 dark:text-gray-300"></i>
                    </button>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    {{-- FOOTER --}}
    <div class="mt-6 pt-5 border-t border-gray-200 dark:border-white/5">

        <button class="w-full py-3.5 rounded-2xl bg-gradient-to-r from-blue-500/10 to-indigo-500/10 dark:from-blue-500/20 dark:to-indigo-500/20 border border-blue-200 dark:border-blue-500/20 text-blue-600 dark:text-blue-400 font-semibold hover:from-blue-500 hover:to-indigo-500 hover:text-white hover:shadow-lg hover:shadow-blue-500/20 transition-all duration-300">
            View All Reports →
        </button>

    </div>

</div>