{{-- TopSellingProductsTable.blade.php --}}

<div class="bg-white dark:bg-[#0F172A]/90 border border-gray-200 dark:border-white/10 rounded-2xl p-5">

    <div class="flex justify-between mb-5">
        <h2 class="text-gray-900 dark:text-white text-xl font-semibold">
            Top Selling Products
        </h2>

        <button class="text-blue-500 dark:text-blue-400 text-sm">
            View all →
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">

            <thead>
                <tr class="text-left text-gray-400 border-b border-gray-200 dark:border-white/10">
                    <th class="pb-3">#</th>
                    <th class="pb-3">Image</th>
                    <th class="pb-3">Product</th>
                    <th class="pb-3">Category</th>
                    <th class="pb-3">Sold</th>
                    <th class="pb-3">Revenue</th>
                    <th class="pb-3">Profit</th>
                </tr>
            </thead>

            <tbody>
                @foreach($topProducts as $i => $p)

                <tr class="border-b border-gray-100 dark:border-white/5 hover:bg-gray-50 dark:hover:bg-white/5">

                    <td class="py-3 text-gray-900 dark:text-white">
                        {{ $i + 1 }}
                    </td>

                    <td class="py-3">
                        <img src="{{ $p['image'] }}"
                             class="w-11 h-11 rounded-xl object-cover border border-gray-200 dark:border-white/10">
                    </td>

                    <td class="py-3">
                        <div>
                            <div class="text-gray-900 dark:text-white font-medium">
                                {{ $p['name'] }}
                            </div>
                            <div class="text-gray-400 text-xs">
                                Premium Product
                            </div>
                        </div>
                    </td>

                    <td class="py-3">
                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 text-gray-600 dark:text-gray-300">
                            {{ $p['category'] }}
                        </span>
                    </td>

                    <td class="py-3 text-gray-700 dark:text-gray-300">
                        {{ $p['sold'] }}
                    </td>

                    <td class="py-3 text-blue-500 dark:text-blue-400 font-medium">
                        {{ $p['revenue'] }}
                    </td>

                    <td class="py-3 text-green-600 dark:text-green-400 font-semibold">
                        {{ $p['profit'] }}
                    </td>

                </tr>

                @endforeach
            </tbody>

        </table>
    </div>

</div>