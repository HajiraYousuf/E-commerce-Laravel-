<x-layouts.rider>

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold tracking-tight">My Deliveries 🚚</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-2">
            Assigned orders waiting for delivery
        </p>
    </div>

    <!-- SUCCESS -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-green-100 text-green-700 dark:bg-green-500/10 dark:text-green-400 border border-green-400/30">
            {{ session('success') }}
        </div>
    @endif

    <!-- LIST -->
    <div class="grid gap-5">

        @forelse($orders as $order)

            <div class="rounded-3xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-[#111827] shadow-sm hover:shadow-lg transition p-6">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <!-- LEFT -->
                    <div class="space-y-2">

                        <h2 class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                            #ORD-{{ $order->id }}
                        </h2>

                        <p><span class="text-gray-500">Customer:</span> {{ $order->customer_name }}</p>
                        <p><span class="text-gray-500">Phone:</span> {{ $order->phone }}</p>
                        <p><span class="text-gray-500">Address:</span> {{ $order->address }}</p>

                        <p class="text-2xl font-bold text-green-600 dark:text-green-400 pt-2">
                            ${{ $order->total }}
                        </p>

                    </div>

                    <!-- RIGHT -->
                    <div class="flex items-center gap-3">

                        @if($order->status === 'shipped')

                            <form action="{{ route('rider.delivered', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <button
                                    class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition shadow-md">
                                    Mark Delivered
                                </button>
                            </form>

                            <span class="px-4 py-2 rounded-full text-xs bg-yellow-100 text-yellow-700 dark:bg-yellow-500/10 dark:text-yellow-400">
                                In Transit
                            </span>

                        @else

                            <span class="px-5 py-3 rounded-2xl bg-green-100 text-green-700 dark:bg-green-500/10 dark:text-green-400 font-semibold">
                                Delivered ✅
                            </span>

                        @endif

                    </div>

                </div>
            </div>

        @empty

            <div class="text-center p-10 rounded-3xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-[#111827]">
                <h2 class="text-2xl font-bold">No Deliveries Found</h2>
                <p class="text-gray-500 mt-2">You don’t have any assigned orders yet</p>
            </div>

        @endforelse

    </div>

</x-layouts.rider>