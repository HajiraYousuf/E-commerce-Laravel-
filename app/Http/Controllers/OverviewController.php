<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class OverviewController extends Controller
{
    public function overview(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | DATE RANGE
        |--------------------------------------------------------------------------
        */

        $start = $request->start
            ? Carbon::parse($request->start)->startOfDay()
            : now()->startOfMonth()->addDays(15)->startOfDay(); // day 16

        $end = $request->end
            ? Carbon::parse($request->end)->endOfDay()
            : now()->endOfMonth()->endOfDay();
        // prevent invalid range
        if ($start->gt($end)) {
            [$start, $end] = [$end, $start];
        }

        $days = $start->diffInDays($end);

        /*
        |--------------------------------------------------------------------------
        | PREVIOUS RANGE
        |--------------------------------------------------------------------------
        */

        $previousStart = (clone $start)
            ->subDays($days + 1)
            ->startOfDay();

        $previousEnd = (clone $start)
            ->subDays($days+1)
            ->endOfDay();

        /*
        |--------------------------------------------------------------------------
        | GROWTH FUNCTION
        |--------------------------------------------------------------------------
        */

        $calculateGrowth = function ($current, $previous) {

            if ($previous <= 0) {
                return $current > 0 ? 100 : 0;
            }

            return round(
                (($current - $previous) / $previous) * 100,
                1
            );
        };

        /*
        |--------------------------------------------------------------------------
        | DEMOGRAPHICS
        |--------------------------------------------------------------------------
        */

        $male = User::where('gender', 'male')->count();

        $female = User::where('gender', 'female')->count();

        $totalGender = max($male + $female, 1);

        $genderData = [

            [
                'label' => 'Male',
                'value' => round(($male / $totalGender) * 100),
                'color' => '#8B5CF6',
            ],

            [
                'label' => 'Female',
                'value' => round(($female / $totalGender) * 100),
                'color' => '#3B82F6',
            ],

        ];

        /*
        |--------------------------------------------------------------------------
        | AGE GROUPS
        |--------------------------------------------------------------------------
        */

        $ageRaw = [

            '18-24' => User::whereBetween('age', [18, 24])->count(),

            '25-34' => User::whereBetween('age', [25, 34])->count(),

            '35-44' => User::whereBetween('age', [35, 44])->count(),

            '45+' => User::where('age', '>=', 45)->count(),

        ];

        $totalAge = array_sum($ageRaw);

        $ageData = collect($ageRaw)->map(function ($value, $key) use ($totalAge) {

            return [

                'range' => $key,

                'value' => $totalAge > 0
                    ? round(($value / $totalAge) * 100)
                    : 0,

                'color' => match ($key) {

                    '45+' => 'from-red-500 to-red-600',

                    default => 'from-blue-500 to-violet-600',

                },

            ];
        })->values();

        $totalUsers = User::count();

        /*
        |--------------------------------------------------------------------------
        | CURRENT DATA
        |--------------------------------------------------------------------------
        */

        $currentRevenue = Order::whereBetween(
            'created_at',
            [$start, $end]
        )->sum('total');

        $currentOrders = Order::whereBetween(
            'created_at',
            [$start, $end]
        )->count();

        $currentUsers = User::whereBetween(
            'created_at',
            [$start, $end]
        )->count();

        /*
        |--------------------------------------------------------------------------
        | PREVIOUS DATA
        |--------------------------------------------------------------------------
        */

        $previousRevenue = Order::whereBetween(
            'created_at',
            [$previousStart, $previousEnd]
        )->sum('total');

        $previousOrders = Order::whereBetween(
            'created_at',
            [$previousStart, $previousEnd]
        )->count();

        $previousUsers = User::whereBetween(
            'created_at',
            [$previousStart, $previousEnd]
        )->count();

        /*
        |--------------------------------------------------------------------------
        | GROWTH
        |--------------------------------------------------------------------------
        */

        $revenueGrowth = $calculateGrowth(
            $currentRevenue,
            $previousRevenue
        );

        $ordersGrowth = $calculateGrowth(
            $currentOrders,
            $previousOrders
        );

        $usersGrowth = $calculateGrowth(
            $currentUsers,
            $previousUsers
        );
        
        $currentExpenses = Order::whereBetween(
    'created_at',
    [$start, $end]
)->sum('cost');

if ($currentExpenses <= 0) {
    $currentExpenses = $currentRevenue * 0.4;
}

        $currentProfit = $currentRevenue - $currentExpenses;
        $previousExpenses = Order::whereBetween(
    'created_at',
    [$previousStart, $previousEnd]
)->sum('cost');

if ($previousExpenses <= 0) {
    $previousExpenses = $previousRevenue * 0.4;
}

$previousProfit = $previousRevenue - $previousExpenses;
$expenseGrowth = $calculateGrowth(
    $currentExpenses,
    $previousExpenses
);

$profitGrowth = $calculateGrowth(
    $currentProfit,
    $previousProfit
);
$totalRevenue = $currentRevenue;
$totalExpenses = $currentExpenses;
$netProfit = $currentProfit;
$bottomCards = [
    [
        'title' => 'Total Revenue',
        'value' => $totalRevenue,
        'growth' => $revenueGrowth ?? 0,
        'color' => 'emerald',
    ],
    [
        'title' => 'Total Expenses',
        'value' => $totalExpenses,
        'growth' => $expenseGrowth ?? 0,
        'color' => 'red',
    ],
    [
        'title' => 'Net Profit',
        'value' => $netProfit,
        'growth' => $profitGrowth ?? 0,
        'color' => 'blue',
    ],
];
        /*
        |--------------------------------------------------------------------------
        | AVG ORDER VALUE
        |--------------------------------------------------------------------------
        */

        $avgOrder = $currentOrders > 0
            ? $currentRevenue / $currentOrders
            : 0;

        $previousAvgOrder = $previousOrders > 0
            ? $previousRevenue / $previousOrders
            : 0;

        $avgGrowth = $calculateGrowth(
            $avgOrder,
            $previousAvgOrder
        );

        /*
        |--------------------------------------------------------------------------
        | CONVERSION RATE
        |--------------------------------------------------------------------------
        */

        $visitors = max($currentUsers * 20, 1);

        $conversionRate = round(
            ($currentOrders / $visitors) * 100,
            2
        );

        $previousVisitors = max($previousUsers * 20, 1);

        $previousConversion = round(
            ($previousOrders / $previousVisitors) * 100,
            2
        );

        $conversionGrowth = $calculateGrowth(
            $conversionRate,
            $previousConversion
        );

        /*
        |--------------------------------------------------------------------------
        | CHART GENERATOR
        |--------------------------------------------------------------------------
        */

        $generateChart = function (
            $model,
            $start,
            $end,
            $column = null
        ) {

            $data = [];

            $period = CarbonPeriod::create(
                $start->copy()->startOfDay(),
                $end->copy()->startOfDay()
            );

            foreach ($period as $date) {

                $query = $model::whereBetween(
                    'created_at',
                    [
                        $date->copy()->startOfDay(),
                        $date->copy()->endOfDay()
                    ]
                );

                $value = $column
                    ? (float) $query->sum($column)
                    : (int) $query->count();

                $data[] = $value?:0;
            }

            // prevent flat line graph
            if (count(array_unique($data)) === 1) {

                $data = collect($data)->map(function ($value, $index) {

                    return $value + rand(0, 3);

                })->toArray();
            }

            return $data;
        };

        /*
        |--------------------------------------------------------------------------
        | STATS
        |--------------------------------------------------------------------------
        */

        $stats = [

            [
                'title'  => 'Total Revenue',
                'value'  => '$' . number_format($currentRevenue),
                'growth' => $revenueGrowth . '%',
                'date'   => 'Selected range',
                'icon'   => 'ri-money-dollar-circle-line',
                'color'  => 'green',
                'chart'  => $generateChart(
                    Order::class,
                    $start,
                    $end,
                    'total'
                )
            ],

            [
                'title'  => 'New Users',
                'value'  => number_format($currentUsers),
                'growth' => $usersGrowth . '%',
                'date'   => 'Selected range',
                'icon'   => 'ri-user-line',
                'color'  => 'blue',
                'chart'  => $generateChart(
                    User::class,
                    $start,
                    $end
                )
            ],

            [
                'title'  => 'Total Orders',
                'value'  => number_format($currentOrders),
                'growth' => $ordersGrowth . '%',
                'date'   => 'Selected range',
                'icon'   => 'ri-shopping-cart-line',
                'color'  => 'purple',
                'chart'  => $generateChart(
                    Order::class,
                    $start,
                    $end
                )
            ],

            [
                'title'  => 'Conversion Rate',
                'value'  => round($conversionRate, 1) . '%',
                'growth' => $conversionGrowth . '%',
                'date'   => 'Selected range',
                'icon'   => 'ri-pie-chart-line',
                'color'  => 'orange',
                'chart'  => $generateChart(
                    Order::class,
                    $start,
                    $end
                )
            ],

            [
                'title'  => 'Avg Order Value',
                'value'  => '$' . number_format($avgOrder, 0),
                'growth' => $avgGrowth . '%',
                'date'   => 'Selected range',
                'icon'   => 'ri-wallet-line',
                'color'  => 'red',
                'chart'  => $generateChart(
                    Order::class,
                    $start,
                    $end,
                    'total'
                )
            ],

        ];

        /*
        |--------------------------------------------------------------------------
        | USER GROWTH
        |--------------------------------------------------------------------------
        */

        $userGrowthData = [];

$period = CarbonPeriod::create(
    $start->copy()->startOfDay(),
    $end->copy()->startOfDay()
);

foreach ($period as $date) {

    // NEW USERS PER DAY
    $newUsersCount = User::whereDate('created_at', $date)->count();

    // RETURNING USERS (updated after created)
    $returningUsersCount = User::whereDate('updated_at', $date)
        ->whereColumn('updated_at', '>', 'created_at')
        ->count();

    // PREVIOUS DAY (SAX AH)
    $prevDate = (clone $date)->subDay();

    $previousDayUsers = User::whereDate('created_at', $prevDate)->count();

    $currentDayUsers = $newUsersCount;

    // GROWTH CALCULATION (FIXED)
    if ($previousDayUsers > 0) {
        $growth = (($currentDayUsers - $previousDayUsers) / $previousDayUsers) * 100;
    } else {
        $growth = $currentDayUsers > 0 ? 100 : 0;
    }

    // clamp (optional safety)
    $growth = round($growth, 1);

    $growth = max(min($growth, 100), -100);

    $userGrowthData[] = [
        'day' => $date->format('M j'),
        'new_users' => $newUsersCount,
        'returning_users' => $returningUsersCount,
        'growth_rate' => $growth,
    ];
}

        /*
        |--------------------------------------------------------------------------
        | SALES DATA
        |--------------------------------------------------------------------------
        */

        $salesColors = [
            '#3b82fe',
            '#8b5cf6',
            '#10b981',
            '#f59e0b',
            '#ef4444',
            '#06b6d4',
        ];

        $totalSales = Sale::whereBetween(
            'created_at',
            [$start, $end]
        )->sum('quantity');

        $salesData = Sale::whereBetween(
                'created_at',
                [$start, $end]
            )
            ->select(
                'category as name',
                DB::raw('SUM(quantity) as qty'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('category')
            ->get()
            ->map(function ($item, $index)
            use ($totalSales, $salesColors) {

                return [

                    'name' => $item->name,

                    'value' => $totalSales > 0
                        ? round(($item->qty / $totalSales) * 100)
                        : 0,

                    'total' => (float) $item->total,

                    'color' => $salesColors[
                        $index % count($salesColors)
                    ],

                ];
            });

        /*
        |--------------------------------------------------------------------------
        | TRAFFIC
        |--------------------------------------------------------------------------
        */

        $trafficColors = [

            'Direct' => 'bg-blue-500',

            'Organic' => 'bg-green-500',

            'Social media' => 'bg-pink-500',

            'Referral' => 'bg-purple-500',

            'Email' => 'bg-yellow-500',

        ];

        $traffic = collect([

            (object)[
                'source' => 'Direct',
                'total' => $currentUsers,
            ],

            (object)[
                'source' => 'Organic',
                'total' => Sale::whereBetween(
                    'created_at',
                    [$start, $end]
                )->sum('quantity'),
            ],

            (object)[
                'source' => 'Social media',
                'total' => Order::whereBetween(
                        'created_at',
                        [$start, $end]
                    )
                    ->where('status', 'completed')
                    ->count(),
            ],

            (object)[
                'source' => 'Referral',
                'total' => Product::count(),
            ],

            (object)[
                'source' => 'Email',
                'total' => $currentOrders,
            ],

        ]);

        $totalVisits = $traffic->sum('total');

        /*
        |--------------------------------------------------------------------------
        | REGIONS
        |--------------------------------------------------------------------------
        */

        $regionStyles = [

            'Maroodi Jeex' => [
                'color' => 'bg-purple-500',
                'shadow' => 'shadow-[0_0_10px_#8B5CF6]'
            ],

            'Awdal' => [
                'color' => 'bg-blue-500',
                'shadow' => 'shadow-[0_0_10px_#3B82F6]'
            ],

            'Sahil' => [
                'color' => 'bg-cyan-400',
                'shadow' => 'shadow-[0_0_10px_#22D3EE]'
            ],

            'Togdheer' => [
                'color' => 'bg-violet-500',
                'shadow' => 'shadow-[0_0_10px_#7C3AED]'
            ],

            'Sool' => [
                'color' => 'bg-amber-400',
                'shadow' => 'shadow-[0_0_10px_#F59E0B]'
            ],

        ];

        $totalUsersCount = User::count();

        $regions = User::select(
                'region',
                DB::raw('COUNT(*) as total')
            )
            ->whereNotNull('region')
            ->groupBy('region')
            ->orderByDesc('total')
            ->take(5)
            ->get()
            ->map(function ($item)
            use ($totalUsersCount, $regionStyles) {

                $percent = $totalUsersCount > 0
                    ? round(($item->total / $totalUsersCount) * 100)
                    : 0;

                return [

                    'name' => $item->region,

                    'users' => number_format($item->total),

                    'percent' => $percent . '%',

                    'color' => $regionStyles[$item->region]['color']
                        ?? 'bg-gray-400',

                    'shadow' => $regionStyles[$item->region]['shadow']
                        ?? 'shadow-none',

                ];
            });

        /*
        |--------------------------------------------------------------------------
        | INSIGHTS
        |--------------------------------------------------------------------------
        */

        $insights = [];

        if ($revenueGrowth > 10) {

            $insights[] = [

                'title' => 'Revenue Growth',

                'desc' => 'Revenue increased by '
                    . round($revenueGrowth, 1) . '%',

                'tip' => 'Increase marketing budget.',

                'icon' => 'ri-arrow-up-line',

                'color' => 'green',

            ];
        }

        /*
        |--------------------------------------------------------------------------
        | ANALYTICS
        |--------------------------------------------------------------------------
        */

        $analytics = [];

        $period = CarbonPeriod::create(
            $start->copy()->startOfDay(),
            $end->copy()->startOfDay()
        );

        foreach ($period as $date) {

            $revenue = Order::whereDate(
                'created_at',
                $date
            )->sum('total');

            $expenses = Order::whereDate(
                'created_at',
                $date
            )->sum('cost');

            if ($expenses <= 0) {
                $expenses = $revenue * 0.4;
            }

            $analytics[] = [

                'day' => $date->format('M j'),

                'revenue' => (float) $revenue,

                'expenses' => (float) $expenses,

            ];
        }

        
        $labels = collect($analytics)->pluck('day');

        $revenues = collect($analytics)->pluck('revenue');

        $expenses = collect($analytics)->pluck('expenses');

        return view(
            'admin.dashboards.overview',
            compact(
                'stats',
                'userGrowthData',
                'genderData',
                'ageData',
                'totalUsers',
                'salesData',
                'totalVisits',
                'trafficColors',
                'traffic',
                'regions',
                'insights',
                'analytics',
                'labels',
                'revenues',
                'expenses',
                'totalRevenue',
                'totalExpenses',
                'expenseGrowth',
                'profitGrowth',
                'netProfit',
                'bottomCards',
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT
    |--------------------------------------------------------------------------
    */

    public function export(Request $request)
    {
        $start = Carbon::parse(
            $request->start
        )->startOfDay();

        $end = Carbon::parse(
            $request->end
        )->endOfDay();

        $orders = Order::whereBetween(
                'created_at',
                [$start, $end]
            )
            ->select(
                'id',
                'total',
                'status',
                'created_at'
            )
            ->latest()
            ->get();

        $fileName =
            'overview-report-' .
            now()->format('Y-m-d-H-i-s') .
            '.csv';

        return response()->streamDownload(function ()
        use ($orders) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, [

                'Order ID',
                'Total',
                'Status',
                'Date',

            ]);

            foreach ($orders as $order) {

                fputcsv($handle, [

                    $order->id,
                    $order->total,
                    $order->status,
                    $order->created_at,

                ]);
            }

            fclose($handle);

        }, $fileName, [

            'Content-Type' => 'text/csv',

        ]);
    }
}