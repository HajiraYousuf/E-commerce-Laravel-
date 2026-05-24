<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Notifications\NewOrderNotification;
use App\Models\User;
use App\Models\Order;
use App\Notifications\OrderNotification;

class OrderController extends Controller
{
    public function index(Request $request)
{
    $orders = Order::with(['user', 'orderItems'])

        // ================= SEARCH =================
        ->when($request->search, function ($query) use ($request) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");

            });

        })

        // ================= STATUS FILTER =================
        ->when($request->status, function ($query) use ($request) {

            $query->whereRaw(
                'LOWER(status) = ?',
                [strtolower($request->status)]
            );

        })


        // ================= ORDER =================
        ->latest()

        // ================= PAGINATION =================
        ->paginate(10)

        ->withQueryString();

    return view('admin.orders.index', compact('orders'));
}
public function export()
{
    $orders = Order::with(['user', 'orderItems.product'])
        ->latest()
        ->get();

    $fileName = 'orders-report-' . now()->format('Y-m-d-H-i-s') . '.csv';

    return response()->streamDownload(function () use ($orders) {

        $handle = fopen('php://output', 'w');

        // HEADER
        fputcsv($handle, [
            'Order ID',
            'Customer Name',
            'Email',
            'Products',
            'Total',
            'Status',
            'Payment Method',
            'Date',
        ]);

        foreach ($orders as $order) {

            $products = $order->orderItems->map(function ($item) {
                return $item->product->name ?? 'N/A';
            })->implode(', ');

            fputcsv($handle, [
                $order->id,
                $order->user->name ?? 'Unknown',
                $order->user->email ?? '-',
                $products,
                $order->total,
                $order->status,
                $order->payment_method,
                $order->created_at->format('M d, Y h:i A'),
            ]);
        }

        fclose($handle);

    }, $fileName, [
        'Content-Type' => 'text/csv',
    ]);
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