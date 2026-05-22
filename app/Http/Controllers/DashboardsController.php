<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardsController extends Controller
{
    public function dashboard()
    {
        $now = Carbon::now();

        // =========================
        // REVENUE
        // =========================
        $thisMonthRevenue = OrderItem::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->sum(DB::raw('price * quantity'));

        $lastMonthRevenue = OrderItem::whereMonth('created_at', $now->copy()->subMonth()->month)
            ->whereYear('created_at', $now->copy()->subMonth()->year)
            ->sum(DB::raw('price * quantity'));

        $revenueChange = $lastMonthRevenue > 0
            ? (($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : ($thisMonthRevenue > 0 ? 100 : 0);

        // =========================
        // SOLD
        // =========================
        $thisMonthSold = OrderItem::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->sum('quantity');

        $lastMonthSold = OrderItem::whereMonth('created_at', $now->copy()->subMonth()->month)
            ->whereYear('created_at', $now->copy()->subMonth()->year)
            ->sum('quantity');

        $soldChange = $lastMonthSold > 0
            ? (($thisMonthSold - $lastMonthSold) / $lastMonthSold) * 100
            : ($thisMonthSold > 0 ? 100 : 0);

        // =========================
        // ORDERS
        // =========================
        $thisMonthOrders = Order::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $lastMonthOrders = Order::whereMonth('created_at', $now->copy()->subMonth()->month)
            ->whereYear('created_at', $now->copy()->subMonth()->year)
            ->count();

        $ordersChange = $lastMonthOrders > 0
            ? (($thisMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100
            : ($thisMonthOrders > 0 ? 100 : 0);

        // =========================
        // PRODUCTS (TOTAL + CHANGE)
        // =========================
        $productsCount = Product::count();

        $thisMonthProducts = Product::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $lastMonthProducts = Product::whereMonth('created_at', $now->copy()->subMonth()->month)
            ->whereYear('created_at', $now->copy()->subMonth()->year)
            ->count();

        $productsChange = $lastMonthProducts > 0
            ? (($thisMonthProducts - $lastMonthProducts) / $lastMonthProducts) * 100
            : ($thisMonthProducts > 0 ? 100 : 0);

        // =========================
        // STATS ARRAY (FULL DYNAMIC)
        // =========================
        $stats = [
            [
                "title" => "Total Revenue",
                "value" => "$" . number_format($thisMonthRevenue),
                "change" => number_format($revenueChange, 1) . "%",
                "trend" => $revenueChange >= 0 ? "up" : "down",
                "type" => "revenue",
                "color" => "emerald",
            ],
            [
                "title" => "Products Sold",
                "value" => $thisMonthSold,
                "change" => number_format($soldChange, 1) . "%",
                "trend" => $soldChange >= 0 ? "up" : "down",
                "type" => "orders",
                "color" => "blue",
            ],
            [
                "title" => "Total Orders",
                "value" => $thisMonthOrders,
                "change" => number_format($ordersChange, 1) . "%",
                "trend" => $ordersChange >= 0 ? "up" : "down",
                "type" => "orders",
                "color" => "purple",
            ],
            [
                "title" => "Total Products",
                "value" => $productsCount,
                "change" => number_format($productsChange, 1) . "%",
                "trend" => $productsChange >= 0 ? "up" : "down",
                "type" => "views",
                "color" => "orange",
            ],
        ];

        // =========================
        // RECENT ORDERS
        // =========================
        $recentOrders = Order::with('orderItems.product')
            ->latest()
            ->take(5)
            ->get();

        // =========================
        // TOP PRODUCTS
        // =========================
        $topProducts = Product::select(
                'products.id',
                'products.name',
                DB::raw('SUM(order_items.quantity) as sales'),
                DB::raw('SUM(order_items.quantity * order_items.price) as revenue')
            )
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('sales')
            ->take(5)
            ->get();

        // =========================
        // CATEGORY SALES
        // =========================
        $salesByCategory = Product::select(
                'category as name',
                DB::raw('COUNT(*) as value')
            )
            ->groupBy('category')
            ->get();

        // =========================
        // REVENUE CHART
        // =========================
        $revenueChart = OrderItem::select(
                DB::raw("CAST(strftime('%m', created_at) AS INTEGER) as month"),
                DB::raw('SUM(price * quantity) as revenue')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // =========================
        // ACTIVITIES
        // =========================
        $activities = Activity::latest()->take(10)->get();

        $revenueData = OrderItem::select(
        DB::raw("CAST(strftime('%m', created_at) AS INTEGER) as month"),
        DB::raw("SUM(price * quantity) as revenue")
    )
    ->groupBy('month')
    ->orderBy('month')
    ->get()
    ->map(function ($item) {

        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        ];

        return [
            'month' => $months[$item->month] ?? $item->month,
            'revenue' => (float) $item->revenue,
            'expenses' => (float) ($item->revenue * 0.6), // demo expense logic
        ];
    });
        return view('admin.dashboards.dashboard', compact(
            'stats',
            'recentOrders',
            'topProducts',
            'salesByCategory',
            'revenueChart',
            'activities',
            'revenueData'
        ));
    }
    
}