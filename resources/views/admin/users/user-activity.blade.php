<x-layouts.app>
    @php

$activities = [

[
'user'=>'Ahmed Ali',
'email'=>'ahmed@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=12',
'action'=>'Created Product',
'module'=>'Products',
'ip'=>'192.168.1.24',
'device'=>'Windows / Chrome',
'status'=>'Success',
'date'=>'May 20, 2026',
'time'=>'10:45 AM',
],

[
'user'=>'Amina Noor',
'email'=>'amina@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=32',
'action'=>'Deleted User',
'module'=>'Users',
'ip'=>'192.168.1.10',
'device'=>'MacOS / Safari',
'status'=>'Warning',
'date'=>'May 20, 2026',
'time'=>'09:20 AM',
],

[
'user'=>'Hassan Yusuf',
'email'=>'hassan@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=15',
'action'=>'Updated Order',
'module'=>'Orders',
'ip'=>'192.168.1.88',
'device'=>'Android / Chrome',
'status'=>'Success',
'date'=>'May 19, 2026',
'time'=>'08:10 PM',
],

[
'user'=>'Mohamed Farah',
'email'=>'mohamed@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=68',
'action'=>'Failed Login',
'module'=>'Authentication',
'ip'=>'192.168.1.50',
'device'=>'iPhone / Safari',
'status'=>'Failed',
'date'=>'May 19, 2026',
'time'=>'01:15 PM',
],

];

@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                User Activity
            </h1>

            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Track all user activities and system actions
            </p>

        </div>


    </div>

    {{-- FILTERS --}}
<div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-4">

    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

        {{-- LEFT --}}
        <div class="flex flex-wrap items-center gap-3">

            {{-- USERS --}}
            <div class="relative">

                <select class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm font-medium text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">

                    <option>All Users</option>
                    <option>Ahmed Ali</option>
                    <option>Hassan Yusuf</option>
                    <option>Amina Noor</option>

                </select>

                <i class="ri-arrow-down-s-line absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

            </div>

            {{-- ACTIONS --}}
            <div class="relative">

                <select class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm font-medium text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">

                    <option>All Actions</option>
                    <option>Create</option>
                    <option>Update</option>
                    <option>Delete</option>
                    <option>Login</option>

                </select>

                <i class="ri-arrow-down-s-line absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

            </div>

            {{-- DATE RANGE --}}
            <button
                id="dateButton"
                class="h-11 px-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 hover:bg-gray-100 dark:hover:bg-slate-700 transition flex items-center gap-3"
            >

                <div class="w-8 h-8 rounded-xl bg-indigo-100 dark:bg-indigo-500/10 flex items-center justify-center">

                    <i class="ri-calendar-line text-indigo-600 dark:text-indigo-400"></i>

                </div>

                <span id="dateText" class="text-sm font-medium text-gray-700 dark:text-slate-200 whitespace-nowrap">
                    Jan 05, 2024 → Jan 05, 2025
                </span>

            </button>

        </div>

        {{-- RIGHT --}}
        <div class="flex items-center gap-3">

            {{-- SEARCH --}}
            <div class="relative w-full sm:w-[280px]">

                <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                <input
                    type="text"
                    placeholder="Search activity..."
                    class="h-11 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 pl-10 pr-4 text-sm text-gray-700 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                >

            </div>

            {{-- EXPORT --}}
            <button class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition flex items-center gap-2 whitespace-nowrap">

                <i class="ri-download-2-line"></i>

                Export

            </button>

        </div>

    </div>

</div>
    {{-- TABLE --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1300px]">

                <thead class="bg-gray-50 dark:bg-slate-950">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            User
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Action
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Module
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            IP Address
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Device
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Date
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Time
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-slate-800">

                    @foreach($activities as $activity)

                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/40 transition">

                        {{-- USER --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <img
                                    src="{{ $activity['avatar'] }}"
                                    class="w-12 h-12 rounded-2xl object-cover border border-gray-200 dark:border-slate-700"
                                >

                                <div>

                                    <h3 class="font-semibold text-gray-900 dark:text-white">
                                        {{ $activity['user'] }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-slate-400">
                                        {{ $activity['email'] }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        {{-- ACTION --}}
                        <td class="px-6 py-5">

                            <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $activity['action'] }}
                            </span>

                        </td>

                        {{-- MODULE --}}
                        <td class="px-6 py-5">

                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl bg-indigo-100 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 text-xs font-semibold">
                                {{ $activity['module'] }}
                            </span>

                        </td>

                        {{-- IP --}}
                        <td class="px-6 py-5">

                            <span class="text-sm text-gray-600 dark:text-slate-300">
                                {{ $activity['ip'] }}
                            </span>

                        </td>

                        {{-- DEVICE --}}
                        <td class="px-6 py-5">

                            <span class="text-sm text-gray-600 dark:text-slate-300">
                                {{ $activity['device'] }}
                            </span>

                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if($activity['status'] == 'Success')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Success
                            </span>

                            @elseif($activity['status'] == 'Warning')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Warning
                            </span>

                            @else

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                Failed
                            </span>

                            @endif

                        </td>

                        {{-- DATE --}}
                        <td class="px-6 py-5">

                            <span class="text-sm text-gray-600 dark:text-slate-300">
                                {{ $activity['date'] }}
                            </span>

                        </td>

                        {{-- TIME --}}
                        <td class="px-6 py-5">

                            <span class="text-sm text-gray-600 dark:text-slate-300">
                                {{ $activity['time'] }}
                            </span>

                        </td>

                        {{-- ACTION --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2">

                                <button class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-indigo-100 dark:bg-slate-800 dark:hover:bg-indigo-500/10 text-gray-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                    <i class="ri-eye-line"></i>
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