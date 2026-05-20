<x-layouts.app>

<div class="max-w-6xl mx-auto p-6 space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Category Details
            </h1>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                View category information and statistics
            </p>
        </div>

        <div class="flex items-center gap-3">

            <a href="{{ route('categories.edit',$category->id) }}"
               class="px-4 py-2 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white transition shadow">
                Edit Category
            </a>

            <a href="{{ route('categories.index') }}"
               class="px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700
               bg-white dark:bg-gray-900
               text-gray-700 dark:text-gray-200
               hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                Back
            </a>

        </div>

    </div>

    {{-- MAIN CARD --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- CATEGORY INFO --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow border border-gray-100 dark:border-gray-800 p-6">

                <div class="flex flex-col md:flex-row md:items-center gap-5">

                    {{-- IMAGE FIXED --}}
                    <div class="w-24 h-24 rounded-3xl overflow-hidden shadow-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center">

                        @if($category->image)
                            <img src="{{ asset('storage/'.$category->image) }}"
                                 class="w-full h-full object-cover">
                        @else
                            <span class="text-4xl font-bold text-indigo-600">
                                {{ strtoupper(substr($category->name,0,1)) }}
                            </span>
                        @endif

                    </div>

                    {{-- DETAILS --}}
                    <div class="flex-1">

                        <div class="flex items-center gap-3 flex-wrap">

                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $category->name }}
                            </h2>

                            <span class="px-3 py-1 text-xs rounded-full
                            bg-green-100 dark:bg-green-900/40
                            text-green-600 dark:text-green-400">
                                Active
                            </span>

                        </div>

                        <p class="mt-3 text-gray-500 dark:text-gray-400 leading-relaxed">
                            {{ $category->description ?? 'No description available for this category.' }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- CATEGORY DETAILS --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow border border-gray-100 dark:border-gray-800 p-6">

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                    Category Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="p-5 rounded-2xl bg-gray-50 dark:bg-gray-800">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Slug</p>
                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            {{ $category->slug }}
                        </h4>
                    </div>

                    <div class="p-5 rounded-2xl bg-gray-50 dark:bg-gray-800">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Products</p>
                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            {{ $category->products_count ?? 0 }} Products
                        </h4>
                    </div>

                    <div class="p-5 rounded-2xl bg-gray-50 dark:bg-gray-800">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Created At</p>
                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            {{ optional($category->created_at)->format('d M Y') }}
                        </h4>
                    </div>

                    <div class="p-5 rounded-2xl bg-gray-50 dark:bg-gray-800">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Last Updated</p>
                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            {{ optional($category->updated_at)->diffForHumans() }}
                        </h4>
                    </div>

                </div>

            </div>

        </div>

        {{-- RIGHT SIDEBAR --}}
        <div class="space-y-6">

            {{-- QUICK STATS --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow border border-gray-100 dark:border-gray-800 p-6">

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-5">
                    Quick Stats
                </h3>

                <div class="space-y-4">

                    <div class="flex items-center justify-between p-4 rounded-2xl bg-indigo-50 dark:bg-indigo-900/20">

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Products</p>
                            <h4 class="text-xl font-bold text-gray-900 dark:text-white">
                                {{ $category->products_count ?? 0 }}
                            </h4>
                        </div>

                        <div class="w-12 h-12 rounded-xl bg-indigo-500 flex items-center justify-center text-white">
                            📦
                        </div>

                    </div>

                    <div class="flex items-center justify-between p-4 rounded-2xl bg-green-50 dark:bg-green-900/20">

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                            <h4 class="text-xl font-bold text-green-600">Active</h4>
                        </div>

                        <div class="w-12 h-12 rounded-xl bg-green-500 flex items-center justify-center text-white">
                            ✔
                        </div>

                    </div>

                </div>

            </div>

            {{-- DELETE --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow border border-red-100 dark:border-red-900 p-6">

                <h3 class="text-lg font-semibold text-red-600 mb-3">
                    Danger Zone
                </h3>

                <p class="text-sm text-gray-500 dark:text-gray-400 mb-5">
                    Once you delete this category, there is no going back.
                </p>

                <form action="{{ route('categories.destroy',$category->id) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this category?')">

                    @csrf
                    @method('DELETE')

                    <button class="w-full py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-medium transition">
                        Delete Category
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</x-layouts.app>