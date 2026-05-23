<x-layouts.app>

@php



$stats = [

    [
        'id' => 'total_products',
        'title' => 'Total Products',
        'value' => $totalProducts,
        'subtitle' => 'All products',
        'color' => 'indigo',
        'icon' => 'ri-box-3-line',
    ],

    [
        'id' => 'in_stock',
        'title' => 'In Stock',
        'value' => $inStock,
        'subtitle' => 'Available products',
        'color' => 'emerald',
        'icon' => 'ri-checkbox-circle-line',
    ],

    [
        'id' => 'low_stock',
        'title' => 'Low Stock',
        'value' => $lowStock,
        'subtitle' => 'Running low',
        'color' => 'orange',
        'icon' => 'ri-error-warning-line',
    ],

    [
        'id' => 'out_stock',
        'title' => 'Out of Stock',
        'value' => $outStock,
        'subtitle' => 'Unavailable',
        'color' => 'rose',
        'icon' => 'ri-close-circle-line',
    ]

];

$colors = [

    'indigo'  => 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-500/10 border-indigo-200 dark:border-indigo-500/20',

    'emerald' => 'text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 border-emerald-200 dark:border-emerald-500/20',

    'orange'  => 'text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-500/10 border-orange-200 dark:border-orange-500/20',

    'rose'    => 'text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 border-rose-200 dark:border-rose-500/20',

];

$statusColors = [

    'In Stock' =>
        'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-200 dark:border-emerald-500/20',

    'Low Stock' =>
        'bg-amber-500/10 text-amber-600 dark:text-amber-300 border-amber-200 dark:border-amber-500/20',

    'Out of Stock' =>
        'bg-red-500/10 text-red-600 dark:text-red-400 border-red-200 dark:border-red-500/20',

];

@endphp

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-5">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Inventory
            </h1>

            <p class="text-gray-500 dark:text-gray-400">
                Manage your products and stock
            </p>
        </div>

        <!-- ACTIONS -->
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">

            <!-- SEARCH -->
            <form method="GET">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search products..."
                       class="w-full sm:w-72 px-5 py-3 rounded-xl
                              bg-white dark:bg-[#0B1220]
                              border border-gray-200 dark:border-[#1E293B]
                              text-gray-900 dark:text-white
                              placeholder-gray-400 dark:placeholder-gray-500
                              focus:outline-none focus:ring-2 focus:ring-indigo-500">

            </form>

            <!-- ADD -->
            <a href="{{ route('products.create') }}"
               class="px-6 py-3 rounded-xl
                      bg-indigo-600 hover:bg-indigo-700
                      text-white font-semibold
                      shadow-sm hover:shadow-md
                      transition text-center">

                + Add Product

            </a>

        </div>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        @foreach($stats as $stat)

        <div class="relative bg-white dark:bg-[#0B1220]
                    border border-gray-200 dark:border-[#1E293B]
                    rounded-2xl p-5 shadow-sm hover:shadow-xl
                    transition hover:-translate-y-1">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ $stat['title'] }}
                    </p>

                    <h2 class="text-3xl font-bold mt-2 text-gray-900 dark:text-white">
                        {{ $stat['value'] }}
                    </h2>

                    <p class="text-xs mt-1 text-gray-500 dark:text-gray-500">
                        {{ $stat['subtitle'] }}
                    </p>

                </div>

                <div class="w-12 h-12 flex items-center justify-center rounded-xl
                            border {{ $colors[$stat['color']] }}">

                    <i class="{{ $stat['icon'] }} text-2xl
                              text-gray-700 dark:text-white"></i>

                </div>

            </div>


        </div>

        @endforeach

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-2xl border border-gray-200 dark:border-[#1E293B]
                bg-white dark:bg-[#0B1220]">

        <table class="w-full min-w-[900px] text-left">

            <!-- HEADER -->
            <thead class="bg-gray-50 dark:bg-[#111827]
                           text-gray-500 dark:text-gray-400 text-xs uppercase">

                <tr>
                    <th class="px-6 py-4">Product</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">SKU</th>
                    <th class="px-6 py-4">Stock</th>
                    <th class="px-6 py-4">Price</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>

            </thead>

            <!-- BODY -->
            <tbody class="divide-y divide-gray-100 dark:divide-[#1E293B]">

                @forelse($products as $product)

                <tr class="hover:bg-gray-50 dark:hover:bg-[#111827] transition">

                    <!-- PRODUCT -->
                    <td class="px-6 py-4">

                        <div class="flex items-center gap-4">

                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="w-12 h-12 rounded-xl object-cover border border-gray-200 dark:border-[#1E293B]">

                            <div>

                                <h3 class="font-semibold text-gray-900 dark:text-white">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $product->description }}
                                </p>

                            </div>

                        </div>

                    </td>

                    <!-- CATEGORY -->
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                        {{ $product->category->name ?? 'No Category' }}                    </td>

                    <!-- SKU -->
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                        {{ $product->sku }}
                    </td>

                    <!-- STOCK -->
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                        {{ $product->stock }}
                    </td>

                    <!-- PRICE -->
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                        ${{ number_format($product->price, 2) }}
                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-4">

                        @php

                        $status =
                            $product->stock == 0
                            ? 'Out of Stock'
                            : ($product->stock <= 10
                                ? 'Low Stock'
                                : 'In Stock');

                        @endphp

                        <span class="px-3 py-1 text-xs font-medium rounded-full border inline-flex items-center
                            {{ $statusColors[$status] }}">

                            {{ $status }}

                        </span>

                    </td>

                    <!-- ACTIONS -->
                    <td class="px-6 py-4">

                        <div class="flex items-center justify-end gap-2">

                            <!-- EDIT -->
                            <a href="{{ route('products.edit', $product->id) }}"
                               class="p-2 rounded-lg
                                      bg-indigo-500/10 text-indigo-600
                                      hover:bg-indigo-600 hover:text-white
                                      hover:shadow-lg hover:scale-105
                                      transition duration-200">

                                <i class="ri-edit-2-line text-lg"></i>

                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('products.destroy', $product->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="p-2 rounded-lg
                                               bg-red-500/10 text-red-600
                                               hover:bg-red-600 hover:text-white
                                               hover:shadow-lg hover:scale-105
                                               transition duration-200">

                                    <i class="ri-delete-bin-6-line text-lg"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">

                        No products found

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-layouts.app>