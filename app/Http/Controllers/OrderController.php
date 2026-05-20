<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'orderItems')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('orderItems.product');
        return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Order $order)
{
    $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];

    $currentIndex = array_search($order->status, $statuses);

    // haddii uusan jirin → 0 ka bilow
    if ($currentIndex === false) {
        $nextStatus = 'Pending';
    } else {
        $nextIndex = ($currentIndex + 1) % count($statuses);
        $nextStatus = $statuses[$nextIndex];
    }

    $order->update([
        'status' => $nextStatus
    ]);

    return back()->with('success', 'Status updated to ' . $nextStatus);
}
}