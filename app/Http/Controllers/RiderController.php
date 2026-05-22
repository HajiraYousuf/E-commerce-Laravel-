<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    public function index()
    {
        $orders = Order::where('delivery_user_id', auth()->id())
            ->whereIn('status', ['shipped', 'delivered'])
            ->latest()
            ->get();

        return view('rider.deliveries', compact('orders'));
    }

    public function delivered(Order $order)
    {
        if ($order->delivery_user_id != auth()->id()) {


        }

        if ($order->status !== 'shipped') {

            return back();

        }

        $order->update([

            'status' => 'Delivered',

            'delivered_at' => now(),

        ]);

        return back()->with('success', 'Order Delivered');
    }
}