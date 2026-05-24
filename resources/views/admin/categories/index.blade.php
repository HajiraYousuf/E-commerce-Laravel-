<x-layouts.app>

<div class="p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Categories
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                E-Commerce Categories
            </p>
        </div>

        <!-- FIXED ROUTE -->
        <a href="{{ route('categories.create') }}"
           class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 
                  hover:from-blue-700 hover:to-purple-700 text-white 
                  rounded-xl shadow transition duration-300">
            + Add Category
        </a>

    </div>

    <!-- Search -->
    <!-- Search -->
<form method="GET" action="{{ route('categories.index') }}" class="mb-6">

    <div class="flex gap-3">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by category name..."
            class="w-full md:w-1/3 px-4 py-2 border rounded-xl 
            bg-white dark:bg-gray-800 
            text-gray-700 dark:text-white
            border-gray-200 dark:border-gray-700
            focus:ring-2 focus:ring-indigo-500 outline-none">

        <button type="submit"
            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl">

            Search
        </button>

    </div>

</form>
    <!-- Table -->
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow overflow-hidden">

        <table class="w-full text-sm text-left">

            <!-- HEAD -->
            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3">Image</th>
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">Slug</th>
                    <th class="px-6 py-3">Products</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="text-gray-700 dark:text-gray-200">

                @forelse($categories as $category)

                <tr class="border-b border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                    <!-- IMAGE FIXED -->
                    <td class="px-6 py-4">
                        @if($category->image)
                            <img src="{{ asset('storage/'.$category->image) }}"
                                 class="w-10 h-10 rounded-lg object-cover">
                        @else
                            <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center">
                                <span class="text-indigo-600 font-bold">
                                    {{ strtoupper(substr($category->name,0,1)) }}
                                </span>
                            </div>
                        @endif
                    </td>

                    <!-- NAME -->
                    <td class="px-6 py-4 font-semibold">
                        {{ $category->name }}
                    </td>

                    <!-- DESCRIPTION -->
                    <td class="px-6 py-4 text-gray-500">
                        {{ $category->description ?? 'No description' }}
                    </td>

                    <!-- SLUG -->
                    <td class="px-6 py-4 text-gray-400">
                        {{ $category->slug }}
                    </td>

                    <!-- PRODUCTS -->
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-full">
                            {{ $category->products_count ?? 0 }}
                        </span>
                    </td>

                    <!-- ACTIONS -->
                    <td class="px-6 py-4 text-right">

                        <div class="flex justify-end gap-2">

                            <!-- VIEW FIXED -->
                            <a href="{{ route('categories.show', $category->id) }}"
                               class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition"
                               title="View">
                                👁
                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="p-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-600 rounded-lg transition"
                               title="Edit">
                                ✏️
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('categories.destroy', $category->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this category?')">

                                @csrf
                                @method('DELETE')

                                <button class="p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition"
                                        title="Delete">
                                    🗑
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">
                        No categories found
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>

</div>

</x-layouts.app>