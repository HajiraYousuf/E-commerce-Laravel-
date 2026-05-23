@extends('components.user.layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-8">
{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- ERROR MESSAGE --}}
@if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- ================= CART ================= --}}
        <div class="bg-white dark:bg-gray-900 dark:text-white shadow rounded-xl p-5">

            <h2 class="text-2xl font-bold mb-4">🛒 Your Cart</h2>

            @forelse($cartItems as $item)
                <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 py-3">

                    <div>
                        <h4 class="font-semibold">
                            {{ optional($item->product)->name }}
                        </h4>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            ${{ optional($item->product)->price }} × {{ $item->quantity }}
                        </p>
                    </div>

                    <div class="font-bold">
                        ${{ optional($item->product)->price * $item->quantity }}
                    </div>

                </div>
            @empty
                <p class="text-gray-500">Cart is empty</p>
            @endforelse

        </div>

        {{-- ================= CHECKOUT ================= --}}
        <div class="bg-white dark:bg-gray-900 dark:text-white shadow rounded-xl p-5">

            <h2 class="text-2xl font-bold mb-4">Checkout</h2>

            <form action="{{ route('place.order') }}" method="POST">
                @csrf

                {{-- NAME --}}
                <div class="mb-3">
                    <label class="block mb-1">Name</label>
                    <input type="text" name="name"
                        class="w-full border dark:border-gray-700 dark:bg-gray-800 p-2 rounded"
                        required>
                </div>

                {{-- PHONE --}}
                <div class="mb-3">
                    <label class="block mb-1">Phone</label>
                    <input type="text" name="phone"
                        class="w-full border dark:border-gray-700 dark:bg-gray-800 p-2 rounded"
                        required>
                </div>

                {{-- ADDRESS --}}
                <div class="mb-3">
                    <label class="block mb-1">Address</label>
                    <textarea name="address"
                        class="w-full border dark:border-gray-700 dark:bg-gray-800 p-2 rounded"
                        required></textarea>
                </div>

                {{-- PAYMENT --}}
                <div class="mb-4">
                    <label class="block mb-1">Payment Method</label>

                    <select name="payment_method" id="payment_method"
                        class="w-full border dark:border-gray-700 dark:bg-gray-800 p-2 rounded"
                        required>

                        <option value="">Select payment</option>
                        <option value="cash">Cash</option>
                        <option value="credit">Credit</option>
                        <option value="other">Other</option>

                    </select>
                </div>

                {{-- ================= ORDER SUMMARY ================= --}}
                <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded mb-5">

                    <div class="flex justify-between">
                        <span>Subtotal:</span>
                        <span id="subtotal">${{ $subtotal }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Shipping:</span>
                        <span id="shipping">${{ $shipping }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Tax (5%):</span>
                        <span id="tax">${{ number_format($tax, 2) }}</span>
                    </div>

                    <hr class="my-2 border-gray-300 dark:border-gray-600">

                    <div class="flex justify-between font-bold">
                        <span>Total:</span>
                        <span id="total">${{ number_format($total, 2) }}</span>
                    </div>
                </div>

                {{-- BUTTON --}}
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg transition">
                    Place Order
                </button>

            </form>
        </div>
    </div>
</div>

{{-- ================= LIVE UPDATE SCRIPT ================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const payment = document.getElementById('payment_method');

    payment.addEventListener('change', function () {

        let subtotal = {{ $subtotal }};
        let tax = subtotal * 0.05;

        let shipping = 0;

        if (this.value === 'cash') {
            shipping = 5;
        }

        let total = subtotal + shipping + tax;

        document.getElementById('shipping').innerText = "$" + shipping;
        document.getElementById('tax').innerText = "$" + tax.toFixed(2);
        document.getElementById('total').innerText = "$" + total.toFixed(2);
    });

});
</script>

@endsection