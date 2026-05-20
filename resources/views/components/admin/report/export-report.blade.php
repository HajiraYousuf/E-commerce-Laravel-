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

            {{-- EXPORT ALL --}}
<a href="{{ route('reports.export.all') }}"
   class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl px-5 py-2 flex items-center gap-2 transition hover:scale-105">

    <div class="w-8 h-8 rounded-md bg-white/20 flex items-center justify-center">
        <i class="ri-download-cloud-2-line"></i>
    </div>

    <span class="text-sm font-medium">
        Export All Reports
    </span>

</a>
        </div>

    </div>

</div>