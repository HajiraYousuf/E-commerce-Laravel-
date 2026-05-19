{{-- resources/views/components/admin/settings/security.blade.php --}}

<div class="space-y-6">

    {{-- PASSWORD --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

        <div class="mb-8">

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Security Settings
            </h2>

            <p class="text-gray-500 dark:text-slate-400 mt-1">
                Manage your password and account security
            </p>

        </div>



        <form class="space-y-6">

            {{-- CURRENT PASSWORD --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    Current Password
                </label>

                <div class="relative">

                    <input
                        type="password"
                        placeholder="Enter current password"
                        class="w-full h-12 pl-4 pr-12 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                    <button
                        type="button"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-slate-300">

                        <i class="ri-eye-line text-lg"></i>

                    </button>

                </div>

            </div>



            {{-- NEW PASSWORD --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    New Password
                </label>

                <div class="relative">

                    <input
                        type="password"
                        placeholder="Enter new password"
                        class="w-full h-12 pl-4 pr-12 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                    <button
                        type="button"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-slate-300">

                        <i class="ri-eye-line text-lg"></i>

                    </button>

                </div>

            </div>



            {{-- CONFIRM PASSWORD --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-300">
                    Confirm Password
                </label>

                <div class="relative">

                    <input
                        type="password"
                        placeholder="Confirm new password"
                        class="w-full h-12 pl-4 pr-12 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                    <button
                        type="button"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-slate-300">

                        <i class="ri-eye-line text-lg"></i>

                    </button>

                </div>

            </div>



            {{-- PASSWORD STRENGTH --}}
            <div>

                <div class="flex items-center justify-between mb-2">

                    <span class="text-sm font-medium text-gray-700 dark:text-slate-300">
                        Password Strength
                    </span>

                    <span class="text-sm font-semibold text-emerald-600">
                        Strong
                    </span>

                </div>

                <div class="w-full h-2 rounded-full bg-gray-200 dark:bg-slate-700 overflow-hidden">

                    <div class="w-[85%] h-full bg-emerald-500 rounded-full"></div>

                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">

                    <div class="flex items-center gap-2 text-sm text-emerald-600">
                        <i class="ri-check-line"></i>
                        8+ Characters
                    </div>

                    <div class="flex items-center gap-2 text-sm text-emerald-600">
                        <i class="ri-check-line"></i>
                        Uppercase
                    </div>

                    <div class="flex items-center gap-2 text-sm text-emerald-600">
                        <i class="ri-check-line"></i>
                        Number
                    </div>

                    <div class="flex items-center gap-2 text-sm text-emerald-600">
                        <i class="ri-check-line"></i>
                        Symbol
                    </div>

                </div>

            </div>



            {{-- BUTTON --}}
            <div class="flex justify-end pt-2">

                <button
                    type="submit"
                    class="px-8 h-12 rounded-2xl bg-indigo-600 hover:bg-indigo-700 transition text-white font-medium shadow-lg shadow-indigo-500/20">

                    Update Password

                </button>

            </div>

        </form>

    </div>


    {{-- <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

        <div class="flex items-start justify-between gap-5">

            <div>

                <div class="flex items-center gap-3 mb-2">

                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">

                        <i class="ri-shield-keyhole-line text-xl"></i>

                    </div>

                    <div>

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                            Two-Factor Authentication
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-slate-400">
                            Add extra protection to your account
                        </p>

                    </div>

                </div>

            </div>



            <label class="relative inline-flex cursor-pointer items-center">

                <input type="checkbox" class="peer sr-only">

                <div class="peer h-7 w-12 rounded-full bg-gray-300 dark:bg-slate-700 after:absolute after:left-1 after:top-1 after:h-5 after:w-5 after:rounded-full after:bg-white after:transition-all peer-checked:bg-indigo-600 peer-checked:after:translate-x-5"></div>

            </label>

        </div>



        <div class="mt-8">

            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">
                Trusted Devices
            </h4>

            <div class="space-y-4">

                <div class="flex items-center justify-between p-4 rounded-2xl border border-gray-200 dark:border-slate-700">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-gray-600 dark:text-slate-300">

                            <i class="ri-macbook-line text-xl"></i>

                        </div>

                        <div>

                            <h5 class="font-semibold text-gray-900 dark:text-white">
                                MacBook Pro
                            </h5>

                            <p class="text-sm text-gray-500 dark:text-slate-400">
                                Chrome • New York, USA
                            </p>

                        </div>

                    </div>

                    <span class="text-sm font-medium text-emerald-600">
                        Current Device
                    </span>

                </div>



                <div class="flex items-center justify-between p-4 rounded-2xl border border-gray-200 dark:border-slate-700">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-gray-600 dark:text-slate-300">

                            <i class="ri-smartphone-line text-xl"></i>

                        </div>

                        <div>

                            <h5 class="font-semibold text-gray-900 dark:text-white">
                                iPhone 15 Pro
                            </h5>

                            <p class="text-sm text-gray-500 dark:text-slate-400">
                                Safari • California, USA
                            </p>

                        </div>

                    </div>

                    <button
                        class="text-red-500 hover:text-red-600 text-sm font-medium">

                        Remove

                    </button>

                </div>

            </div>

        </div>

    </div>



    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Recent Login Activity
                </h3>

                <p class="text-gray-500 dark:text-slate-400 text-sm mt-1">
                    Monitor your recent account activity
                </p>

            </div>

            <button
                class="h-11 px-5 rounded-2xl border border-gray-200 dark:border-slate-700 text-gray-700 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-800 transition">

                View All

            </button>

        </div>



        <div class="space-y-4">

            <div class="flex items-center justify-between p-4 rounded-2xl bg-gray-50 dark:bg-slate-800">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-600 flex items-center justify-center">

                        <i class="ri-check-line text-xl"></i>

                    </div>

                    <div>

                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            Successful Login
                        </h4>

                        <p class="text-sm text-gray-500 dark:text-slate-400">
                            Chrome on Windows • 2 mins ago
                        </p>

                    </div>

                </div>

                <span class="text-sm text-gray-500 dark:text-slate-400">
                    Hargeisa, Somalia
                </span>

            </div>



            <div class="flex items-center justify-between p-4 rounded-2xl bg-gray-50 dark:bg-slate-800">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-red-100 dark:bg-red-500/10 text-red-600 flex items-center justify-center">

                        <i class="ri-close-line text-xl"></i>

                    </div>

                    <div>

                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            Failed Login Attempt
                        </h4>

                        <p class="text-sm text-gray-500 dark:text-slate-400">
                            Firefox on Linux • 1 hour ago
                        </p>

                    </div>

                </div>

                <span class="text-sm text-gray-500 dark:text-slate-400">
                    London, UK
                </span>

            </div>

        </div>

    </div> --}}

</div>