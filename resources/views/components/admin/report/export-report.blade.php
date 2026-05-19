<div class="bg-white dark:bg-[#0F172A] border border-gray-200 dark:border-white/10 rounded-2xl p-5 transition-colors duration-300">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        {{-- LEFT --}}
        <div>
            <h2 class="text-gray-900 dark:text-white text-lg font-semibold">
                Export Reports
            </h2>

            <p class="text-gray-500 dark:text-gray-400 text-sm">
                Download your reports in different formats
            </p>
        </div>

        {{-- RIGHT --}}
        <div class="flex flex-wrap gap-3">

            {{-- PDF --}}
            <button class="bg-gray-100 dark:bg-[#111827] hover:bg-red-500/20 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-2 flex items-center gap-2 transition group hover:scale-105">

                <div class="w-8 h-8 rounded-md bg-red-500/20 text-red-500 dark:text-red-400 flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition">
                    <i class="ri-file-pdf-line"></i>
                </div>

                <span class="text-gray-900 dark:text-white text-sm">
                    Download PDF
                </span>

            </button>

            {{-- EXCEL --}}
            <button class="bg-gray-100 dark:bg-[#111827] hover:bg-green-500/20 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-2 flex items-center gap-2 transition group hover:scale-105">

                <div class="w-8 h-8 rounded-md bg-green-500/20 text-green-500 dark:text-green-400 flex items-center justify-center group-hover:bg-green-500 group-hover:text-white transition">
                    <i class="ri-file-excel-2-line"></i>
                </div>

                <span class="text-gray-900 dark:text-white text-sm">
                    Export Excel
                </span>

            </button>

            {{-- PRINT --}}
            <button class="bg-gray-100 dark:bg-[#111827] hover:bg-blue-500/20 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-2 flex items-center gap-2 transition group hover:scale-105">

                <div class="w-8 h-8 rounded-md bg-blue-500/20 text-blue-500 dark:text-blue-400 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition">
                    <i class="ri-printer-line"></i>
                </div>

                <span class="text-gray-900 dark:text-white text-sm">
                    Print Report
                </span>

            </button>

        </div>

    </div>

</div>