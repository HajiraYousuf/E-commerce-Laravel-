<x-layouts.app>

<div class="max-w-5xl mx-auto px-4 py-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                Create Category
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Add a new category to organize your products
            </p>
        </div>

    </div>

    <!-- Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 
                rounded-3xl shadow-lg p-6 md:p-10">

        <!-- FIXED ROUTE -->
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Name -->
                <div>
                    <label class="text-sm font-medium text-slate-600 dark:text-slate-300">
                        Category Name
                    </label>
                    <input type="text" name="name"
                           placeholder="e.g. Smartphones"
                           class="mt-2 w-full px-4 py-3 rounded-xl 
                                  bg-slate-50 dark:bg-slate-800
                                  border border-slate-200 dark:border-slate-700
                                  text-slate-900 dark:text-white
                                  focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <!-- Slug -->
                <div>
                    <label class="text-sm font-medium text-slate-600 dark:text-slate-300">
                        Slug
                    </label>
                    <input type="text" name="slug"
                           placeholder="auto-generated or optional"
                           class="mt-2 w-full px-4 py-3 rounded-xl 
                                  bg-slate-50 dark:bg-slate-800
                                  border border-slate-200 dark:border-slate-700
                                  text-slate-900 dark:text-white
                                  focus:ring-2 focus:ring-purple-500 outline-none transition">
                </div>

            </div>

            <!-- Description -->
            <div class="mt-6">
                <label class="text-sm font-medium text-slate-600 dark:text-slate-300">
                    Description
                </label>

                <textarea name="description" rows="5"
                          placeholder="Write category description..."
                          class="mt-2 w-full px-4 py-3 rounded-xl 
                                 bg-slate-50 dark:bg-slate-800
                                 border border-slate-200 dark:border-slate-700
                                 text-slate-900 dark:text-white
                                 focus:ring-2 focus:ring-indigo-500 outline-none transition"></textarea>
            </div>

            <!-- Upload -->
            <div class="mt-6">
                <label class="text-sm font-medium text-slate-600 dark:text-slate-300">
                    Category Image
                </label>

                <div class="mt-2 border-2 border-dashed border-slate-300 dark:border-slate-700 
                            rounded-2xl p-8 text-center hover:border-blue-500 transition">

                    <input type="file" name="image" id="imageUpload" class="hidden">

                    <label for="imageUpload" class="cursor-pointer">
                        <div class="text-slate-500 dark:text-slate-400">
                            <p class="font-medium">Drop or select file</p>
                            <p class="text-xs mt-1">PNG, JPG (max 2MB)</p>
                        </div>
                    </label>

                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-10 flex flex-col md:flex-row gap-3 md:justify-end">

                <!-- FIXED ROUTE -->
                <a href="{{ route('categories.index') }}"
                   class="px-6 py-3 rounded-xl bg-slate-100 dark:bg-slate-800 
                          text-slate-700 dark:text-white text-center
                          hover:scale-105 transition">
                    Cancel
                </a>

                <button type="submit"
                        class="px-6 py-3 rounded-xl 
                               bg-gradient-to-r from-blue-600 to-purple-600 
                               text-white font-medium shadow-lg
                               hover:scale-105 hover:shadow-xl transition-all">
                    Create Category
                </button>

            </div>

        </form>

    </div>

</div>

</x-layouts.app>