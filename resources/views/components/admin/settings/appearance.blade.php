{{-- resources/views/components/admin/settings/appearance.blade.php --}}

<div class="space-y-6">

    {{-- APPEARANCE SETTINGS --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

        <div class="mb-8">

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Appearance Settings
            </h2>

            <p class="text-gray-500 dark:text-slate-400 mt-1">
                Customize your dashboard appearance and experience
            </p>

        </div>



        {{-- THEME MODES --}}
        <div>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-5">
                Theme Mode
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                {{-- LIGHT --}}
                <label class="cursor-pointer">

                    <input type="radio" name="theme" class="peer hidden" checked>

                    <div class="border-2 border-indigo-500 bg-indigo-50 dark:bg-indigo-500/10 rounded-3xl p-4 transition">

                        <div class="h-36 rounded-2xl bg-white border border-gray-200 overflow-hidden mb-4">

                            <div class="h-10 bg-gray-100 border-b border-gray-200 flex items-center px-3 gap-2">

                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>

                            </div>

                            <div class="p-3 space-y-3">

                                <div class="h-4 rounded bg-gray-200 w-28"></div>

                                <div class="grid grid-cols-2 gap-2">

                                    <div class="h-14 rounded-xl bg-gray-100"></div>
                                    <div class="h-14 rounded-xl bg-gray-100"></div>

                                </div>

                            </div>

                        </div>

                        <div class="flex items-center justify-between">

                            <div>

                                <h4 class="font-semibold text-gray-900 dark:text-white">
                                    Light Mode
                                </h4>

                                <p class="text-sm text-gray-500 dark:text-slate-400">
                                    Clean bright interface
                                </p>

                            </div>

                            <div class="w-5 h-5 rounded-full border-4 border-indigo-600"></div>

                        </div>

                    </div>

                </label>



                {{-- DARK --}}
                <label class="cursor-pointer">

                    <input type="radio" name="theme" class="peer hidden">

                    <div class="border border-gray-200 dark:border-slate-700 rounded-3xl p-4 hover:border-indigo-500 transition">

                        <div class="h-36 rounded-2xl bg-slate-900 border border-slate-700 overflow-hidden mb-4">

                            <div class="h-10 bg-slate-800 border-b border-slate-700 flex items-center px-3 gap-2">

                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>

                            </div>

                            <div class="p-3 space-y-3">

                                <div class="h-4 rounded bg-slate-700 w-28"></div>

                                <div class="grid grid-cols-2 gap-2">

                                    <div class="h-14 rounded-xl bg-slate-800"></div>
                                    <div class="h-14 rounded-xl bg-slate-800"></div>

                                </div>

                            </div>

                        </div>

                        <div class="flex items-center justify-between">

                            <div>

                                <h4 class="font-semibold text-gray-900 dark:text-white">
                                    Dark Mode
                                </h4>

                                <p class="text-sm text-gray-500 dark:text-slate-400">
                                    Elegant dark interface
                                </p>

                            </div>

                            <div class="w-5 h-5 rounded-full border border-gray-300 dark:border-slate-600"></div>

                        </div>

                    </div>

                </label>



                {{-- SYSTEM --}}
                <label class="cursor-pointer">

                    <input type="radio" name="theme" class="peer hidden">

                    <div class="border border-gray-200 dark:border-slate-700 rounded-3xl p-4 hover:border-indigo-500 transition">

                        <div class="h-36 rounded-2xl overflow-hidden mb-4 flex">

                            <div class="w-1/2 bg-white border border-gray-200">

                                <div class="h-10 bg-gray-100 border-b border-gray-200"></div>

                            </div>

                            <div class="w-1/2 bg-slate-900 border border-slate-700">

                                <div class="h-10 bg-slate-800 border-b border-slate-700"></div>

                            </div>

                        </div>

                        <div class="flex items-center justify-between">

                            <div>

                                <h4 class="font-semibold text-gray-900 dark:text-white">
                                    System
                                </h4>

                                <p class="text-sm text-gray-500 dark:text-slate-400">
                                    Match device theme
                                </p>

                            </div>

                            <div class="w-5 h-5 rounded-full border border-gray-300 dark:border-slate-600"></div>

                        </div>

                    </div>

                </label>

            </div>

        </div>

    </div>
</div>