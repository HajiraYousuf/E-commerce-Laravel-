@php

$products = [
    [
        'image' => 'https://images.unsplash.com/photo-1517336714739-489689fd1ca8?w=200',
        'name' => 'MacBook Pro 16"',
        'type' => 'Laptop',
        'category' => 'Electronics',
        'sku' => 'MBP16-001',
        'stock' => 23,
        'price' => '$2,499.00',
        'status' => 'In Stock',
        'status_color' => 'green'
    ],
    [
        'image' => 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=200',
        'name' => 'iPhone 15 Pro',
        'type' => 'Smartphone',
        'category' => 'Electronics',
        'sku' => 'IP15P-001',
        'stock' => 8,
        'price' => '$999.00',
        'status' => 'Low Stock',
        'status_color' => 'yellow'
    ],
    [
        'image' => 'https://images.unsplash.com/photo-1588156979435-379b9d802b0a?w=200',
        'name' => 'AirPods Pro',
        'type' => 'Wireless Earbuds',
        'category' => 'Accessories',
        'sku' => 'APP-001',
        'stock' => 0,
        'price' => '$249.00',
        'status' => 'Out of Stock',
        'status_color' => 'red'
    ],
];

$statusColors = [
    'green' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-200 dark:border-emerald-500/20',
    'yellow' => 'bg-amber-500/10 text-amber-600 dark:text-amber-300 border-amber-200 dark:border-amber-500/20',
    'red' => 'bg-red-500/10 text-red-600 dark:text-red-400 border-red-200 dark:border-red-500/20',
];

@endphp


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

    @foreach($products as $product)

        <tr class="hover:bg-gray-50 dark:hover:bg-[#111827] transition">

            <!-- PRODUCT -->
            <td class="px-6 py-4">
                <div class="flex items-center gap-4">

                    <img src="{{ $product['image'] }}"
                         class="w-12 h-12 rounded-xl object-cover border border-gray-200 dark:border-[#1E293B]">

                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">
                            {{ $product['name'] }}
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $product['type'] }}
                        </p>
                    </div>

                </div>
            </td>

            <!-- CATEGORY -->
            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                {{ $product['category'] }}
            </td>

            <!-- SKU -->
            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                {{ $product['sku'] }}
            </td>

            <!-- STOCK -->
            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                {{ $product['stock'] }}
            </td>

            <!-- PRICE -->
            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                {{ $product['price'] }}
            </td>

            <!-- STATUS -->
            <td class="px-6 py-4">
                <span class="px-3 py-1 text-xs font-medium rounded-full border inline-flex items-center
                    {{ $statusColors[$product['status_color']] }}">
                    {{ $product['status'] }}
                </span>
            </td>

            <!-- ACTIONS (FIXED BUTTONS) -->
            <td class="px-6 py-4">
                <div class="flex items-center justify-end gap-2">

                    <!-- EDIT -->
                    <button class="p-2 rounded-lg
                                bg-indigo-500/10 text-indigo-600
                                hover:bg-indigo-600 hover:text-white
                                hover:shadow-lg hover:scale-105
                                transition duration-200">

                        <i class="ri-edit-2-line text-lg"></i>
                    </button>
                    <!-- DELETE -->
                    <button class="p-2 rounded-lg
                            bg-red-500/10 text-red-600
                            hover:bg-red-600 hover:text-white
                            hover:shadow-lg hover:scale-105
                            transition duration-200">

                    <i class="ri-delete-bin-6-line text-lg"></i>
                </button>
                </div>
            </td>

        </tr>

    @endforeach

    </tbody>

</table>

</div>