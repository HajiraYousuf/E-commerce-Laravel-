{{-- =========================================
MessagesList.blade.php
Simple Messages Management UI
Responsive + Dark/Light
========================================= --}}

@php

$messages = [

[
'id'=>1001,
'name'=>'Ahmed Hassan',
'email'=>'ahmed@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=1',
'message'=>'Order-keyga wali ma shipped baa?',
'time'=>'2 min ago',
'status'=>'Unread',
'priority'=>'High'
],

[
'id'=>1002,
'name'=>'Amina Ali',
'email'=>'amina@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=5',
'message'=>'Waxaan rabaa refund payment-ka.',
'time'=>'10 min ago',
'status'=>'Read',
'priority'=>'Medium'
],

[
'id'=>1003,
'name'=>'Mohamed Yusuf',
'email'=>'mohamed@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=8',
'message'=>'Product-kan stock ma kusoo laabtay?',
'time'=>'30 min ago',
'status'=>'Unread',
'priority'=>'Low'
],

[
'id'=>1004,
'name'=>'Hodan Omar',
'email'=>'hodan@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=9',
'message'=>'Address-keyga ayaan rabaa inaan badalo.',
'time'=>'1 hr ago',
'status'=>'Read',
'priority'=>'Medium'
],

[
'id'=>1005,
'name'=>'Khalid Noor',
'email'=>'khalid@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=12',
'message'=>'Payment successful laakiin invoice ma helin.',
'time'=>'2 hr ago',
'status'=>'Unread',
'priority'=>'High'
],

];

@endphp

<x-layouts.app>

<div class="p-4 lg:p-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Customer Messages
            </h1>

            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Manage customer conversations and support requests
            </p>
        </div>

        {{-- SEARCH --}}
        <div class="relative w-full md:w-80">

            <i class="ri-search-line absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

            <input
                type="text"
                placeholder="Search messages..."
                class="w-full h-12 pl-11 pr-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
            >

        </div>

    </div>

   {{-- TABLE --}}
<div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden">

    <table class="w-full">

        {{-- TABLE HEAD --}}
        <thead class="hidden lg:table-header-group border-b border-gray-100 dark:border-slate-800 text-sm font-semibold text-gray-500 dark:text-slate-400">

            <tr>
                <th class="text-left px-6 py-4">Customer</th>
                <th class="text-left px-6 py-4">Message</th>
                <th class="text-left px-6 py-4">Priority</th>
                <th class="text-left px-6 py-4">Status</th>
                <th class="text-left px-6 py-4">Time</th>
                <th class="text-right px-6 py-4">Action</th>
            </tr>

        </thead>

        {{-- BODY --}}
        <tbody class="divide-y divide-gray-100 dark:divide-slate-800">

            @foreach($messages as $msg)

            <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/50 transition">

                {{-- CUSTOMER --}}
                <td class="px-4 lg:px-6 py-5">

                    <div class="flex items-center gap-4">

                        <img src="{{ $msg['avatar'] }}"
                             class="w-12 h-12 rounded-2xl object-cover">

                        <div class="min-w-0">

                            <h3 class="font-semibold text-gray-900 dark:text-white truncate">
                                {{ $msg['name'] }}
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-slate-400 truncate">
                                {{ $msg['email'] }}
                            </p>

                        </div>

                    </div>

                </td>

                {{-- MESSAGE --}}
                <td class="px-4 lg:px-6 py-5">

                    <p class="text-sm text-gray-600 dark:text-slate-300 line-clamp-2">
                        {{ $msg['message'] }}
                    </p>

                </td>

                {{-- PRIORITY --}}
                <td class="px-4 lg:px-6 py-5">

                    <span class="px-4 py-2 rounded-xl text-xs font-semibold

                        @if($msg['priority']=='High')
                            bg-red-100 text-red-600 dark:bg-red-500/10 dark:text-red-400
                        @elseif($msg['priority']=='Medium')
                            bg-yellow-100 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400
                        @else
                            bg-green-100 text-green-600 dark:bg-green-500/10 dark:text-green-400
                        @endif
                    ">
                        {{ $msg['priority'] }}
                    </span>

                </td>

                {{-- STATUS --}}
                <td class="px-4 lg:px-6 py-5">

                    <span class="px-3 py-1 rounded-xl text-xs font-medium

                        @if($msg['status']=='Unread')
                            bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400
                        @else
                            bg-gray-100 text-gray-600 dark:bg-slate-700 dark:text-slate-300
                        @endif
                    ">
                        {{ $msg['status'] }}
                    </span>

                </td>

                {{-- TIME --}}
                <td class="px-4 lg:px-6 py-5">

                    <span class="text-sm text-gray-500 dark:text-slate-400">
                        {{ $msg['time'] }}
                    </span>

                </td>

                {{-- ACTIONS --}}
                <td class="px-4 lg:px-6 py-5 text-right">

                    <div class="flex justify-end gap-2">

                        <button class="h-10 w-10 rounded-xl border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-slate-300 flex items-center justify-center hover:bg-indigo-50 dark:hover:bg-slate-800">
                            <i class="ri-eye-line"></i>
                        </button>

                        <button class="h-10 w-10 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white flex items-center justify-center">
                            <i class="ri-chat-1-line"></i>
                        </button>

                    </div>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>
</div>

</x-layouts.app>