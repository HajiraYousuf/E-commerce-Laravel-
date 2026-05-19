{{-- =========================
Transactions Table
Pro UI + Responsive + Light/Dark
========================= --}}

@php

$transactions=[

[
'id'=>'#TRX-00124',
'customer'=>'Ahmad Ali',
'email'=>'ahmad@example.com',
'avatar'=>'https://i.pravatar.cc/100?img=1',
'product'=>'MacBook Pro 16"',
'amount'=>'$2,499.00',
'payment'=>'Credit Card',
'payment_icon'=>'ri-bank-card-line',
'status'=>'Completed',
'status_color'=>'green',
'date'=>'May 28, 2024',
'time'=>'10:30 AM',
],

[
'id'=>'#TRX-00123',
'customer'=>'Sarah Johnson',
'email'=>'sarah@example.com',
'avatar'=>'https://i.pravatar.cc/100?img=5',
'product'=>'iPhone 15 Pro',
'amount'=>'$999.00',
'payment'=>'PayPal',
'payment_icon'=>'ri-paypal-line',
'status'=>'Completed',
'status_color'=>'green',
'date'=>'May 28, 2024',
'time'=>'09:15 AM',
],

[
'id'=>'#TRX-00122',
'customer'=>'Mohamed Hassan',
'email'=>'mohamed@example.com',
'avatar'=>'https://i.pravatar.cc/100?img=8',
'product'=>'AirPods Pro',
'amount'=>'$249.00',
'payment'=>'Apple Pay',
'payment_icon'=>'ri-apple-line',
'status'=>'Pending',
'status_color'=>'yellow',
'date'=>'May 28, 2024',
'time'=>'08:45 AM',
],

[
'id'=>'#TRX-00121',
'customer'=>'Emily Davis',
'email'=>'emily@example.com',
'avatar'=>'https://i.pravatar.cc/100?img=9',
'product'=>'Apple Watch Series 9',
'amount'=>'$399.00',
'payment'=>'Stripe',
'payment_icon'=>'ri-secure-payment-line',
'status'=>'Refunded',
'status_color'=>'red',
'date'=>'May 27, 2024',
'time'=>'04:20 PM',
],

];

@endphp



<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>



<div class="overflow-hidden rounded-3xl border border-gray-200 dark:border-slate-800 bg-white dark:bg-[#0F172A] shadow-sm">

    {{-- HEADER --}}
    <div class="flex items-center justify-between px-5 lg:px-6 py-5 border-b border-gray-200 dark:border-slate-800">

        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                Recent Transactions
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                Latest customer payments & orders
            </p>
        </div>

        <button class="h-11 px-5 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/70 text-gray-700 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition flex items-center gap-2">

            <i class="ri-download-2-line"></i>

            <span class="text-sm font-medium">
                Export
            </span>

        </button>

    </div>



    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full min-w-[1100px]">

            {{-- HEAD --}}
            <thead>

                <tr class="bg-gray-50 dark:bg-slate-900/60">

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        ID
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Customer
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Product
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Amount
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Payment
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Status
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Date
                    </th>

                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Action
                    </th>

                </tr>

            </thead>



            {{-- BODY --}}
            <tbody>

                @foreach($transactions as $transaction)

                <tr class="border-t border-gray-100 dark:border-slate-800 hover:bg-gray-50 dark:hover:bg-slate-900/40 transition">

                    {{-- ID --}}
                    <td class="px-6 py-5">

                        <span class="font-semibold text-gray-900 dark:text-white">
                            {{ $transaction['id'] }}
                        </span>

                    </td>



                    {{-- CUSTOMER --}}
                    <td class="px-6 py-5">

                        <div class="flex items-center gap-3">

                            <img src="{{ $transaction['avatar'] }}"
                                 class="w-11 h-11 rounded-2xl object-cover ring-2 ring-white dark:ring-slate-700">

                            <div class="min-w-0">

                                <h3 class="font-medium text-gray-900 dark:text-white truncate">
                                    {{ $transaction['customer'] }}
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-slate-400 truncate">
                                    {{ $transaction['email'] }}
                                </p>

                            </div>

                        </div>

                    </td>



                    {{-- PRODUCT --}}
                    <td class="px-6 py-5 text-gray-700 dark:text-slate-300">
                        {{ $transaction['product'] }}
                    </td>



                    {{-- AMOUNT --}}
                    <td class="px-6 py-5">

                        <span class="font-semibold text-gray-900 dark:text-white">
                            {{ $transaction['amount'] }}
                        </span>

                    </td>



                    {{-- PAYMENT --}}
                    <td class="px-6 py-5">

                        <div class="inline-flex items-center gap-2">

                            <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-gray-100 dark:bg-slate-800 text-gray-700 dark:text-slate-300">

                                <i class="{{ $transaction['payment_icon'] }}"></i>

                            </div>

                            <span class="text-gray-700 dark:text-slate-300">
                                {{ $transaction['payment'] }}
                            </span>

                        </div>

                    </td>



                    {{-- STATUS --}}
                    <td class="px-6 py-5">

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-sm font-medium

                        @if($transaction['status_color']=='green')
                        bg-emerald-500/10 text-emerald-600 dark:text-emerald-400
                        @endif

                        @if($transaction['status_color']=='yellow')
                        bg-amber-500/10 text-amber-600 dark:text-amber-400
                        @endif

                        @if($transaction['status_color']=='red')
                        bg-rose-500/10 text-rose-600 dark:text-rose-400
                        @endif
                        ">

                            <span class="w-2 h-2 rounded-full

                            @if($transaction['status_color']=='green')
                            bg-emerald-500
                            @endif

                            @if($transaction['status_color']=='yellow')
                            bg-amber-500
                            @endif

                            @if($transaction['status_color']=='red')
                            bg-rose-500
                            @endif
                            "></span>

                            {{ $transaction['status'] }}

                        </span>

                    </td>



                    {{-- DATE --}}
                    <td class="px-6 py-5">

                        <div>

                            <h4 class="font-medium text-gray-900 dark:text-white">
                                {{ $transaction['date'] }}
                            </h4>

                            <p class="text-sm text-gray-500 dark:text-slate-400">
                                {{ $transaction['time'] }}
                            </p>

                        </div>

                    </td>



                    {{-- ACTION --}}
                    <td class="px-6 py-5 text-right">

                        <div class="flex items-center justify-end gap-2">

                            {{-- VIEW --}}
                            <button class="w-10 h-10 rounded-xl flex items-center justify-center bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-500 hover:text-white transition">

                                <i class="ri-eye-line text-lg"></i>

                            </button>

                            {{-- MENU --}}
                            <button class="w-10 h-10 rounded-xl flex items-center justify-center text-gray-500 dark:text-slate-400 hover:bg-gray-100 dark:hover:bg-slate-800 hover:text-gray-900 dark:hover:text-white transition">

                                <i class="ri-more-2-fill text-lg"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div> 