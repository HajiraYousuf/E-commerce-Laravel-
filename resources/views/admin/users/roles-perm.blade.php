<x-layouts.app>
    @php

$roles = [

[
'name'=>'Admin',
'users'=>4,
'icon'=>'ri-shield-star-line',
'color'=>'indigo',
'active'=>true,
],

[
'name'=>'Editor',
'users'=>8,
'icon'=>'ri-edit-box-line',
'color'=>'emerald',
'active'=>false,
],

[
'name'=>'Manager',
'users'=>3,
'icon'=>'ri-briefcase-line',
'color'=>'amber',
'active'=>false,
],

[
'name'=>'Support',
'users'=>6,
'icon'=>'ri-customer-service-2-line',
'color'=>'blue',
'active'=>false,
],

];

$permissions = [

[
'module'=>'Dashboard',
'view'=>true,
'create'=>false,
'edit'=>false,
'delete'=>false,
],

[
'module'=>'Products',
'view'=>true,
'create'=>true,
'edit'=>true,
'delete'=>true,
],

[
'module'=>'Orders',
'view'=>true,
'create'=>true,
'edit'=>true,
'delete'=>false,
],

[
'module'=>'Customers',
'view'=>true,
'create'=>false,
'edit'=>true,
'delete'=>false,
],

[
'module'=>'Analytics',
'view'=>true,
'create'=>false,
'edit'=>false,
'delete'=>false,
],

[
'module'=>'Settings',
'view'=>true,
'create'=>true,
'edit'=>true,
'delete'=>false,
],

];

@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Roles & Permissions
            </h1>

            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Manage user roles and access permissions
            </p>

        </div>

        <button class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition flex items-center gap-2">

            <i class="ri-add-line"></i>

            Add Role

        </button>

    </div>

    {{-- CONTENT --}}
    <div class="grid grid-cols-1 xl:grid-cols-[320px_1fr] gap-6">

        {{-- LEFT SIDEBAR --}}
        <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-4 h-fit">

            <div class="space-y-3">

                @foreach($roles as $role)

                <button class="w-full text-left rounded-2xl border transition p-4

                    {{ $role['active']
                    ? 'bg-indigo-50 dark:bg-indigo-500/10 border-indigo-200 dark:border-indigo-500/20'
                    : 'bg-gray-50 dark:bg-slate-800 border-gray-200 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-slate-700'
                    }}
                ">

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center

                                {{ $role['active']
                                ? 'bg-indigo-600 text-white'
                                : 'bg-white dark:bg-slate-900 text-gray-700 dark:text-slate-300'
                                }}
                            ">

                                <i class="{{ $role['icon'] }} text-xl"></i>

                            </div>

                            <div>

                                <h3 class="font-semibold text-gray-900 dark:text-white">
                                    {{ $role['name'] }}
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-slate-400">
                                    {{ $role['users'] }} users
                                </p>

                            </div>

                        </div>

                        @if($role['active'])

                        <div class="w-3 h-3 rounded-full bg-indigo-600"></div>

                        @endif

                    </div>

                </button>

                @endforeach

            </div>

        </div>

        {{-- RIGHT CONTENT --}}
        <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden">

            {{-- TOP --}}
            <div class="p-6 border-b border-gray-200 dark:border-slate-800">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                            Admin Permissions
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                            Configure access control for admin role
                        </p>

                    </div>

                    <button class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition flex items-center gap-2 w-fit">

                        <i class="ri-save-line"></i>

                        Save Changes

                    </button>

                </div>

            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[700px]">

                    <thead class="bg-gray-50 dark:bg-slate-950">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                                Module
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                                View
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                                Create
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                                Edit
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                                Delete
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-slate-800">

                        @foreach($permissions as $permission)

                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/40 transition">

                            <td class="px-6 py-5">

                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ $permission['module'] }}
                                </span>

                            </td>

                            @foreach(['view','create','edit','delete'] as $action)

                            <td class="px-6 py-5 text-center">

                                <label class="relative inline-flex items-center cursor-pointer">

                                    <input
                                        type="checkbox"
                                        class="sr-only peer"
                                        {{ $permission[$action] ? 'checked' : '' }}
                                    >

                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:bg-indigo-600 transition"></div>

                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition peer-checked:translate-x-5"></div>

                                </label>

                            </td>

                            @endforeach

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</x-layouts.app>