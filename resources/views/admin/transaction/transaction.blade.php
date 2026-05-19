<x-layouts.app>

<div class="space-y-6 lg:space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

        <!-- LEFT -->
        <div class="min-w-0">

            <h1 class="text-2xl sm:text-3xl font-bold
                       text-gray-900 dark:text-white">

                Transactions

            </h1>

            <p class="mt-1 text-sm sm:text-base
                      text-gray-500 dark:text-slate-400">

                Track all your sales and transactions

            </p>

        </div>



        <!-- RIGHT -->
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">

            <!-- SEARCH -->
            <div class="relative flex-1 lg:flex-none">

                <span class="absolute left-4 top-1/2 -translate-y-1/2
                             text-gray-400 dark:text-slate-500">

                    <i class="ri-search-line text-lg"></i>

                </span>

                <input
                    type="text"
                    placeholder="Search transactions..."
                    class="w-full lg:w-72

                           bg-white dark:bg-[#0F172A]

                           border border-gray-200 dark:border-slate-800

                           rounded-2xl

                           pl-12 pr-4 py-3

                           text-sm text-gray-900 dark:text-white

                           placeholder:text-gray-400
                           dark:placeholder:text-slate-500

                           outline-none

                           focus:ring-4
                           focus:ring-indigo-500/10
                           focus:border-indigo-500

                           transition"
                >

            </div>



            <!-- FILTER -->
            <button
                class="h-12 px-5

                       flex items-center justify-center gap-2

                       rounded-2xl

                       bg-white dark:bg-[#0F172A]

                       border border-gray-200 dark:border-slate-800

                       text-gray-700 dark:text-slate-300

                       hover:bg-gray-50
                       dark:hover:bg-slate-800/80

                       transition">

                <i class="ri-filter-3-line text-lg"></i>

                <span class="font-medium">
                    Filter
                </span>

            </button>



            <!-- EXPORT -->
            <button
                class="h-12 px-6

                       flex items-center justify-center gap-2

                       rounded-2xl

                       bg-indigo-600 hover:bg-indigo-700

                       text-white font-semibold

                       shadow-lg shadow-indigo-500/20

                       transition">

                <i class="ri-download-2-line text-lg"></i>

                <span>
                    Export Report
                </span>

            </button>

        </div>

    </div>



    <!-- STATS -->
    <x-admin.transaction.stats-card />



    <!-- TABLE -->
    <x-admin.transaction.index />

</div>



{{-- REMIX ICON --}}
<link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"
/>

</x-layouts.app>