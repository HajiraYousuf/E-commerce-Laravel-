
<x-layouts.app>

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

    @foreach($stats as $stat)

    <div class="relative overflow-hidden rounded-3xl border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-5">

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

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 p-6 border-b border-gray-200 dark:border-slate-800">

        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                All Users
            </h2>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Dynamic data from database
            </p>
        </div>

    </div>

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

                    <td class="px-6 py-5">

                        <div class="flex items-center gap-4">

                            <img src="{{ $user->avatar ?? 'https://i.pravatar.cc/100' }}"
                                class="w-12 h-12 rounded-2xl object-cover border border-gray-200 dark:border-slate-700">

                            <div>

                                <h3 class="font-semibold text-gray-900 dark:text-white">
                                    {{ $user->name }}
                                </h3>

                                <div class="flex items-center gap-2 mt-1">

                                    <span class="text-xs text-indigo-600 dark:text-indigo-400 font-medium">
                                        #USR-{{ $user->id }}
                                    </span>

                                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>

                                    <span class="text-sm text-gray-500 dark:text-slate-400">
                                        {{ $user->email }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </td>

                    <td class="px-6 py-5">
                        @if($user->role == 'Admin')
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-purple-100 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400 text-xs font-semibold">
                            <i class="ri-shield-star-line"></i> Admin
                        </span>
                        @else
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-xs font-semibold">
                            <i class="ri-user-line"></i> Customer
                        </span>
                        @endif
                    </td>

                    <td class="px-6 py-5">

                        @if($user->status == 'Active')
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Active
                        </span>

                        @elseif($user->status == 'Pending')
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pending
                        </span>

                        @else
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span> Blocked
                        </span>
                        @endif

                    </td>

                    <td class="px-6 py-5 font-semibold text-gray-900 dark:text-white">
                        {{ $user->orders ?? 0 }}
                    </td>

                    <td class="px-6 py-5 font-semibold text-emerald-600 dark:text-emerald-400">
                        ${{ $user->spent ?? 0 }}
                    </td>

                    <td class="px-6 py-5 text-sm text-gray-500 dark:text-slate-400">
                        {{ $user->created_at->diffForHumans() }}
                    </td>

                    <td class="px-6 py-5">
                        <div class="flex items-center justify-center gap-2">

                            <button class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-indigo-100 dark:bg-slate-800">
                                <i class="ri-eye-line"></i>
                            </button>

                            <button class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-100 dark:bg-slate-800">
                                <i class="ri-pencil-line"></i>
                            </button>

                            <button class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-red-100 dark:bg-slate-800">
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