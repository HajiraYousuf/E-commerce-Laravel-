<x-layouts.app>
    @php
$users = [
[
'id'=>'#USR-1001',
'name'=>'Ahmed Ali',
'email'=>'ahmed@gmail.com',
'role'=>'Admin',
'status'=>'Active',
'orders'=>124,
'spent'=>'$12,450',
'joined'=>'2 hours ago',
'avatar'=>'https://i.pravatar.cc/100?img=12',
],
[
'id'=>'#USR-1002',
'name'=>'Hassan Yusuf',
'email'=>'hassan@gmail.com',
'role'=>'Customer',
'status'=>'Pending',
'orders'=>48,
'spent'=>'$3,120',
'joined'=>'1 day ago',
'avatar'=>'https://i.pravatar.cc/100?img=15',
],
[
'id'=>'#USR-1003',
'name'=>'Amina Noor',
'email'=>'amina@gmail.com',
'role'=>'Customer',
'status'=>'Blocked',
'orders'=>19,
'spent'=>'$980',
'joined'=>'3 days ago',
'avatar'=>'https://i.pravatar.cc/100?img=32',
],
[
'id'=>'#USR-1004',
'name'=>'Mohamed Farah',
'email'=>'mohamed@gmail.com',
'role'=>'Admin',
'status'=>'Active',
'orders'=>210,
'spent'=>'$24,700',
'joined'=>'1 week ago',
'avatar'=>'https://i.pravatar.cc/100?img=68',
],
];
$stats = [
[
'title' => 'Total Users',
'value' => '24,892',
'change' => '+12.5%',
'up' => true,
'icon' => 'ri-group-line',
'bg' => 'bg-indigo-100 dark:bg-indigo-500/10',
'text' => 'text-indigo-600 dark:text-indigo-400',
],
[
'title' => 'Active Users',
'value' => '18,420',
'change' => '+8.2%',
'up' => true,
'icon' => 'ri-user-smile-line',
'bg' => 'bg-emerald-100 dark:bg-emerald-500/10',
'text' => 'text-emerald-600 dark:text-emerald-400',
],
[
'title' => 'Inactive Users',
'value' => '2,184',
'change' => '-3.1%',
'up' => false,
'icon' => 'ri-user-unfollow-line',
'bg' => 'bg-red-100 dark:bg-red-500/10',
'text' => 'text-red-600 dark:text-red-400',
],
[
'title' => 'New Users',
'value' => '1,289',
'change' => '+18.7%',
'up' => true,
'icon' => 'ri-user-add-line',
'bg' => 'bg-amber-100 dark:bg-amber-500/10',
'text' => 'text-amber-600 dark:text-amber-400',
],
];
@endphp  

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

    @foreach($stats as $stat)

    <div class="relative overflow-hidden rounded-3xl border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-5">

        {{-- TOP --}}
        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-medium text-gray-500 dark:text-slate-400">
                    {{ $stat['title'] }}
                </p>

                <h2 class="mt-3 text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $stat['value'] }}
                </h2>

            </div>

            <div class="w-14 h-14 rounded-2xl flex items-center justify-center {{ $stat['bg'] }}">

                <i class="{{ $stat['icon'] }} text-2xl {{ $stat['text'] }}"></i>

            </div>

        </div>

        {{-- BOTTOM --}}
<div class="mt-6 flex items-center gap-2">

    @if($stat['up'])

    <div class="w-7 h-7 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center">
        <i class="ri-arrow-right-up-line text-emerald-600 dark:text-emerald-400"></i>
    </div>

    <span class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">
        {{ $stat['change'] }}
    </span>

    @else

    <div class="w-7 h-7 rounded-xl bg-red-100 dark:bg-red-500/10 flex items-center justify-center">
        <i class="ri-arrow-right-down-line text-red-600 dark:text-red-400"></i>
    </div>

    <span class="text-sm font-semibold text-red-600 dark:text-red-400">
        {{ $stat['change'] }}
    </span>

    @endif

    <span class="text-sm text-gray-400 dark:text-slate-500">
        this month
    </span>

</div>

    </div>

    @endforeach

</div>

<div class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200 dark:border-slate-800 overflow-hidden">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 p-6 border-b border-gray-200 dark:border-slate-800">

        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                All Users
            </h2>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Fake data demo (Blade only)
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">

    {{-- SEARCH --}}
    <div class="relative">
        <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

        <input
            type="text"
            placeholder="Search users..."
            class="h-11 w-64 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 pl-10 pr-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
        >
    </div>

    {{-- ROLE FILTER --}}
    <div class="relative">

        <select class="h-11 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none cursor-pointer">

            <option>All Roles</option>
            <option>Admin</option>
            <option>Customer</option>

        </select>

        <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>

    </div>

    {{-- STATUS FILTER --}}
    <div class="relative">

        <select class="h-11 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none cursor-pointer">

            <option>All Status</option>
            <option>Active</option>
            <option>Pending</option>
            <option>Blocked</option>

        </select>

        <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>

    </div>

    {{-- BUTTON --}}
    <button class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition">
        Add User
    </button>

</div>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full min-w-[1200px]">

            <thead class="bg-gray-50 dark:bg-slate-950">

                <tr class="text-left">

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        User
                    </th>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Role
                    </th>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Status
                    </th>


                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Orders
                    </th>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Total Spent
                    </th>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                        Joined
                    </th>

                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400 text-center">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-slate-800">

                @foreach($users as $user)

                <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/40 transition">

                    {{-- USER --}}
                    <td class="px-6 py-5">

                        <div class="flex items-center gap-4">

                            <img
                                src="{{ $user['avatar'] }}"
                                class="w-12 h-12 rounded-2xl object-cover border border-gray-200 dark:border-slate-700"
                            >

                            <div>

                                <h3 class="font-semibold text-gray-900 dark:text-white">
                                    {{ $user['name'] }}
                                </h3>

                                <div class="flex items-center gap-2 mt-1">

                                    <span class="text-xs text-indigo-600 dark:text-indigo-400 font-medium">
                                        {{ $user['id'] }}
                                    </span>

                                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>

                                    <span class="text-sm text-gray-500 dark:text-slate-400">
                                        {{ $user['email'] }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </td>

                    {{-- ROLE --}}
                    <td class="px-6 py-5">

                        @if($user['role'] == 'Admin')

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-purple-100 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400 text-xs font-semibold">
                            <i class="ri-shield-star-line"></i>
                            Admin
                        </span>

                        @else

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-xs font-semibold">
                            <i class="ri-user-line"></i>
                            Customer
                        </span>

                        @endif

                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-5">

                        @if($user['status'] == 'Active')

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Active
                        </span>

                        @elseif($user['status'] == 'Pending')

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            Pending
                        </span>

                        @else

                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            Blocked
                        </span>

                        @endif

                    </td>


                    {{-- ORDERS --}}
                    <td class="px-6 py-5">

                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $user['orders'] }}
                        </span>

                    </td>

                    {{-- SPENT --}}
                    <td class="px-6 py-5">

                        <span class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                            {{ $user['spent'] }}
                        </span>

                    </td>

                    {{-- JOINED --}}
                    <td class="px-6 py-5">

                        <span class="text-sm text-gray-500 dark:text-slate-400">
                            {{ $user['joined'] }}
                        </span>

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

</x-layouts.app>