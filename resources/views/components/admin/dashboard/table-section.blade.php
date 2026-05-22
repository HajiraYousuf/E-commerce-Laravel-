<div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-2xl border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">

    <div class="p-6 border-b border-slate-200/50 dark:border-slate-700/50 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                Recent Orders
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Latest customer orders
            </p>
        </div>

        <button class="text-blue-600 text-sm">View All</button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">

            <thead>
                <tr class="text-left text-sm text-slate-600 dark:text-slate-300">
                    <th class="p-4">Order ID</th>
                    <th class="p-4">Customer</th>
                    <th class="p-4">Product</th>
                    <th class="p-4">Amount</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($recentOrders as $order)

                @php
                    $statusColors = [
                        'completed' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                        'pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                        'cancelled' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                    ];
                @endphp

                <tr class="border-b border-slate-200/50 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-slate-800/50">

                    <td class="p-4 text-blue-500 font-medium">
                        {{ $order['id'] }}
                    </td>

                    <td class="p-4 text-slate-800 dark:text-white">
                        {{ $order['customer'] }}
                    </td>

                    <td class="p-4 text-slate-800 dark:text-white">
                        {{ $order['product'] }}
                    </td>

                    <td class="p-4 text-slate-800 dark:text-white">
                        {{ $order['amount'] }}
                    </td>

                    <td class="p-4">
                        <span class="text-xs px-3 py-1 rounded-full
                            {{ $statusColors[$order['status']] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ $order['status'] }}
                        </span>
                    </td>

                    <td class="p-4 text-slate-600 dark:text-slate-300">
                        {{ $order['date'] }}
                    </td>

                </tr>

                @endforeach
            </tbody>

        </table>
    </div>

</div>

<div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-2xl border border-slate-200/50 dark:border-slate-700/50 overflow-hidden mt-6">

    <div class="p-6 border-b border-slate-200/50 dark:border-slate-700/50 flex items-center justify-between">

        <div>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">
                Top Products
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Best performing products
            </p>
        </div>

        <button class="text-blue-600 text-sm">View All</button>

    </div>

    <div class="p-6 space-y-4">

        @foreach($topProducts as $product)

        <div class="flex items-center justify-between p-4 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50">

            <div>
                <h4 class="text-sm font-semibold text-slate-800 dark:text-white">
                    {{ $product['name'] }}
                </h4>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Sales: {{ $product['sales'] }}
                </p>
            </div>

            <div class="text-right">

                <p class="text-sm font-semibold text-slate-800 dark:text-white">
                    {{ $product['revenue'] }}
                </p>

                <div class="flex items-center space-x-1">

                   @php
                        $isUp = $product['trend'] === 'up';
                        $icon = $isUp ? 'arrow-up-right' : 'arrow-down-right';
                        $color = $isUp ? 'text-emerald-500' : 'text-red-500';
                    @endphp

                    <div class="flex items-center gap-1">

                        <i data-lucide="{{ $icon }}"
                        class="w-3.5 h-3.5 {{ $color }}"
                        stroke-width="2.5"></i>

                        <span class="text-xs font-medium {{ $color }}">
                            {{ $product['change'] }}
                        </span>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

<script src="https://unpkg.com/lucide@latest"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        lucide.createIcons();
    });
</script>