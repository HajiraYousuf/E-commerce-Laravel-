<x-layouts.app>

    <div class="p-6">

        <h1 class="text-2xl font-bold text-slate-800 dark:text-white mb-6">
            Search Results
        </h1>

        {{-- PRODUCTS --}}
        @if($products->count())

            <div class="mb-8">

                <h2 class="text-lg font-semibold text-slate-700 dark:text-slate-200 mb-3">
                    Products
                </h2>

                <div class="space-y-2">

                    @foreach($products as $product)

                        <div class="p-4 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700">

                            {{ $product->name }}

                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- USERS --}}
        @if($users->count())

            <div class="mb-8">

                <h2 class="text-lg font-semibold text-slate-700 dark:text-slate-200 mb-3">
                    Users
                </h2>

                <div class="space-y-2">

                    @foreach($users as $user)

                        <div class="p-4 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700">

                            {{ $user->name }}

                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- ORDERS --}}
        @if($orders->count())

            <div class="mb-8">

                <h2 class="text-lg font-semibold text-slate-700 dark:text-slate-200 mb-3">
                    Orders
                </h2>

                <div class="space-y-2">

                    @foreach($orders as $order)

                        <div class="p-4 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700">

                            Order #{{ $order->id }}

                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- NO RESULTS --}}
        @if(
            $products->isEmpty() &&
            $users->isEmpty() &&
            $orders->isEmpty()
        )

            <div class="text-center py-20">

                <h2 class="text-3xl font-bold text-slate-800 dark:text-white">
                    No results found
                </h2>

                <p class="text-slate-500 mt-3">
                    No matches found for "{{ $query }}"
                </p>

            </div>

        @endif

    </div>

</x-layouts.app>