@php
$typeUI = [
    'sales' => 'emerald',
    'revenue' => 'emerald',
    'users' => 'emerald',
    'products' => 'emerald',
    'inventory' => 'emerald',
];
$ui = function ($color) {
    return [
        'icon' => 'ri-file-excel-2-line',
        'bg' => "bg-{$color}-500/10 dark:bg-{$color}-500/15",
        'text' => "text-{$color}-600 dark:text-{$color}-400",
        'border' => "border-{$color}-200 dark:border-{$color}-500/20",
        'hover' => "hover:border-{$color}-400 dark:hover:border-{$color}-500/40 hover:bg-{$color}-50 dark:hover:bg-{$color}-500/10",
    ];
};
@endphp
<div class="bg-white dark:bg-[#0B1220] border border-gray-200 dark:border-white/10 rounded-3xl p-6">

    {{-- HEADER --}}
    <div class="flex justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Recent Reports</h2>
            <p class="text-gray-400 text-sm">Latest analytics reports</p>
        </div>

        <div class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs border border-emerald-500/20">
            {{ count($reports) }} Reports
        </div>
    </div>

    {{-- LIST --}}
    <div class="space-y-4">

        @foreach($reports as $report)

@php
    $style = $ui($typeUI[$report['type']] ?? 'emerald');
@endphp

<div class="flex items-center justify-between p-4 rounded-2xl border {{ $style['border'] }} bg-gray-50 dark:bg-[#111827]/70">

    <div class="flex items-center gap-4">

        <div class="w-12 h-12 flex items-center justify-center rounded-2xl {{ $style['bg'] }}">
            <i class="{{ $style['icon'] }} {{ $style['text'] }} text-xl"></i>
        </div>

        <div>
            <h3 class="text-white font-semibold">
                {{ $report['title'] }}
            </h3>
            <p class="text-gray-400 text-sm">
                {{ $report['date'] }} • {{ $report['ext'] }}
            </p>
        </div>

    </div>

    <a href="{{ route('admin.reports.download', $report['type']) }}"
       class="w-10 h-10 flex items-center justify-center rounded-xl bg-[#1E293B] hover:bg-emerald-500 transition">
        <i class="ri-download-line text-white"></i>
    </a>

</div>

@endforeach
    </div>

</div>