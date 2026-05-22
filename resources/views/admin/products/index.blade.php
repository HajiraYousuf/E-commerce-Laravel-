@php
    $highlight = request('highlight');
@endphp

<x-layouts.app>

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

        <a href="{{ route('products.create') }}"
           class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition flex items-center gap-2 w-fit">

            <i class="ri-add-line"></i>
            Add Product

        </a>

    </div>

    {{-- FILTERS --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-4">

        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            {{-- LEFT --}}
            <div class="flex flex-wrap items-center gap-3">

                <select class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-700 dark:text-slate-200">
                    <option>All Categories</option>
                    <option>Electronics</option>
                    <option>Fashion</option>
                    <option>Accessories</option>
                </select>

                <select class="h-11 min-w-[170px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-700 dark:text-slate-200">
                    <option>All Status</option>
                    <option>Active</option>
                    <option>Low Stock</option>
                    <option>Out of Stock</option>
                </select>

            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-3">

                <input
                    type="text"
                    placeholder="Search products..."
                    class="h-11 w-full sm:w-[280px] rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-700 dark:text-white"
                >

                <button class="h-11 px-5 rounded-2xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm text-gray-700 dark:text-slate-200">
                    Export
                </button>

            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1000px]">

                <thead class="bg-gray-50 dark:bg-slate-950">

                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">
                            Product
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">
                            Category
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">
                            Price
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">
                            Stock
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">
                            Sales
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">
                            Actions
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-slate-800">

                @forelse($products as $product)

                @php
                    $status = 'Active';

                    if ($product->stock == 0) {
                        $status = 'Out of Stock';
                    } elseif ($product->stock < 10) {
                        $status = 'Low Stock';
                    }
                @endphp

                <tr id="item-{{ $product->id }}"
                    class="transition
                    hover:bg-gray-50 dark:hover:bg-slate-800/40
                    {{ (string)$highlight === (string)$product->id
                        ? 'bg-yellow-100/60 dark:bg-yellow-900/30 ring-2 ring-yellow-400 dark:ring-yellow-600'
                        : '' }}">

                    {{-- PRODUCT --}}
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">

                            <img
                                src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/100' }}"
                                class="w-14 h-14 rounded-xl object-cover border border-gray-200 dark:border-slate-700"
                            >

                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-slate-400">
                                    SKU: {{ $product->sku }}
                                </p>
                            </div>

                        </div>
                    </td>

                    {{-- CATEGORY --}}
                    <td class="px-6 py-5 text-gray-700 dark:text-slate-300">
                        {{ $product->category->name }}
                    </td>

                    {{-- PRICE --}}
                    <td class="px-6 py-5 font-semibold text-gray-900 dark:text-white">
                        ${{ number_format($product->price, 2) }}
                    </td>

                    {{-- STOCK --}}
                    <td class="px-6 py-5 text-gray-700 dark:text-slate-300">
                        {{ $product->stock }} items
                    </td>

                    {{-- SALES --}}
                    <td class="px-6 py-5 text-gray-700 dark:text-slate-300">
                        {{ $product->sales ?? 0 }}
                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-5">
                        @if($status == 'Active')
                            <span class="px-3 py-1 rounded-xl bg-green-100 text-green-700 dark:bg-green-500/10 dark:text-green-400">
                                Active
                            </span>

                        @elseif($status == 'Low Stock')
                            <span class="px-3 py-1 rounded-xl bg-yellow-100 text-yellow-700 dark:bg-yellow-500/10 dark:text-yellow-400">
                                Low Stock
                            </span>

                        @else
                            <span class="px-3 py-1 rounded-xl bg-red-100 text-red-700 dark:bg-red-500/10 dark:text-red-400">
                                Out of Stock
                            </span>
                        @endif
                    </td>

                    {{-- ACTIONS --}}
                    <td class="px-6 py-5 text-center">
                        <a href="{{ route('products.show', $product->id) }}"
                           class="text-indigo-600 hover:underline">
                            View
                        </a>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="text-center py-10 text-gray-500 dark:text-slate-400">
                        No products found
                    </td>
                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-layouts.app>