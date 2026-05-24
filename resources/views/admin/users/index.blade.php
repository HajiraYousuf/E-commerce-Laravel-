@php
    $highlight = request('highlight');
@endphp

<x-layouts.app>

<div class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200 dark:border-slate-800 overflow-hidden">

    <div class="p-6 border-b border-gray-200 dark:border-slate-800">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            All Users
        </h2>
        <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
            Dynamic data from database
        </p>
    </div>

    <div class="overflow-x-auto">

        <table class="w-full min-w-[1000px]">

            <thead class="bg-gray-50 dark:bg-slate-950">
                <tr class="text-left">
                    <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">User</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Role</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Orders</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Total Spent</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500 dark:text-slate-400">Joined</th>
                    {{-- <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500 dark:text-slate-400 text-center">Actions</th> --}}
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-slate-800">

                @foreach($users as $user)

                <tr
                    id="item-{{ $user->id }}"
                    class="transition hover:bg-gray-50 dark:hover:bg-slate-800/40
                    {{ (string)$highlight === (string)$user->id ? 'bg-yellow-200 dark:bg-yellow-700' : '' }}"
                >

                    {{-- USER --}}
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">

                            <img src="{{ $user->avatar ?? 'https://i.pravatar.cc/100' }}"
                                class="w-12 h-12 rounded-2xl object-cover border border-gray-200 dark:border-slate-700">

                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">
                                    {{ $user->name }}
                                </h3>

                                <div class="text-sm text-gray-500 dark:text-slate-400">
                                    {{ $user->email }}
                                </div>
                            </div>

                        </div>
                    </td>

                    {{-- ROLE --}}
                    <td class="px-6 py-5">
                        @if($user->role == 'Admin')
                            <span class="px-3 py-1 rounded-xl bg-purple-100 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400 text-xs">
                                Admin
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-xl bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-xs">
                                Customer
                            </span>
                        @endif
                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-5">
                        @if($user->status == 'Active')
                            <span class="px-3 py-1 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-xs">
                                Active
                            </span>
                        @elseif($user->status == 'Pending')
                            <span class="px-3 py-1 rounded-xl bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 text-xs">
                                Pending
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-xl bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 text-xs">
                                Blocked
                            </span>
                        @endif
                    </td>

                    {{-- ORDERS --}}
                    <td class="px-6 py-5 font-semibold text-gray-900 dark:text-white">
                        {{ $user->orders->count() ?? 0 }}
                    </td>

                    {{-- SPENT --}}
                    <td class="px-6 py-5 font-semibold text-emerald-600 dark:text-emerald-400">
                        ${{ $user->orders->sum('total') }}                    </td>

                    {{-- JOINED --}}
                    <td class="px-6 py-5 text-sm text-gray-500 dark:text-slate-400">
                        {{ $user->created_at->diffForHumans() }}
                    </td>

                    {{-- ACTIONS --}}
                    {{-- <td class="px-6 py-5 text-center">
                        <a href="/admin/users{{ $user->id }}"
                           class="px-3 py-1 text-sm rounded-xl bg-indigo-600 text-white hover:bg-indigo-700">
                            View
                        </a>
                    </td> --}}

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</x-layouts.app>