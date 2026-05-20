<x-layouts.app>

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Edit Product
            </h1>

            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Update product information
            </p>

        </div>

        <div class="flex items-center gap-3">

            <a href="{{ route('products.index') }}"
               class="h-11 px-5 flex items-center justify-center rounded-2xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 text-sm font-medium text-gray-700 dark:text-slate-200 transition">
                Cancel
            </a>

            <button type="submit"
                class="h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition flex items-center gap-2">

                <i class="ri-save-line"></i>
                Update Product

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

                {{-- NAME --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        Product Name
                    </label>

                    <input type="text" name="name"
                        value="{{ $product->name }}"
                        class="h-12 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                {{-- SKU --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        SKU
                    </label>

                    <input type="text" name="sku"
                        value="{{ $product->sku }}"
                        class="h-12 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                {{-- CATEGORY --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        Category
                    </label>

                    <select name="category"
                        class="h-12 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500">

                        <option value="">Select Category</option>

                        <option value="Electronics" {{ $product->category == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                        <option value="Fashion" {{ $product->category == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                        <option value="Accessories" {{ $product->category == 'Accessories' ? 'selected' : '' }}>Accessories</option>

                    </select>
                </div>

                {{-- PRICE --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        Price
                    </label>

                    <input type="number" step="0.01" name="price"
                        value="{{ $product->price }}"
                        class="h-12 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                {{-- STOCK --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        Stock Quantity
                    </label>

                    <input type="number" name="stock"
                        value="{{ $product->stock }}"
                        class="h-12 w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                {{-- DESCRIPTION --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                        Description
                    </label>

                    <textarea name="description" rows="6"
                        class="w-full rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 p-4 text-sm text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500 resize-none">{{ $product->description }}</textarea>
                </div>

            </div>

        </div>

        {{-- IMAGE --}}
        <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-11 h-11 rounded-2xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center">
                    <i class="ri-image-2-line text-xl text-emerald-600 dark:text-emerald-400"></i>
                </div>

                <div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                        Product Image
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-slate-400">
                        Update product photo
                    </p>
                </div>

            </div>

            {{-- CURRENT IMAGE --}}
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                    class="w-32 h-32 object-cover rounded-2xl mb-4 border">
            @endif

            <div onclick="document.getElementById('imageInput').click()"
                 class="cursor-pointer border-2 border-dashed border-gray-300 dark:border-slate-700 rounded-3xl p-10 text-center bg-gray-50 dark:bg-slate-800/50">

                <button type="button"
                    class="mt-2 h-11 px-5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition">
                    Change Image
                </button>

                <input type="file" name="image" id="imageInput" class="hidden">

            </div>

        </div>

    </div>

</div>

</form>

</x-layouts.app>