<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Notifications\NewOrderNotification;
use App\Models\User;
use App\Models\Order;
use App\Notifications\OrderNotification;

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
public function store(Request $request)
{
    $request->validate([
        'total' => 'required',
    ]);

    // create order
    $order = Order::create([
        'user_id' => auth()->id(),
        'total' => $request->total,
        'status' => 'Pending',
    ]);

    // send notification to admins
    $admins = User::where('role', 'admin')->get();

    foreach ($admins as $admin) {

        $admin->notify(new OrderNotification($order));

    }

    return back()->with('success', 'Order created successfully');
}
}