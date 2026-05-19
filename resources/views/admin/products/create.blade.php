<x-layouts.app>

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Create Product
            </h1>

            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Add a new product to your store
            </p>

        </div>

        <div class="flex items-center gap-3">

            <button class="h-11 px-5 rounded-2xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 text-sm font-medium text-gray-700 dark:text-slate-200 transition">
                Cancel
            </button>

            <button class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition flex items-center gap-2">

                <i class="ri-save-line"></i>

                Save Product

            </button>

        </div>

    </div>

    {{-- CONTENT --}}
    <div class="grid grid-cols-1 gap-6">

        {{-- BASIC INFO --}}
        <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-11 h-11 rounded-2xl bg-indigo-100 dark:bg-indigo-500/10 flex items-center justify-center">

                    <i class="ri-shopping-bag-3-line text-xl text-indigo-600 dark:text-indigo-400"></i>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                        Basic Information
                    </h2>

                    <p class="text-sm text-gray-500 dark:text-slate-400">
                        Product details and information
                    </p>

                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- PRODUCT NAME --}}
                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        Product Name
                    </label>

                    <input
                        type="text"
                        placeholder="Enter product name"
                        class="h-12 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                </div>

                {{-- SKU --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        SKU
                    </label>

                    <input
                        type="text"
                        placeholder="PRD-1001"
                        class="h-12 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                </div>

                {{-- CATEGORY --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        Category
                    </label>

                    <select class="h-12 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500">

                        <option>Select Category</option>
                        <option>Electronics</option>
                        <option>Fashion</option>
                        <option>Accessories</option>

                    </select>

                </div>

                {{-- PRICE --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        Price
                    </label>

                    <input
                        type="number"
                        placeholder="$0.00"
                        class="h-12 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                </div>

                {{-- STOCK --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        Stock Quantity
                    </label>

                    <input
                        type="number"
                        placeholder="0"
                        class="h-12 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                </div>

                {{-- DESCRIPTION --}}
                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        Description
                    </label>

                    <textarea
                        rows="6"
                        placeholder="Write product description..."
                        class="w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 p-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500 resize-none"
                    ></textarea>

                </div>

            </div>

        </div>

        {{-- PRODUCT IMAGES --}}
        <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-11 h-11 rounded-2xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center">

                    <i class="ri-image-2-line text-xl text-emerald-600 dark:text-emerald-400"></i>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                        Product Images
                    </h2>

                    <p class="text-sm text-gray-500 dark:text-slate-400">
                        Upload product photos
                    </p>

                </div>

            </div>

            <div class="border-2 border-dashed border-gray-300 dark:border-slate-700 rounded-3xl p-10 text-center bg-gray-50 dark:bg-slate-800/50">

                <div class="w-16 h-16 rounded-3xl bg-indigo-100 dark:bg-indigo-500/10 flex items-center justify-center mx-auto mb-4">

                    <i class="ri-upload-cloud-2-line text-3xl text-indigo-600 dark:text-indigo-400"></i>

                </div>

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Upload Product Images
                </h3>

                <p class="text-sm text-gray-500 dark:text-slate-400 mt-2">
                    Drag & drop files here or click to browse
                </p>

                <button class="mt-5 h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition">
                    Choose Files
                </button>

            </div>

        </div>

    </div>

</div>

</x-layouts.app>