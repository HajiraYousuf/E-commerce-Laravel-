<x-layouts.app>

@php

$stats = [

    [
        'id' => 'transactions',
        'title' => 'Total Transactions',
        'value' => number_format($totalTransactions),
        'subtitle' => 'All time',
        'color' => 'indigo',
        'icon' => 'ri-exchange-dollar-line',
    ],

    [
        'id' => 'revenue',
        'title' => 'Total Revenue',
        'value' => '$' . number_format($totalRevenue, 2),
        'subtitle' => 'Completed payments',
        'color' => 'emerald',
        'icon' => 'ri-money-dollar-circle-line',
    ],

    [
        'id' => 'pending',
        'title' => 'Pending Amount',
        'value' => '$' . number_format($pendingAmount, 2),
        'subtitle' => 'Pending payments',
        'color' => 'amber',
        'icon' => 'ri-time-line',
    ],

    [
        'id' => 'refunds',
        'title' => 'Refunds',
        'value' => '$' . number_format($refundAmount, 2),
        'subtitle' => 'Refunded payments',
        'color' => 'rose',
        'icon' => 'ri-refund-2-line',
    ],

];

$colors = [

    'indigo' =>
        'bg-indigo-500/10 text-indigo-600 border-indigo-200
         dark:bg-indigo-500/15 dark:text-indigo-400 dark:border-indigo-500/20',

    'emerald' =>
        'bg-emerald-500/10 text-emerald-600 border-emerald-200
         dark:bg-emerald-500/15 dark:text-emerald-400 dark:border-emerald-500/20',

    'amber' =>
        'bg-amber-500/10 text-amber-600 border-amber-200
         dark:bg-amber-500/15 dark:text-amber-400 dark:border-amber-500/20',

    'rose' =>
        'bg-rose-500/10 text-rose-600 border-rose-200
         dark:bg-rose-500/15 dark:text-rose-400 dark:border-rose-500/20',

];

@endphp

<div class="space-y-6 lg:space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">
                Transactions
            </h1>

            <p class="mt-1 text-sm sm:text-base text-gray-500 dark:text-slate-400">
                Track all your sales and transactions
            </p>

        </div>

        <!-- SEARCH -->
        <form method="GET"
              class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">

            <div class="relative flex-1 lg:flex-none">

                <span class="absolute left-4 top-1/2 -translate-y-1/2
                             text-gray-400 dark:text-slate-500">

                    <i class="ri-search-line text-lg"></i>

                </span>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search transactions..."
                    class="w-full lg:w-72
                           bg-white dark:bg-[#0F172A]
                           border border-gray-200 dark:border-slate-800
                           rounded-2xl
                           pl-12 pr-4 py-3
                           text-sm text-gray-900 dark:text-white
                           placeholder:text-gray-400
                           dark:placeholder:text-slate-500
                           outline-none
                           focus:ring-4
                           focus:ring-indigo-500/10
                           focus:border-indigo-500
                           transition"
                >

            </div>

            <button
                class="h-12 px-6
                       flex items-center justify-center gap-2
                       rounded-2xl
                       bg-indigo-600 hover:bg-indigo-700
                       text-white font-semibold
                       shadow-lg shadow-indigo-500/20
                       transition">

                <i class="ri-search-line text-lg"></i>

                <span>
                    Search
                </span>

            </button>

        </form>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 2xl:grid-cols-4 gap-5">

        @foreach($stats as $stat)

        <div class="relative overflow-hidden
                    rounded-3xl
                    border border-gray-200 dark:border-slate-800
                    bg-white dark:bg-[#0F172A]
                    p-5 lg:p-6
                    shadow-sm hover:shadow-xl
                    transition-all duration-300 hover:-translate-y-1">

            <div class="flex items-start justify-between gap-4">

                <div>

                    <p class="text-sm font-medium text-gray-500 dark:text-slate-400">
                        {{ $stat['title'] }}
                    </p>

                    <h2 class="mt-3 text-3xl lg:text-4xl font-bold tracking-tight
                               text-gray-900 dark:text-white">

                        {{ $stat['value'] }}

                    </h2>

                    <p class="mt-2 text-sm text-gray-500 dark:text-slate-500">
                        {{ $stat['subtitle'] }}
                    </p>

                </div>

                <div class="w-14 h-14 shrink-0 flex items-center justify-center
                            rounded-2xl border {{ $colors[$stat['color']] }}">

                    <i class="{{ $stat['icon'] }} text-2xl"></i>

                </div>

            </div>


        </div>

        @endforeach

    </div>

    <!-- TABLE -->
    <div class="overflow-hidden rounded-3xl
                border border-gray-200 dark:border-slate-800
                bg-white dark:bg-[#0F172A] shadow-sm">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-5 lg:px-6 py-5
                    border-b border-gray-200 dark:border-slate-800">

            <div>

                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Recent Transactions
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                    Latest customer payments & orders
                </p>

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1100px]">

                <!-- HEAD -->
                <thead>

                    <tr class="bg-gray-50 dark:bg-slate-900/60">

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">
                            Customer
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">
                            Product
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">
                            Amount
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">
                            Payment
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">
                            Date
                        </th>

                    </tr>

                </thead>

                <!-- BODY -->
                <tbody>

                    @forelse($transactions as $transaction)

                    <tr class="border-t border-gray-100 dark:border-slate-800
                               hover:bg-gray-50 dark:hover:bg-slate-900/40 transition">

                        <!-- ID -->
                        <td class="px-6 py-5">

                            <span class="font-semibold text-gray-900 dark:text-white">

                                {{ $transaction->transaction_id }}

                            </span>

                        </td>
                                                
                        <!-- CUSTOMER -->
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">

                                <img src="https://ui-avatars.com/api/?name={{ urlencode($transaction->order->user->name ?? 'Guest') }}"
                                    class="w-11 h-11 rounded-2xl object-cover">
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white">
                                        {{ $transaction->order->user->name ?? 'Guest' }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-slate-400">
                                        {{ $transaction->order->user->email ?? '' }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <!-- PRODUCT -->
                        <td class="px-6 py-5 text-gray-700 dark:text-slate-300">
                            @foreach($transaction->order->orderItems as $item)
                                {{ $item->product->name }} <br>
                            @endforeach
                        </td>

                        <!-- AMOUNT -->
                        <td class="px-6 py-5">

                            <span class="font-semibold text-gray-900 dark:text-white">

                                ${{ number_format($transaction->amount, 2) }}

                            </span>

                        </td>

                        <!-- PAYMENT -->
                        <td class="px-6 py-5">

                            <span class="text-gray-700 dark:text-slate-300">

                                {{ $transaction->payment_method }}

                            </span>

                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-5">

                            <span class="inline-flex items-center gap-2
                                         px-3 py-1.5 rounded-xl text-sm font-medium

                            @if($transaction->status == 'Completed')
                            bg-emerald-500/10 text-emerald-600 dark:text-emerald-400
                            @endif

                            @if($transaction->status == 'Pending')
                            bg-amber-500/10 text-amber-600 dark:text-amber-400
                            @endif

                            @if($transaction->status == 'Refunded')
                            bg-rose-500/10 text-rose-600 dark:text-rose-400
                            @endif
                            ">

                                {{ $transaction->status }}

                            </span>

                        </td>

                        <!-- DATE -->
                        <td class="px-6 py-5">

    <div>

        <h4 class="font-medium text-gray-900 dark:text-white">

{{ $transaction->created_at->timezone('Africa/Mogadishu')->format('M d, Y') }}
        </h4>

        <p class="text-sm text-gray-500 dark:text-slate-400">

{{ $transaction->created_at->timezone('Africa/Mogadishu')->format('h:i A') }}
        </p>

    </div>

</td>
                    </tr>

                    @empty

                    <tr>

                        <td colspan="7"
                            class="px-6 py-10 text-center text-gray-500 dark:text-slate-400">

                            No transactions found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="p-5">

            {{ $transactions->links() }}

        </div>

    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const stats = @json($stats);

    stats.forEach(stat => {

        const ctx = document.getElementById('chart_' + stat.id);

        if (!ctx) return;

        new Chart(ctx, {

            type: 'line',

            data: {

                labels: stat.chart.map((_, i) => i + 1),

                datasets: [{

                    data: stat.chart,

                    borderWidth: 2.5,

                    tension: 0.45,

                    fill: true,

                    pointRadius: 0,

                    borderColor: getColor(stat.color),

                    backgroundColor: getColor(stat.color, true),

                }]
            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {
                        enabled: false
                    }

                },

                scales: {

                    x: {
                        display: false
                    },

                    y: {
                        display: false
                    }

                }

            }

        });

    });

    function getColor(color, bg = false) {

        const map = {

            indigo: bg
                ? 'rgba(99,102,241,0.18)'
                : '#6366f1',

            emerald: bg
                ? 'rgba(16,185,129,0.18)'
                : '#10b981',

            amber: bg
                ? 'rgba(245,158,11,0.18)'
                : '#f59e0b',

            rose: bg
                ? 'rgba(244,63,94,0.18)'
                : '#f43f5e',

        };

        return map[color] || '#6366f1';
    }

});

</script>

</x-layouts.app>