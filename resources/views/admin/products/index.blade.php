<x-layouts.app>

@php

$products = [

[
'image'=>'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=400',
'name'=>'Nike Air Max',
'sku'=>'PRD-1001',
'category'=>'Fashion',
'price'=>'$120',
'stock'=>42,
'status'=>'Active',
'sales'=>184,
],

[
'image'=>'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=400',
'name'=>'iPhone 15 Pro',
'sku'=>'PRD-1002',
'category'=>'Electronics',
'price'=>'$999',
'stock'=>12,
'status'=>'Low Stock',
'sales'=>94,
],

[
'image'=>'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=400',
'name'=>'Wireless Headphones',
'sku'=>'PRD-1003',
'category'=>'Electronics',
'price'=>'$85',
'stock'=>0,
'status'=>'Out of Stock',
'sales'=>211,
],

[
'image'=>'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=400',
'name'=>'Smart Watch',
'sku'=>'PRD-1004',
'category'=>'Accessories',
'price'=>'$220',
'stock'=>18,
'status'=>'Active',
'sales'=>73,
],

];

@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Product List
            </h1>

            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Manage all store products
            </p>

        </div>

        <button class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition flex items-center gap-2 w-fit">

            <i class="ri-add-line"></i>

            Add Product

        </button>

    </div>

    {{-- FILTERS --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-4">

        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            {{-- LEFT --}}
            <div class="flex flex-wrap items-center gap-3">

                {{-- CATEGORY --}}
                <div class="relative">

                    <select class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm font-medium text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">

                        <option>All Categories</option>
                        <option>Electronics</option>
                        <option>Fashion</option>
                        <option>Accessories</option>

                    </select>

                    <i class="ri-arrow-down-s-line absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                </div>

                {{-- STATUS --}}
                <div class="relative">

                    <select class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 pr-10 text-sm font-medium text-gray-700 dark:text-slate-200 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">

                        <option>All Status</option>
                        <option>Active</option>
                        <option>Low Stock</option>
                        <option>Out of Stock</option>

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
                        placeholder="Search products..."
                        class="h-11 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 pl-10 pr-4 text-sm text-gray-700 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                </div>

                {{-- EXPORT --}}
                <button class="h-11 px-5 rounded-2xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 text-sm font-medium text-gray-700 dark:text-slate-200 transition flex items-center gap-2 whitespace-nowrap">

                    <i class="ri-download-2-line"></i>

                    Export

                </button>

            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1200px]">

                <thead class="bg-gray-50 dark:bg-slate-950">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Product
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Category
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Price
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Stock
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-slate-400">
                            Sales
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

                    @foreach($products as $product)

                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/40 transition">

                        {{-- PRODUCT --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <img
                                    src="{{ $product['image'] }}"
                                    class="w-16 h-16 rounded-2xl object-cover border border-gray-200 dark:border-slate-700"
                                >

                                <div>

                                    <h3 class="font-semibold text-gray-900 dark:text-white">
                                        {{ $product['name'] }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                                        SKU: {{ $product['sku'] }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        {{-- CATEGORY --}}
                        <td class="px-6 py-5">

                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl bg-indigo-100 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 text-xs font-semibold">
                                {{ $product['category'] }}
                            </span>

                        </td>

                        {{-- PRICE --}}
                        <td class="px-6 py-5">

                            <span class="font-semibold text-gray-900 dark:text-white">
                                {{ $product['price'] }}
                            </span>

                        </td>

                        {{-- STOCK --}}
                        <td class="px-6 py-5">

                            <span class="text-sm font-medium text-gray-700 dark:text-slate-300">
                                {{ $product['stock'] }} items
                            </span>

                        </td>

                        {{-- SALES --}}
                        <td class="px-6 py-5">

                            <span class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                                {{ $product['sales'] }} sold
                            </span>

                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if($product['status'] == 'Active')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Active
                            </span>

                            @elseif($product['status'] == 'Low Stock')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Low Stock
                            </span>

                            @else

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 text-xs font-semibold">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                Out of Stock
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