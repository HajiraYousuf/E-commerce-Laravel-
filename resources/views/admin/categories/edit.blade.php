<x-layouts.app>

<div class="max-w-5xl mx-auto px-4 py-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                Edit Category
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Update category information
            </p>
        </div>

        <a href="{{ route('categories') }}"
           class="px-5 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 
                  text-slate-700 dark:text-white hover:scale-105 transition">
            Back
        </a>

    </div>

    <!-- Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 
                rounded-3xl shadow-lg p-6 md:p-10">

        <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Name -->
                <div>
                    <label class="text-sm font-medium text-slate-600 dark:text-slate-300">
                        Category Name
                    </label>

                    <input type="text" name="name"
                           value="{{ $category->name }}"
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
                           value="{{ $category->slug }}"
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
                          class="mt-2 w-full px-4 py-3 rounded-xl 
                                 bg-slate-50 dark:bg-slate-800
                                 border border-slate-200 dark:border-slate-700
                                 text-slate-900 dark:text-white
                                 focus:ring-2 focus:ring-indigo-500 outline-none transition">{{ $category->description }}</textarea>
            </div>

            <!-- Image -->
            <div class="mt-6">
                <label class="text-sm font-medium text-slate-600 dark:text-slate-300">
                    Category Image
                </label>

                <div class="mt-2 border-2 border-dashed border-slate-300 dark:border-slate-700 
                            rounded-2xl p-8 text-center hover:border-blue-500 transition">

                    <input type="file" name="image" id="imageUpload" class="hidden">

                    <label for="imageUpload" class="cursor-pointer">
                        <p class="text-slate-500 dark:text-slate-400">
                            Replace or upload new image
                        </p>
                    </label>

                </div>

                @if($category->image)
                    <img src="{{ asset('storage/'.$category->image) }}"
                         class="mt-4 w-24 h-24 rounded-xl object-cover">
                @endif

            </div>

            <!-- Buttons -->
            <div class="mt-10 flex flex-col md:flex-row gap-3 md:justify-end">

                <a href="{{ route('categories') }}"
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
                    Update Category
                </button>

            </div>

        </form>

    </div>

</div>

</x-layouts.app>