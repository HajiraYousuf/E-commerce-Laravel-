@extends('components.user.layouts.app')

@section('content')

<!-- HERO -->
<section class="bg-gradient-to-r from-indigo-700 via-blue-700 to-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl font-extrabold">My Orders 📦</h1>
        <p class="text-gray-200 mt-3">Track your purchases and order status</p>
    </div>
</section>

<!-- ORDERS -->
<section class="py-20 bg-gray-50 dark:bg-black min-h-screen">

    <div class="max-w-7xl mx-auto px-6">

        @forelse($orders as $order)

        <div
            class="mb-8 bg-white dark:bg-gray-900 rounded-3xl shadow hover:shadow-2xl transition overflow-hidden">

            <!-- TOP -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h2 class="text-xl font-bold">
                        Order #{{ $order->id }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Placed on {{ $order->created_at->format('d M Y') }}
                    </p>
                </div>

                <div class="flex items-center gap-3">

                    <span
                        class="px-4 py-2 rounded-full text-xs font-bold
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-600
                        @elseif($order->status == 'shipped') bg-blue-100 text-blue-600
                        @elseif($order->status == 'Delivered') bg-green-100 text-green-600
                        @else bg-red-100 text-red-600 @endif">

                        {{ $order->status }}

                    </span>

                    <span class="text-blue-600 font-bold">
                        ${{ number_format($order->total, 2) }}
                    </span>

                </div>

            </div>

            <!-- BODY -->
            <div class="p-6 grid md:grid-cols-3 gap-6">

                <!-- ITEMS -->
                <div class="md:col-span-2 space-y-4">

@foreach($order->orderItems ?? [] as $item)
                    <div class="flex items-center gap-4">

                        <img src="{{ asset('storage/'.$item->product->image) }}"
                            class="w-16 h-16 rounded-2xl object-cover">

                        <div class="flex-1">

                            <h3 class="font-semibold">
                                {{ $item->product->name }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                Qty: {{ $item->quantity }}
                            </p>

                        </div>

                        <span class="font-bold text-blue-600">
                            ${{ $item->price * $item->quantity }}
                        </span>

                    </div>

                    @endforeach

                </div>

                <!-- SUMMARY -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-6">

                    <h3 class="font-bold text-lg mb-4">Order Summary</h3>

                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-300">

                        <div class="flex justify-between">
                            <span>Items</span>
                            <span>{{ $order->orderItems?->count() ?? 0 }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Total</span>
                            <span class="font-bold text-blue-600">
                                ${{ number_format($order->total, 2) }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span>Status</span>
                            <span>{{ ucfirst($order->status) }}</span>
                        </div>

                    </div>

                    <a href="{{ url()->previous() }}"
                    class="mt-6 block text-center bg-gray-800 hover:bg-gray-900 text-white py-3 rounded-2xl transition">
                        Back
                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="text-center py-20 text-gray-500">
            You have no orders yet 📦
        </div>

        @endforelse

    </div>

</section>

@endsection