@php
        $highlight = request('highlight');

@endphp
<x-layouts.app>

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Orders List
            </h1>

            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Manage customer orders and payments
            </p>
        </div>

        <form action="{{ route('order.export') }}" method="GET">
            <button type="submit"
                class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition flex items-center gap-2 w-fit">

                <i class="ri-download-2-line"></i>

                Export Orders
            </button>
        </form>

    </div>
<form method="GET"
      class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

    <div class="flex flex-wrap items-center gap-3">

        {{-- ORDER STATUS --}}
        <div class="relative">

            <select name="status"
                class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm font-medium text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">

                <option value="">All Status</option>

                <option value="Delivered"
                    {{ request('status') == 'Delivered' ? 'selected' : '' }}>
                    Delivered
                </option>

                <option value="Processing"
                    {{ request('status') == 'Processing' ? 'selected' : '' }}>
                    Processing
                </option>

                <option value="Shipped"
                    {{ request('status') == 'Shipped' ? 'selected' : '' }}>
                    Shipped
                </option>

                <option value="Cancelled"
                    {{ request('status') == 'Cancelled' ? 'selected' : '' }}>
                    Cancelled
                </option>

            </select>

            <i class="ri-arrow-down-s-line absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

        </div>

        {{-- PAYMENT STATUS --}}
        <div class="relative">

            <select name="payment_status"
                class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm font-medium text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">

                <option value="">Payment Status</option>

                <option value="Paid"
                    {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>
                    Paid
                </option>

                <option value="Pending"
                    {{ request('payment_status') == 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

            </select>

            <i class="ri-arrow-down-s-line absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

        </div>

    </div>

    {{-- SEARCH --}}
    <div class="flex gap-3 w-full sm:w-auto">

        <div class="relative w-full sm:w-[280px]">

            <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search orders..."
                class="h-11 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 pl-10 pr-4 text-sm text-gray-700 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500">

        </div>

        <button type="submit"
            class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition">

            Search

        </button>

    </div>

</form>

    {{-- TABLE --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1250px]">

                <thead class="bg-gray-50 dark:bg-slate-950">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400">Items</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400">Payment</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400">Payment Method</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-slate-800">

                    @forelse($orders as $order)

                    <tr id="item-{{ $order->id }}"
                    class="transition hover:bg-gray-50 dark:hover:bg-slate-800/40
                    {{ (string)$highlight === (string)$order->id ? 'bg-yellow-200 dark:bg-yellow-700' : '' }}">

                        {{-- ORDER --}}
                        <td class="px-6 py-5">
                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                #ORD-{{ $order->id }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                                Order ID
                            </p>
                        </td>

                        {{-- CUSTOMER --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">

                                <img src="https://i.pravatar.cc/100?u={{ $order->user_id }}"
                                    class="w-12 h-12 rounded-2xl object-cover border border-gray-200 dark:border-slate-700">

                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">
                                        {{ $order->user->name ?? 'Unknown' }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-slate-400">
                                        {{ $order->user->email ?? '' }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        {{-- DATE --}}
                        <td class="px-6 py-5 text-sm text-gray-600 dark:text-slate-300">
                            {{ $order->created_at->format('M d, Y') }}
                        </td>

                        {{-- ITEMS --}}
                        <td class="px-6 py-5 text-sm font-medium text-gray-700 dark:text-slate-300">
                            {{ $order->orderItems->count() }} items
                        </td>

                        {{-- TOTAL --}}
                        <td class="px-6 py-5 font-semibold text-emerald-600 dark:text-emerald-400">
                            ${{ $order->total }}
                        </td>

                        {{-- PAYMENT --}}
                        <td class="px-6 py-5">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl {{ $order->payment_status ?? 'bg-amber-100 text-amber-700' }} text-xs font-semibold">
                                {{ $order->payment_status ?? 'Pending' }}
                            </span>
                        </td>

                        {{-- METHOD --}}
                        <td class="px-6 py-5 text-xs font-semibold text-gray-700 dark:text-slate-300">
                            {{ $order->payment_method ?? 'Cash' }}
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if($order->status == 'Delivered')
                                <span class="px-3 py-1 rounded-xl bg-emerald-100 text-emerald-700 text-xs">Delivered</span>

                            @elseif($order->status == 'Processing')
                                <span class="px-3 py-1 rounded-xl bg-blue-100 text-blue-700 text-xs">Processing</span>

                            @elseif($order->status == 'Shipped')
                                <span class="px-3 py-1 rounded-xl bg-indigo-100 text-indigo-700 text-xs">Shipped</span>

                            @else
                                <span class="px-3 py-1 rounded-xl bg-red-100 text-red-700 text-xs">Cancelled</span>
                            @endif

                        </td>

                       
                    </tr>

                    @empty

                    <tr>
                        <td colspan="9" class="text-center py-10 text-gray-500">
                            No orders found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-layouts.app>