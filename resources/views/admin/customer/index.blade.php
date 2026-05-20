<x-layouts.app>

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

        <button class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium flex items-center gap-2 transition">
            <i class="ri-user-add-line"></i>
            Add Customer
        </button>

    </div>

    {{-- FILTERS --}}
    <form method="GET"
        class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-4">

        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            {{-- LEFT --}}
            <div class="flex flex-wrap items-center gap-3">

                <select name="status"
                    class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 
                    bg-gray-50 dark:bg-slate-800 text-gray-700 dark:text-slate-200 px-4 outline-none focus:ring-2 focus:ring-indigo-500">

                    <option>All Status</option>
                    <option value="Active" @selected(request('status')=='Active')>Active</option>
                    <option value="Blocked" @selected(request('status')=='Blocked')>Blocked</option>

                </select>

                <select name="sort"
                    class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 
                    bg-gray-50 dark:bg-slate-800 text-gray-700 dark:text-slate-200 px-4 outline-none focus:ring-2 focus:ring-indigo-500">

                    <option>Sort By</option>
                    <option value="Newest" @selected(request('sort')=='Newest')>Newest</option>
                    <option value="Oldest" @selected(request('sort')=='Oldest')>Oldest</option>
                    <option value="Top Spent" @selected(request('sort')=='Top Spent')>Top Spent</option>

                </select>

            </div>

            {{-- SEARCH --}}
            <div class="relative w-full sm:w-[280px]">

                <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search customers..."
                    class="h-11 w-full rounded-2xl border border-gray-200 dark:border-slate-700 
                    bg-gray-50 dark:bg-slate-800 pl-10 pr-4 text-gray-700 dark:text-white 
                    outline-none focus:ring-2 focus:ring-indigo-500">

            </div>

        </div>

    </form>

    {{-- TABLE --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1100px]">

                {{-- HEAD --}}
                <thead class="bg-gray-50 dark:bg-slate-950">
                    <tr class="text-left text-xs uppercase text-gray-500 dark:text-slate-400">

                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Phone</th>
                        <th class="px-6 py-4">Country</th>
                        <th class="px-6 py-4">Orders</th>
                        <th class="px-6 py-4">Spent</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Joined</th>
                        <th class="px-6 py-4 text-center">Actions</th>

                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody class="divide-y divide-gray-200 dark:divide-slate-800">

                    @forelse($customers as $c)

                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/40 transition">

                        {{-- CUSTOMER --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">

                                <img src="{{ $c->avatar }}"
                                    class="w-12 h-12 rounded-2xl object-cover border border-gray-200 dark:border-slate-700">

                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">
                                        {{ $c->name }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-slate-400">
                                        {{ $c->email }} • {{ $c->customer_id }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <td class="px-6 py-5 text-gray-700 dark:text-slate-300">
                            {{ $c->phone }}
                        </td>

                        <td class="px-6 py-5 text-gray-700 dark:text-slate-300">
                            {{ $c->country }}
                        </td>

                        <td class="px-6 py-5 text-gray-900 dark:text-white font-medium">
                            {{ $c->orders }}
                        </td>

                        <td class="px-6 py-5 text-emerald-600 dark:text-emerald-400 font-semibold">
                            ${{ number_format($c->spent, 2) }}
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if($c->status == 'Active')
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl 
                                bg-emerald-100 dark:bg-emerald-500/10 
                                text-emerald-700 dark:text-emerald-400 text-xs font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl 
                                bg-red-100 dark:bg-red-500/10 
                                text-red-700 dark:text-red-400 text-xs font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    Blocked
                                </span>
                            @endif

                        </td>

                        <td class="px-6 py-5 text-gray-500 dark:text-slate-400 text-sm">
                            {{ $c->created_at->diffForHumans() }}
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center gap-2">

                                <button class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-slate-800 
                                hover:bg-indigo-100 dark:hover:bg-indigo-500/10 transition">
                                    <i class="ri-eye-line text-gray-600 dark:text-slate-300"></i>
                                </button>

                                <button class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-slate-800 
                                hover:bg-blue-100 dark:hover:bg-blue-500/10 transition">
                                    <i class="ri-pencil-line text-gray-600 dark:text-slate-300"></i>
                                </button>

                                <button class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-slate-800 
                                hover:bg-red-100 dark:hover:bg-red-500/10 transition">
                                    <i class="ri-delete-bin-6-line text-gray-600 dark:text-slate-300"></i>
                                </button>

                            </div>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center p-10 text-gray-500 dark:text-slate-400">
                            No customers found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- PAGINATION --}}
    <div class="dark:text-white">
        {{ $customers->links() }}
    </div>

</div>

</x-layouts.app>