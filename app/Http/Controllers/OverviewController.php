<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;


class OverviewController extends Controller
{
    public function overview()
    {
        /*
|--------------------------------------------------------------------------
| DEMOGRAPHICS (DYNAMIC)
|--------------------------------------------------------------------------
*/

// GENDER (from DB)
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
| AGE GROUPS (DYNAMIC)
|--------------------------------------------------------------------------
*/

$ageRaw = [
    '18-24' => User::whereBetween('age', [18, 24])->count(),
    '25-34' => User::whereBetween('age', [25, 34])->count(),
    '35-44' => User::whereBetween('age', [35, 44])->count(),
    '45+'   => User::where('age', '>=', 45)->count(),
];

$totalAge = array_sum($ageRaw);

$ageData = collect($ageRaw)->map(function ($value, $key) use ($totalAge) {

    return [
        'range' => $key,
        'value' => $totalAge > 0 ? round(($value / $totalAge) * 100) : 0,
        'color' => match ($key) {
            '45+' => 'from-red-500 to-red-600',
            default => 'from-blue-500 to-violet-600',
        },
    ];
})->values();

/*
|--------------------------------------------------------------------------
| TOTAL USERS
|--------------------------------------------------------------------------
*/

$totalUsers = User::count();

        /*
        |--------------------------------------------------------------------------
        | DATE RANGES
        |--------------------------------------------------------------------------
        */

        $currentStart  = Carbon::now()->subDays(15);
        $previousStart = Carbon::now()->subDays(30);
        $previousEnd   = Carbon::now()->subDays(15);


        /*
        |--------------------------------------------------------------------------
        | GROWTH FUNCTION
        |--------------------------------------------------------------------------
        */

        $calculateGrowth = function ($current, $previous) {

            if ($previous > 0) {

                return round(
                    (($current - $previous) / $previous) * 100,
                    1
                );
            }

            return $current > 0 ? 100 : 0;
        };


        /*
        |--------------------------------------------------------------------------
        | TOTAL REVENUE
        |--------------------------------------------------------------------------
        */

        $currentRevenue = Order::where(
            'created_at',
            '>=',
            $currentStart
        )->sum('total');

        $previousRevenue = Order::whereBetween(
            'created_at',
            [$previousStart, $previousEnd]
        )->sum('total');

        $revenueGrowth = $calculateGrowth(
            $currentRevenue,
            $previousRevenue
        );


        /*
        |--------------------------------------------------------------------------
        | ACTIVE USERS
        |--------------------------------------------------------------------------
        */

        $currentUsers = User::where(
            'created_at',
            '>=',
            $currentStart
        )->count();

        $previousUsers = User::whereBetween(
            'created_at',
            [$previousStart, $previousEnd]
        )->count();

        $usersGrowth = $calculateGrowth(
            $currentUsers,
            $previousUsers
        );


        /*
        |--------------------------------------------------------------------------
        | TOTAL ORDERS
        |--------------------------------------------------------------------------
        */

        $currentOrders = Order::where(
            'created_at',
            '>=',
            $currentStart
        )->count();

        $previousOrders = Order::whereBetween(
            'created_at',
            [$previousStart, $previousEnd]
        )->count();

        $ordersGrowth = $calculateGrowth(
            $currentOrders,
            $previousOrders
        );


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

        $conversionRate = $currentUsers > 0
            ? min(($currentOrders / $currentUsers) * 100, 100)
            : 0;

        $previousConversion = $previousUsers > 0
            ? min(($previousOrders / $previousUsers) * 100, 100)
            : 0;

        $conversionGrowth = $calculateGrowth(
            $conversionRate,
            $previousConversion
        );


        /*
        |--------------------------------------------------------------------------
        | CHART FUNCTION
        |--------------------------------------------------------------------------
        */

        $generateChart = function (
            $model,
            $column = null,
            $days = 7
        ) {

            $data = [];

            for ($i = $days - 1; $i >= 0; $i--) {

                $date = Carbon::now()->subDays($i);

                if ($column) {

                    $value = $model::whereDate(
                        'created_at',
                        $date
                    )->sum($column);

                } else {

                    $value = $model::whereDate(
                        'created_at',
                        $date
                    )->count();
                }

                $data[] = (int) $value;
            }

            return $data;
        };


        /*
        |--------------------------------------------------------------------------
        | STATS ARRAY
        |--------------------------------------------------------------------------
        */

        $stats = [

            [
                'title'  => 'Total Revenue',
                'value'  => '$' . number_format($currentRevenue),
                'growth' => $revenueGrowth . '%',
                'date'   => 'vs previous 15 days',
                'icon'   => 'ri-money-dollar-circle-line',
                'color'  => 'green',
                'chart'  => $generateChart(Order::class, 'total')
            ],

            [
                'title'  => 'Active Users',
                'value'  => number_format(User::count()),
                'growth' => $usersGrowth . '%',
                'date'   => 'vs previous 15 days',
                'icon'   => 'ri-user-line',
                'color'  => 'blue',
                'chart'  => $generateChart(User::class)
            ],

            [
                'title'  => 'Total Orders',
                'value'  => number_format(Order::count()),
                'growth' => $ordersGrowth . '%',
                'date'   => 'vs previous 15 days',
                'icon'   => 'ri-shopping-cart-line',
                'color'  => 'purple',
                'chart'  => $generateChart(Order::class)
            ],

            [
                'title'  => 'Conversion Rate',
                'value'  => round($conversionRate, 1) . '%',
                'growth' => $conversionGrowth . '%',
                'date'   => 'vs previous 15 days',
                'icon'   => 'ri-pie-chart-line',
                'color'  => 'orange',
                'chart'  => [20,35,30,40,45,50,60]
            ],

            [
                'title'  => 'Avg Order Value',
                'value'  => '$' . number_format($avgOrder, 0),
                'growth' => $avgGrowth . '%',
                'date'   => 'vs previous 15 days',
                'icon'   => 'ri-wallet-line',
                'color'  => 'red',
                'chart'  => $generateChart(Order::class, 'total')
            ]

        ];


        /*
        |--------------------------------------------------------------------------
        | USER GROWTH CHART DATA
        |--------------------------------------------------------------------------
        */

        $userGrowthData = [];

        $previousDayUsers = 0;

        for ($i = 14; $i >= 0; $i--) {

            $date = Carbon::now()->subDays($i);


            /*
            |--------------------------------------------------------------------------
            | NEW USERS
            |--------------------------------------------------------------------------
            */

            $newUsersCount = User::whereDate(
                'created_at',
                $date
            )->count();


            /*
            |--------------------------------------------------------------------------
            | RETURNING USERS
            |--------------------------------------------------------------------------
            */

            $returningUsersCount = User::whereDate('updated_at', $date)
                ->whereColumn('updated_at', '>', 'created_at')
                ->count();


            /*
            |--------------------------------------------------------------------------
            | GROWTH RATE
            |--------------------------------------------------------------------------
            */

            if ($previousDayUsers > 0) {

                $growth = (
                    ($newUsersCount - $previousDayUsers)
                    / $previousDayUsers
                ) * 100;

            } else {

                $growth = $newUsersCount > 0 ? 100 : 0;
            }


            $userGrowthData[] = [

                'day' => $date->format('M j'),

                'new_users' => $newUsersCount,

                'returning_users' => $returningUsersCount,

                'growth_rate' => round($growth, 1)
            ];


            /*
            |--------------------------------------------------------------------------
            | SAVE PREVIOUS DAY USERS
            |--------------------------------------------------------------------------
            */

            $previousDayUsers = $newUsersCount;
        }
        $salesColors = [
    '#3b82fe',
    '#8b5cf6',
    '#10b981',
    '#f59e0b',
    '#ef4444',
    '#06b6d4',
];

$totalSales = Sale::sum('quantity');

$salesData = Sale::select(
        'category as name',
        DB::raw('SUM(quantity) as qty'),
        DB::raw('SUM(total) as total')
    )
    ->groupBy('category')
    ->get()
    ->map(function ($item, $index) use ($totalSales, $salesColors) {

        return [
            'name' => $item->name,
            'value' => $totalSales > 0
                ? round(($item->qty / $totalSales) * 100)
                : 0,

            'total' => (float) $item->total,

            'color' => $salesColors[$index % count($salesColors)],
        ];
    });


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
        'total' => User::where('created_at', '>=', now()->subDays(30))->count(),
    ],

    (object)[
        'source' => 'Organic',
        'total' => Sale::where('created_at', '>=', now()->subDays(30))->sum('quantity'),
    ],

    (object)[
        'source' => 'Social media',
        'total' => Order::where('status', 'completed')->count(),
    ],

    (object)[
        'source' => 'Referral',
        'total' => Product::count(),
    ],

    (object)[
        'source' => 'Email',
        'total' => Order::whereMonth('created_at', now()->month)->count(),
    ],

]);

$totalVisits = $traffic->sum('total');

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
    ->map(function ($item) use ($totalUsersCount, $regionStyles) {

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
| INSIGHTS (FIXED + DYNAMIC)
|--------------------------------------------------------------------------
*/

$insights = [];

/*
|-----------------------
| REVENUE INSIGHT
|-----------------------
*/
$revenueGrowth = $calculateGrowth($currentRevenue, $previousRevenue);

if ($revenueGrowth > 10) {
    $insights[] = [
        'title' => 'Revenue Growth',
        'desc'  => 'Revenue increased by ' . round($revenueGrowth, 1) . '%',
        'tip'   => 'Increase marketing budget.',
        'icon'  => 'ri-arrow-up-line',
        'color' => 'green',
    ];
} elseif ($revenueGrowth < 0) {
    $insights[] = [
        'title' => 'Revenue Drop',
        'desc'  => 'Revenue decreased by ' . round(abs($revenueGrowth), 1) . '%',
        'tip'   => 'Check sales strategy.',
        'icon'  => 'ri-arrow-down-line',
        'color' => 'red',
    ];
}

/*
|-----------------------
| ORDERS INSIGHT
|-----------------------
*/
$orderGrowth = $calculateGrowth($currentOrders, $previousOrders);

if ($orderGrowth > 10) {
    $insights[] = [
        'title' => 'Orders Increasing',
        'desc'  => 'Orders grew by ' . round($orderGrowth, 1) . '%',
        'tip'   => 'Scale inventory.',
        'icon'  => 'ri-shopping-cart-line',
        'color' => 'blue',
    ];
}

/*
|-----------------------
| PRODUCTS INSIGHT
|-----------------------
*/
$productsCount = Product::count();
if ($productsCount < 10) {
    $insights[] = [
        'title' => 'Low Product Count',
        'desc'  => 'You have only ' . $productsCount . ' products.',
        'tip'   => 'Add more products.',
        'icon'  => 'ri-box-3-line',
        'color' => 'yellow',
    ];
}

/*
|-----------------------
| CONVERSION INSIGHT
|-----------------------
*/
if ($conversionRate < 2) {
    $insights[] = [
        'title' => 'Low Conversion Rate',
        'desc'  => 'Conversion rate is ' . round($conversionRate, 1) . '%',
        'tip'   => 'Improve UI/UX.',
        'icon'  => 'ri-bar-chart-line',
        'color' => 'purple',
    ];
}
/*
|--------------------------------------------------------------------------
| REVENUE ANALYTICS (LAST 15 DAYS)
|--------------------------------------------------------------------------
*/

$analytics = [];

for ($i = 14; $i >= 0; $i--) {

    $date = Carbon::now()->subDays($i)->toDateString();

    $revenue = Order::whereDate('created_at', $date)
        ->sum('total');

    $expenses = Order::whereDate('created_at', $date)
        ->sum('cost') ?? ($revenue * 0.4); // fallback if cost column missing

    $analytics[] = [
        'day' => Carbon::parse($date)->format('M j'),
        'revenue' => (float) $revenue,
        'expenses' => (float) $expenses,
    ];
}
$totalRevenue = collect($analytics)->sum('revenue');
$totalExpenses = collect($analytics)->sum('expenses');
$netProfit = $totalRevenue - $totalExpenses;

$labels = collect($analytics)->pluck('day');
$revenues = collect($analytics)->pluck('revenue');
$expenses = collect($analytics)->pluck('expenses');

        return view(
            'admin.dashboards.overview',
            compact('stats', 'userGrowthData','genderData','ageData','totalUsers',
            'salesData','totalVisits','trafficColors','traffic', 'regions','insights' ,'analytics',
    'labels',
    'revenues',
    'expenses',
    'totalRevenue',
    'totalExpenses',
    'netProfit')
        );
    }
}