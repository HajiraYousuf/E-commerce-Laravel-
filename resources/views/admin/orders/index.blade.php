<x-layouts.app>

@php

$orders = [

[
'id'=>'#ORD-1001',
'customer'=>'Ahmed Ali',
'email'=>'ahmed@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=12',
'date'=>'May 19, 2026',
'total'=>'$1,240',
'items'=>4,
'payment'=>'Paid',
'method'=>'Credit Card',
'status'=>'Delivered',
],

[
'id'=>'#ORD-1002',
'customer'=>'Amina Noor',
'email'=>'amina@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=32',
'date'=>'May 18, 2026',
'total'=>'$320',
'items'=>2,
'payment'=>'Pending',
'method'=>'PayPal',
'status'=>'Processing',
],

[
'id'=>'#ORD-1003',
'customer'=>'Hassan Yusuf',
'email'=>'hassan@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=15',
'date'=>'May 18, 2026',
'total'=>'$89',
'items'=>1,
'payment'=>'Paid',
'method'=>'Cash',
'status'=>'Cancelled',
],

[
'id'=>'#ORD-1004',
'customer'=>'Mohamed Farah',
'email'=>'mohamed@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=68',
'date'=>'May 17, 2026',
'total'=>'$760',
'items'=>6,
'payment'=>'Paid',
'method'=>'EVC Plus',
'status'=>'Shipped',
],

];

@endphp

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

        <button class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition flex items-center gap-2 w-fit">

            <i class="ri-download-2-line"></i>

            Export Orders

        </button>

    </div>

    {{-- FILTERS --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-4">

        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            {{-- LEFT --}}
            <div class="flex flex-wrap items-center gap-3">

                {{-- STATUS --}}
                <div class="relative">

                    <select class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm font-medium text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">

                        <option>All Status</option>
                        <option>Delivered</option>
                        <option>Processing</option>
                        <option>Shipped</option>
                        <option>Cancelled</option>

                    </select>

                    <i class="ri-arrow-down-s-line absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                </div>

                {{-- PAYMENT --}}
                <div class="relative">

                    <select class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm font-medium text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">

                        <option>Payment Status</option>
                        <option>Paid</option>
                        <option>Pending</option>

                    </select>

                    <i class="ri-arrow-down-s-line absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-3">

                {{-- SEARCH --}}
                <div class="relative w-full sm:w-[280px]">

                    <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input
                        type="text"
                        placeholder="Search orders..."
                        class="h-11 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 pl-10 pr-4 text-sm text-gray-700 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                </div>

            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1250px]">

                <thead class="bg-gray-50 dark:bg-slate-950">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Order
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Customer
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Date
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Items
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Total
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Payment
                        </th>
                        {{-- PAYMENT METHOD COLUMN HEADER --}}
<th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
    Payment Method
</th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-slate-800">

                    @foreach($orders as $order)

                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/40 transition">

                        {{-- ORDER --}}
                        <td class="px-6 py-5">

                            <div>

                                <h3 class="font-semibold text-gray-900 dark:text-white">
                                    {{ $order['id'] }}
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                                    Order ID
                                </p>

                            </div>

                        </td>

                        {{-- CUSTOMER --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <img
                                    src="{{ $order['avatar'] }}"
                                    class="w-12 h-12 rounded-2xl object-cover border border-gray-200 dark:border-slate-700"
                                >

                                <div>

                                    <h3 class="font-semibold text-gray-900 dark:text-white">
                                        {{ $order['customer'] }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-slate-400">
                                        {{ $order['email'] }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        {{-- DATE --}}
                        <td class="px-6 py-5">

                            <span class="text-sm text-gray-600 dark:text-slate-300">
                                {{ $order['date'] }}
                            </span>

                        </td>

                        {{-- ITEMS --}}
                        <td class="px-6 py-5">

                            <span class="text-sm font-medium text-gray-700 dark:text-slate-300">
                                {{ $order['items'] }} items
                            </span>

                        </td>

                        {{-- TOTAL --}}
                        <td class="px-6 py-5">

                            <span class="font-semibold text-emerald-600 dark:text-emerald-400">
                                {{ $order['total'] }}
                            </span>

                        </td>

                        {{-- PAYMENT --}}
                        <td class="px-6 py-5">

                            @if($order['payment'] == 'Paid')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-xs font-semibold">

                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                Paid

                            </span>

                            @else

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 text-xs font-semibold">

                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                                Pending

                            </span>

                            @endif

                        </td>
                        {{-- PAYMENT METHOD DATA --}}
<td class="px-6 py-5">

    @if($order['method'] == 'Credit Card')

    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-indigo-100 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 text-xs font-semibold">

        <i class="ri-bank-card-line"></i>

        Credit Card

    </span>

    @elseif($order['method'] == 'PayPal')

    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-xs font-semibold">

        <i class="ri-paypal-line"></i>

        PayPal

    </span>

    @elseif($order['method'] == 'Cash')

    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-xs font-semibold">

        <i class="ri-money-dollar-circle-line"></i>

        Cash

    </span>

    @else

    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 text-xs font-semibold">

        <i class="ri-smartphone-line"></i>

        EVC Plus

    </span>

    @endif

</td>

                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if($order['status'] == 'Delivered')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-xs font-semibold">

                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                Delivered

                            </span>

                            @elseif($order['status'] == 'Processing')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-xs font-semibold">

                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>

                                Processing

                            </span>

                            @elseif($order['status'] == 'Shipped')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-indigo-100 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 text-xs font-semibold">

                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>

                                Shipped

                            </span>

                            @else

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 text-xs font-semibold">

                                <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                Cancelled

                            </span>

                            @endif

                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2">

                                <button class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-indigo-100 dark:bg-slate-800 dark:hover:bg-indigo-500/10 text-gray-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">

                                    <i class="ri-eye-line"></i>

                                </button>

                                <button class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-100 dark:bg-slate-800 dark:hover:bg-blue-500/10 text-gray-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition">

                                    <i class="ri-pencil-line"></i>

                                </button>

                                <button class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-red-100 dark:bg-slate-800 dark:hover:bg-red-500/10 text-gray-600 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400 transition">

                                    <i class="ri-delete-bin-6-line"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-layouts.app>