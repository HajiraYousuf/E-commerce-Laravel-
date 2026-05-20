<x-layouts.app>

<div class="max-w-7xl mx-auto p-4 md:p-6 space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>
            <div class="flex items-center gap-3">

                <a href="{{ route('orders.index') }}"
                   class="w-10 h-10 rounded-2xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex items-center justify-center text-gray-700 dark:text-white hover:scale-105 transition">
                    <i class="ri-arrow-left-line text-lg"></i>
                </a>

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">
                        Order #ORD-{{ $order->id }}
                    </h1>

                    <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                        {{ $order->created_at->format('M d, Y • h:i A') }}
                    </p>
                </div>

            </div>
        </div>

        {{-- UPDATE STATUS --}}
        <form method="POST" action="{{ route('orders.updateStatus', $order) }}">
    @csrf

    <div class="flex gap-3 items-center">

        <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl">
            Update
        </button>

    </div>

</form>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div
            class="bg-emerald-100 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-2xl text-sm font-medium">

            {{ session('success') }}

        </div>

    @endif

    {{-- GRID --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- LEFT SIDE --}}
        <div class="xl:col-span-2 space-y-6">

            {{-- ORDER ITEMS --}}
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden">

                <div class="p-6 border-b border-gray-100 dark:border-slate-800">

                    <div class="flex items-center justify-between">

                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                Order Items
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $order->orderItems->count() }} Products
                            </p>
                        </div>

                        <div
                            class="w-12 h-12 rounded-2xl bg-indigo-100 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400">

                            <i class="ri-shopping-bag-3-line text-xl"></i>

                        </div>

                    </div>

                </div>

                <div class="divide-y divide-gray-100 dark:divide-slate-800">

                    @foreach($order->orderItems as $item)

                        <div class="p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center">

                                    <i class="ri-shopping-bag-line text-2xl text-gray-500"></i>

                                </div>

                                <div>

                                    <h3 class="font-semibold text-gray-900 dark:text-white">
                                        {{ $item->product->name ?? 'Product Deleted' }}
                                    </h3>

                                    <div class="flex items-center gap-3 mt-1">

                                        <p class="text-sm text-gray-500">
                                            Qty: {{ $item->quantity }}
                                        </p>

                                        <span class="text-gray-300 dark:text-slate-700">
                                            •
                                        </span>

                                        <p class="text-sm text-gray-500">
                                            ${{ number_format($item->price, 2) }} each
                                        </p>

                                    </div>

                                </div>

                            </div>

                            <div class="text-right">

                                <p class="text-lg font-bold text-emerald-600">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

            {{-- ORDER SUMMARY --}}
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

                <div class="flex items-center justify-between mb-6">

                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Order Summary
                    </h2>

                    <div
                        class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400">

                        <i class="ri-wallet-3-line text-xl"></i>

                    </div>

                </div>

                <div class="space-y-4">

                    <div class="flex items-center justify-between text-sm">

                        <span class="text-gray-500">
                            Subtotal
                        </span>

                        <span class="font-semibold text-gray-900 dark:text-white">
                            ${{ number_format($order->total, 2) }}
                        </span>

                    </div>

                    <div class="flex items-center justify-between text-sm">

                        <span class="text-gray-500">
                            Shipping
                        </span>

                        <span class="font-semibold text-gray-900 dark:text-white">
                            $0.00
                        </span>

                    </div>

                    <div class="border-t border-gray-100 dark:border-slate-800 pt-4 flex items-center justify-between">

                        <span class="text-lg font-bold text-gray-900 dark:text-white">
                            Total
                        </span>

                        <span class="text-2xl font-bold text-emerald-600">
                            ${{ number_format($order->total, 2) }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="space-y-6">

            {{-- CUSTOMER --}}
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

                <div class="flex items-center justify-between mb-5">

                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Customer
                    </h2>

                    <div
                        class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400">

                        <i class="ri-user-3-line text-xl"></i>

                    </div>

                </div>

                <div class="flex items-center gap-4">

                    <img
                        src="https://i.pravatar.cc/150?u={{ $order->user_id }}"
                        class="w-16 h-16 rounded-2xl object-cover border border-gray-200 dark:border-slate-700">

                    <div>

                        <h3 class="font-bold text-gray-900 dark:text-white">
                            {{ $order->user->name ?? 'Unknown User' }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $order->user->email ?? 'No Email' }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- STATUS --}}
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

                <div class="flex items-center justify-between mb-5">

                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Order Status
                    </h2>

                    <div
                        class="w-12 h-12 rounded-2xl bg-orange-100 dark:bg-orange-500/10 flex items-center justify-center text-orange-600 dark:text-orange-400">

                        <i class="ri-loader-4-line text-xl"></i>

                    </div>

                </div>

                @if($order->status == 'Pending')

                    <span
                        class="inline-flex px-4 py-2 rounded-2xl bg-yellow-100 dark:bg-yellow-500/10 text-yellow-700 dark:text-yellow-400 text-sm font-semibold">
                        Pending
                    </span>

                @elseif($order->status == 'Processing')

                    <span
                        class="inline-flex px-4 py-2 rounded-2xl bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-sm font-semibold">
                        Processing
                    </span>

                @elseif($order->status == 'Shipped')

                    <span
                        class="inline-flex px-4 py-2 rounded-2xl bg-indigo-100 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 text-sm font-semibold">
                        Shipped
                    </span>

                @elseif($order->status == 'Delivered')

                    <span
                        class="inline-flex px-4 py-2 rounded-2xl bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 text-sm font-semibold">
                        Delivered
                    </span>

                @else

                    <span
                        class="inline-flex px-4 py-2 rounded-2xl bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 text-sm font-semibold">
                        Cancelled
                    </span>

                @endif

            </div>

            {{-- PAYMENT --}}
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6">

                <div class="flex items-center justify-between mb-5">

                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Payment
                    </h2>

                    <div
                        class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400">

                        <i class="ri-bank-card-line text-xl"></i>

                    </div>

                </div>

                <div class="space-y-4">

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Payment Method
                        </p>

                        <h3 class="font-semibold text-gray-900 dark:text-white">
                            {{ $order->payment_method ?? 'Cash On Delivery' }}
                        </h3>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Payment Status
                        </p>

                        <h3 class="font-semibold text-emerald-600">
                            {{ $order->payment_status ?? 'Pending' }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-layouts.app>