<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Product as ModelsProduct;
use App\Models\User;

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        $query = trim($request->q);

        if (!$query) {

            return response()->json([
                'products' => [],
                'orders'   => [],
                'users'    => [],
            ]);

        }

        $products = Product::query()
            ->where('name', 'LIKE', "%{$query}%")
            ->select('id', 'name', 'price', 'image')
            ->latest()
            ->limit(5)
            ->get();

        $orders = Order::query()
            ->where('id', 'LIKE', "%{$query}%")
            ->orWhere('status', 'LIKE', "%{$query}%")
            ->select('id', 'total', 'status', 'created_at')
            ->latest()
            ->limit(5)
            ->get();

        $users = User::query()
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->select('id', 'name', 'email')
            ->latest()
            ->limit(5)
            ->get();

        return response()->json([
            'products' => $products,
            'orders'   => $orders,
            'users'    => $users,
        ]);
    }
}