<x-layouts.app>
<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-5">

        <!-- TITLE -->
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
            <input type="text"
                   placeholder="Search products..."
                   class="w-full sm:w-72 px-5 py-3 rounded-xl
                          bg-white dark:bg-[#0B1220]
                          border border-gray-200 dark:border-[#1E293B]
                          text-gray-900 dark:text-white
                          placeholder-gray-400 dark:placeholder-gray-500
                          focus:outline-none focus:ring-2 focus:ring-indigo-500">

            <!-- FILTER -->
            <button class="px-5 py-3 rounded-xl
                           bg-white dark:bg-[#0B1220]
                           border border-gray-200 dark:border-[#1E293B]
                           text-gray-800 dark:text-gray-200
                           hover:bg-gray-50 dark:hover:bg-[#111827]
                           transition">

                Filter
            </button>

            <!-- ADD -->
            <button class="px-6 py-3 rounded-xl
                           bg-indigo-600 hover:bg-indigo-700
                           text-white font-semibold
                           shadow-sm hover:shadow-md
                           transition">

                + Add Product
            </button>

        </div>

    </div>

    <!-- COMPONENTS -->
    <x-admin.inventory.stats-card />
    <x-admin.inventory.index />

</div>
</x-layouts.app>