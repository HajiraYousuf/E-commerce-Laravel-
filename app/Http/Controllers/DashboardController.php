<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

$menuItems = [
    [
        "id" => "dashboard",
        "icon" => "LayoutDashboard",
        "label" => "Dashboard",
        "active" => true,
        "badge" => "New",
    ],
    [
        "id" => "analytics",
        "icon" => "BarChart3",
        "label" => "Analytics",
        "submenu" => [
            ["id" => "overview", "label" => "Overview"],
            ["id" => "reports", "label" => "Reports"],
            ["id" => "insights", "label" => "Insights"],
        ],
    ],
    [
        "id" => "users",
        "icon" => "Users",
        "label" => "Users",
        "count" => "2.4k",
        "submenu" => [
            ["id" => "all_users", "label" => "All Users"],
            ["id" => "roles", "label" => "Roles & Permissions"],
            ["id" => "activity", "label" => "User Activity"],
        ],
    ],
    [
        "id" => "ecommerce",
        "icon" => "ShoppingBag",
        "label" => "E-commerce",
        "submenu" => [
            ["id" => "products", "label" => "Products"],
            ["id" => "orders", "label" => "Orders"],
            ["id" => "customers", "label" => "Customers"],
        ],
    ],
    [
        "id" => "inventory",
        "icon" => "Package",
        "label" => "Inventory",
        "count" => "847",
    ],
    [
        "id" => "transactions",
        "icon" => "CreditCard",
        "label" => "Transactions",
    ],
    [
        "id" => "messages",
        "icon" => "MessagesSquare",
        "label" => "Messages",
        "badge" => "12",
    ],
    [
        "id" => "calendar",
        "icon" => "Calendar",
        "label" => "Calendar",
    ],
    [
        "id" => "reports",
        "icon" => "FileText",
        "label" => "Reports",
    ],
    [
        "id" => "settings",
        "icon" => "Settings",
        "label" => "Settings",
    ],
];

$stats = [
    [
        "title" => "Total Revenue",
        "value" => "$124,563",
        "change" => "+12.5%",
        "trend" => "up",
        "type" => "revenue",
        "color" => "emerald",
    ],
    [
        "title" => "Active Users",
        "value" => "8,549",
        "change" => "+8.2%",
        "trend" => "up",
        "type" => "users",
        "color" => "blue",
    ],
    [
        "title" => "Total Orders",
        "value" => "2,847",
        "change" => "+15.3%",
        "trend" => "up",
        "type" => "orders",
        "color" => "purple",
    ],
    [
        "title" => "Page Views",
        "value" => "45,892",
        "change" => "-2.1%",
        "trend" => "down",
        "type" => "views",
        "color" => "orange",
    ],
];
$activities = [
        [
            'id' => 1,
            'type' => 'user',
            'icon' => 'user',
            'title' => 'New user registered',
            'description' => 'Ahmed created an account',
            'time' => '2 minutes ago',
            'color' => 'text-blue-500',
            'bgColor' => 'bg-blue-100 dark:bg-blue-900/30',
        ],
        [
            'id' => 2,
            'type' => 'order',
            'icon' => 'shopping-cart',
            'title' => 'New order received',
            'description' => 'Order #3847 for $2,399',
            'time' => '5 minutes ago',
            'color' => 'text-emerald-500',
            'bgColor' => 'bg-emerald-100 dark:bg-emerald-900/30',
        ],
        [
            'id' => 3,
            'type' => 'payment',
            'icon' => 'credit-card',
            'title' => 'Payment processed',
            'description' => 'Payment of $1,199 completed',
            'time' => '12 minutes ago',
            'color' => 'text-purple-500',
            'bgColor' => 'bg-purple-100 dark:bg-purple-900/30',
        ],
        [
            'id' => 4,
            'type' => 'system',
            'icon' => 'settings',
            'title' => 'System update',
            'description' => 'Database backup completed',
            'time' => '1 hour ago',
            'color' => 'text-orange-500',
            'bgColor' => 'bg-orange-100 dark:bg-orange-900/30',
        ],
        [
            'id' => 5,
            'type' => 'notification',
            'icon' => 'bell',
            'title' => 'Low stock alert',
            'description' => 'iPhone 15 Pro stock is low',
            'time' => '2 hours ago',
            'color' => 'text-red-500',
            'bgColor' => 'bg-red-100 dark:bg-red-900/30',
        ],
    ];


    $revenueData = [
        ['month' => 'Jan', 'revenue' => 45000, 'expenses' => 32000],
        ['month' => 'Feb', 'revenue' => 52000, 'expenses' => 38000],
        ['month' => 'Mar', 'revenue' => 48000, 'expenses' => 35000],
        ['month' => 'Apr', 'revenue' => 61000, 'expenses' => 42000],
        ['month' => 'May', 'revenue' => 55000, 'expenses' => 48000],
        ['month' => 'Jun', 'revenue' => 67000, 'expenses' => 45000],
        ['month' => 'Jul', 'revenue' => 72000, 'expenses' => 48000],
        ['month' => 'Aug', 'revenue' => 69000, 'expenses' => 46000],
        ['month' => 'Sep', 'revenue' => 78000, 'expenses' => 52000],
        ['month' => 'Oct', 'revenue' => 74000, 'expenses' => 50000],
        ['month' => 'Nov', 'revenue' => 82000, 'expenses' => 55000],
        ['month' => 'Dec', 'revenue' => 89000, 'expenses' => 58000],
    ];
     $salesData = [
        ['name' => 'Electronics', 'value' => 45, 'color' => '#3b82fe'],
        ['name' => 'Clothing', 'value' => 30, 'color' => '#8b5cf6'],
        ['name' => 'Books', 'value' => 15, 'color' => '#10b981'],
        ['name' => 'Other', 'value' => 10, 'color' => '#f59e0b'],
    ];

     $recentOrders = [
        [
            'id' => '#3847',
            'customer' => 'Ahmet Mahad',
            'product' => 'MacBook Pro 16',
            'amount' => '$2,399',
            'status' => 'completed',
            'date' => '2024-01-15',
        ],
        [
            'id' => '#3848',
            'customer' => 'Sarah Osman',
            'product' => 'iPhone 15 Pro',
            'amount' => '$1,199',
            'status' => 'pending',
            'date' => '2024-01-15',
        ],
        [
            'id' => '#3849',
            'customer' => 'Negaad Ahmed',
            'product' => 'AirPods Pro',
            'amount' => '$249',
            'status' => 'completed',
            'date' => '2024-01-14',
        ],
        [
            'id' => '#3850',
            'customer' => 'Mohamet Khadar',
            'product' => 'iPad Air',
            'amount' => '$599',
            'status' => 'cancelled',
            'date' => '2024-01-14',
        ],
    ];

    $topProducts = [
        [
            'name' => 'MacBook Pro 16',
            'sales' => 1247,
            'revenue' => '$2,987,530',
            'trend' => 'up',
            'change' => '+12%',
        ],
        [
            'name' => 'iPhone 15 Pro',
            'sales' => 2156,
            'revenue' => '$2,587,044',
            'trend' => 'up',
            'change' => '+8%',
        ],
        [
            'name' => 'AirPods Pro',
            'sales' => 3421,
            'revenue' => '$852,229',
            'trend' => 'down',
            'change' => '-3%',
        ],
        [
            'name' => 'iPad Air',
            'sales' => 987,
            'revenue' => '$591,213',
            'trend' => 'up',
            'change' => '+15%',
        ],
    ];
 return view('dashboard.dashboard', compact(
        'menuItems',
        'stats',
        'revenueData',
        'salesData',
        'recentOrders',
        'topProducts',
        'activities'
    ));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
