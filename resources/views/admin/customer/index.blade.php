<x-layouts.app>

@php

$customers = [

[
'id'=>'#CUS-1001',
'name'=>'Ahmed Ali',
'email'=>'ahmed@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=12',
'phone'=>'+252 61 2345678',
'country'=>'Somalia',
'orders'=>24,
'spent'=>'$12,450',
'status'=>'Active',
'joined'=>'2 hours ago',
],

[
'id'=>'#CUS-1002',
'name'=>'Amina Noor',
'email'=>'amina@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=32',
'phone'=>'+252 63 9876543',
'country'=>'Somalia',
'orders'=>8,
'spent'=>'$1,120',
'status'=>'Active',
'joined'=>'1 day ago',
],

[
'id'=>'#CUS-1003',
'name'=>'Hassan Yusuf',
'email'=>'hassan@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=15',
'phone'=>'+252 65 4455667',
'country'=>'Somalia',
'orders'=>3,
'spent'=>'$320',
'status'=>'Blocked',
'joined'=>'3 days ago',
],

[
'id'=>'#CUS-1004',
'name'=>'Mohamed Farah',
'email'=>'mohamed@gmail.com',
'avatar'=>'https://i.pravatar.cc/100?img=68',
'phone'=>'+252 62 7788990',
'country'=>'Somalia',
'orders'=>41,
'spent'=>'$24,700',
'status'=>'Active',
'joined'=>'1 week ago',
],

];

@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Customers
            </h1>

            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Manage all registered customers
            </p>

        </div>

        <button class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition flex items-center gap-2 w-fit">

            <i class="ri-user-add-line"></i>

            Add Customer

        </button>

    </div>

    {{-- FILTERS --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-4">

        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            {{-- LEFT --}}
            <div class="flex flex-wrap items-center gap-3">

                <div class="relative">

                    <select class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm font-medium text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">

                        <option>All Status</option>
                        <option>Active</option>
                        <option>Blocked</option>

                    </select>

                    <i class="ri-arrow-down-s-line absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                </div>

                <div class="relative">

                    <select class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm font-medium text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">

                        <option>Sort By</option>
                        <option>Newest</option>
                        <option>Oldest</option>
                        <option>Top Spent</option>

                    </select>

                    <i class="ri-arrow-down-s-line absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                </div>

            </div>

            {{-- SEARCH --}}
            <div class="relative w-full sm:w-[280px]">

                <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                <input
                    type="text"
                    placeholder="Search customers..."
                    class="h-11 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 pl-10 pr-4 text-sm text-gray-700 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                >

            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1250px]">

                <thead class="bg-gray-50 dark:bg-slate-950">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Phone</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Country</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Orders</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Spent</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Joined</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Actions</th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-slate-800">

                    @foreach($customers as $c)

                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/40 transition">

                        {{-- CUSTOMER --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <img src="{{ $c['avatar'] }}" class="w-12 h-12 rounded-2xl object-cover border border-gray-200 dark:border-slate-700">

                                <div>

                                    <h3 class="font-semibold text-gray-900 dark:text-white">
                                        {{ $c['name'] }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-slate-400">
                                        {{ $c['email'] }} • {{ $c['id'] }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-5 text-sm text-gray-600 dark:text-slate-300">
                            {{ $c['phone'] }}
                        </td>

                        <td class="px-6 py-5 text-sm text-gray-600 dark:text-slate-300">
                            {{ $c['country'] }}
                        </td>

                        <td class="px-6 py-5 font-medium text-gray-900 dark:text-white">
                            {{ $c['orders'] }}
                        </td>

                        <td class="px-6 py-5 font-semibold text-emerald-600 dark:text-emerald-400">
                            {{ $c['spent'] }}
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if($c['status'] == 'Active')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Active
                            </span>

                            @else

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                Blocked
                            </span>

                            @endif

                        </td>

                        <td class="px-6 py-5 text-sm text-gray-500 dark:text-slate-400">
                            {{ $c['joined'] }}
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2">

                                <button class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-indigo-100 dark:bg-slate-800 dark:hover:bg-indigo-500/10 text-gray-600 dark:text-slate-300">
                                    <i class="ri-eye-line"></i>
                                </button>

                                <button class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-100 dark:bg-slate-800 dark:hover:bg-blue-500/10 text-gray-600 dark:text-slate-300">
                                    <i class="ri-pencil-line"></i>
                                </button>

                                <button class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-red-100 dark:bg-slate-800 dark:hover:bg-red-500/10 text-gray-600 dark:text-slate-300">
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