<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use ZipArchive;
use Illuminate\Support\Facades\Storage;


class ReportController extends Controller
{
    public function report()
    {
        // =========================
        // BASIC STATS
        // =========================
        $sales = Order::where('status', 'completed')->count();
        $revenue = Payment::sum('amount');
        $users = User::count();
        $products = Product::count();
        $inventoryValue = Product::sum(DB::raw('price * stock'));
        $orders = Order::count();

        // =========================
        // GROWTH FUNCTION CALLS
        // =========================
        $revenueGrowth = $this->growth(
            Order::whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth()
            ])->sum('total'),

            Order::whereBetween('created_at', [
                now()->subMonth()->startOfMonth(),
                now()->subMonth()->endOfMonth()
            ])->sum('total')
        );

        $orderGrowth = $this->growth(
            Order::whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth()
            ])->count(),

            Order::whereBetween('created_at', [
                now()->subMonth()->startOfMonth(),
                now()->subMonth()->endOfMonth()
            ])->count()
        );

        $userGrowth = $this->growth(
            User::whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth()
            ])->count(),

            User::whereBetween('created_at', [
                now()->subMonth()->startOfMonth(),
                now()->subMonth()->endOfMonth()
            ])->count()
        );

        // =========================
        // REPORTS LIST
        // =========================
        $reports = collect([
            ['title' => 'Sales Report', 'type' => 'sales'],
            ['title' => 'Revenue Report', 'type' => 'revenue'],
            ['title' => 'Users Report', 'type' => 'users'],
            ['title' => 'Products Report', 'type' => 'products'],
            ['title' => 'Inventory Report', 'type' => 'inventory'],
        ])->map(fn($r) => array_merge($r, [
            'ext' => '.xlsx',
            'date' => now()->format('M d, Y'),
        ]));

        // =========================
        // STATS (CLEAN + DYNAMIC)
        // =========================
        $stats = [
            $this->makeStat(
                'Total Revenue',
                Order::sum('total'),
                'emerald',
                'ri-money-dollar-circle-line',
                Order::selectRaw('DATE(created_at) as d, SUM(total) as t')
                    ->groupBy('d')->pluck('t')->toArray(),
                $revenueGrowth
            ),

            $this->makeStat(
                'Total Orders',
                Order::count(),
                'blue',
                'ri-shopping-bag-3-line',
                Order::selectRaw('DATE(created_at) as d, COUNT(*) as t')
                    ->groupBy('d')->pluck('t')->toArray(),
                $orderGrowth
            ),

            $this->makeStat(
                'Total Customers',
                User::count(),
                'violet',
                'ri-group-line',
                User::selectRaw('DATE(created_at) as d, COUNT(*) as t')
                    ->groupBy('d')->pluck('t')->toArray(),
                $userGrowth
            ),

            $this->makeStat(
                'Total Profit',
                Order::sum('total'),
                'rose',
                'ri-line-chart-line',
                Order::selectRaw('DATE(created_at) as d, SUM(total) as t')
                    ->groupBy('d')->pluck('t')->toArray(),
                $revenueGrowth
            ),
        ];
        $topProducts = Product::select('id','name','category','sold','price','cost','image')
        ->orderBy('sold', 'desc')
        ->limit(5)
        ->get()
        ->map(function ($p) {
            return [
                'name' => $p->name,
                'category' => $p->category,
                'sold' => $p->sold,
                'revenue' => '$' . number_format($p->price * $p->sold),
                'profit' => '$' . number_format(($p->price - $p->cost) * $p->sold),
                'image' => $p->image,
            ];
        });
        $range = $request->range ?? 'monthly';

            $query = Order::query();

            if ($range == 'daily') {
                $salesChart = $query->selectRaw('DATE(created_at) as day, SUM(total) as sales')
                    ->whereDate('created_at', today())
                    ->groupBy('day')
                    ->get();
            }

            elseif ($range == 'weekly') {
                $salesChart = $query->selectRaw('DATE(created_at) as day, SUM(total) as sales')
                    ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                    ->groupBy('day')
                    ->get();
            }

            elseif ($range == 'yearly') {
                $salesChart = $query->selectRaw('MONTH(created_at) as day, SUM(total) as sales')
                    ->whereYear('created_at', now()->year)
                    ->groupBy('day')
                    ->get();
            }

            else { // monthly default
                $salesChart = $query->selectRaw('DATE(created_at) as day, SUM(total) as sales')
                    ->whereMonth('created_at', now()->month)
                    ->groupBy('day')
                    ->get();
            }


        return view('admin.dashboards.reports', compact(
            'reports',
            'sales',
            'revenue',
            'users',
            'products',
            'inventoryValue',
            'orders',
            'stats',
            'topProducts',
            'salesChart',
            'range'
        ));
    }

    // =========================
    // GROWTH FUNCTION
    // =========================
    private function growth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }

    // =========================
    // REUSABLE STAT
    // =========================
    private function makeStat($title, $value, $color, $icon, $chart, $growth)
    {
        return [
            'title' => $title,
            'value' => is_numeric($value) ? number_format($value) : $value,
            'growth' => $growth,
            'icon' => $icon,
            'color' => $color,
            'chart' => $chart,
        ];
    }

    // =========================
    // EXPORT (UNCHANGED)
    // =========================
    public function download($type)
    {
        $map = [
            'sales' => [Order::where('status','completed')->get(['id','total','created_at']), 'sales_report.xlsx'],
            'revenue' => [Payment::get(['id','amount','created_at']), 'revenue_report.xlsx'],
            'users' => [User::get(['id','name','email']), 'users_report.xlsx'],
            'products' => [Product::get(['id','name','price','stock']), 'products_report.xlsx'],
            'inventory' => [Product::all()->map(fn($p) => [
                'name' => $p->name,
                'stock' => $p->stock,
                'value' => $p->price * $p->stock,
            ]), 'inventory_report.xlsx'],
        ];

        abort_unless(isset($map[$type]), 404);

        [$data, $fileName] = $map[$type];

        return response()->streamDownload(function () use ($data) {

            $handle = fopen('php://output', 'w');
            $array = $data->toArray();

            if (!empty($array)) {
                fputcsv($handle, array_keys($array[0]));
            }

            foreach ($array as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);

        }, $fileName, [
            'Content-Type' => 'application/vnd.ms-excel',
        ]);
        
    }
    // =========================
// EXPORT ALL REPORTS
// =========================
public function exportAll()
{
    $reports = [

        'sales_report.csv' => Order::where('status', 'completed')
            ->get(['id', 'total', 'created_at'])
            ->toArray(),

        'revenue_report.csv' => Payment::get([
            'id',
            'amount',
            'created_at'
        ])->toArray(),

        'users_report.csv' => User::get([
            'id',
            'name',
            'email'
        ])->toArray(),

        'products_report.csv' => Product::get([
            'id',
            'name',
            'price',
            'stock'
        ])->toArray(),

        'inventory_report.csv' => Product::all()
            ->map(fn($p) => [
                'name' => $p->name,
                'stock' => $p->stock,
                'value' => $p->price * $p->stock,
            ])->toArray(),
    ];

    $zipFileName = 'all_reports.zip';
    $zipPath = storage_path($zipFileName);

    $zip = new ZipArchive;

    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {

        foreach ($reports as $fileName => $rows) {

            $csvContent = '';

            if (!empty($rows)) {

                // HEADERS
                $csvContent .= implode(',', array_keys($rows[0])) . "\n";

                // DATA
                foreach ($rows as $row) {
                    $csvContent .= implode(',', $row) . "\n";
                }
            }

            $zip->addFromString($fileName, $csvContent);
        }

        $zip->close();
    }

    return response()->download($zipPath)->deleteFileAfterSend(true);
}

}