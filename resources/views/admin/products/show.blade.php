<x-layouts.app>

<div class="max-w-6xl mx-auto space-y-8">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white">
                Product Details
            </h1>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Full overview of product information and performance
            </p>
        </div>

        <div class="flex items-center gap-3">

    {{-- CANCEL --}}
    <a href="{{ route('products.index') }}"
       class="inline-flex items-center gap-2 px-5 h-11 rounded-2xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 hover:bg-gray-50 dark:hover:bg-slate-800 text-gray-700 dark:text-slate-300 font-medium transition">

        <i class="ri-arrow-left-line"></i>

        Cancel

    </a>

    {{-- EDIT --}}
    <a href="{{ route('products.edit', $product->id) }}"
       class="inline-flex items-center gap-2 px-5 h-11 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-medium shadow-sm transition">

        <i class="ri-pencil-line"></i>

        Edit

    </a>

    {{-- DELETE --}}
    <form action="{{ route('products.destroy', $product->id) }}"
          method="POST"
          onsubmit="return confirm('Are you sure you want to delete this product?')">

        @csrf
        @method('DELETE')

        <button type="submit"
            class="inline-flex items-center gap-2 px-5 h-11 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-medium shadow-sm transition">

            <i class="ri-delete-bin-6-line"></i>

            Delete

        </button>

    </form>

</div>
    </div>

    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- IMAGE CARD --}}
        <div class="lg:col-span-1 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-5 shadow-sm hover:shadow-md transition">

            <div class="overflow-hidden rounded-2xl">
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="w-full h-80 object-cover hover:scale-105 transition duration-300">
            </div>

        </div>

        {{-- INFO CARD --}}
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-6">

            {{-- TITLE --}}
            <div class="space-y-2">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $product->name }}
                </h2>

                <p class="text-gray-600 dark:text-slate-400 leading-relaxed">
                    {{ $product->description }}
                </p>
            </div>

            {{-- BADGES --}}
            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 text-xs rounded-full bg-gray-100 dark:bg-slate-800 text-gray-700 dark:text-slate-300">
                    SKU: {{ $product->sku }}
                </span>

                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300">
                    {{ $product->category->name }}
                </span>
            </div>

            {{-- STATS GRID --}}
            <div class="grid grid-cols-2 md:grid-cols-2 gap-4 pt-4">

                <div class="p-4 rounded-2xl bg-gray-50 dark:bg-slate-800">
                    <p class="text-xs text-gray-500">Price</p>
                    <p class="text-xl font-bold text-gray-900 dark:text-white">
                        ${{ $product->price }}
                    </p>
                </div>

                <div class="p-4 rounded-2xl bg-gray-50 dark:bg-slate-800">
                    <p class="text-xs text-gray-500">Stock</p>
                    <p class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $product->stock }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</div>

</x-layouts.app>