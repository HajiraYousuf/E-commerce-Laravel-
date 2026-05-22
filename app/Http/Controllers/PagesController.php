<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Product;

class PagesController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboards.dashboard'); 
    }
    public function overview(){
        return view('admin.dashboards.overview');
    }
    public function report(){
        return view('admin.dashboards.reports');
    }
    public function insight(){
        return view('admin.dashboards.insights');
    }
    public function inventroy(){
    $totalProducts = Product::count();
    $inStock = Product::where('stock', '>', 10)->count();
    $lowStock = Product::whereBetween('stock', [1, 10])->count();
    $outStock = Product::where('stock', 0)->count();
    $products = Product::latest()->get(); // 🔥 THIS WAS MISSING

    return view('admin.inventory.inventory', compact(
        'totalProducts',
        'inStock',
        'lowStock',
        'outStock',
        'products'
    ));
    }
    public function transaction(){
        return view('admin.transaction.transaction');
    }
    public function calendar(){
        return view('admin.calendar.calendar');
    }
    public function settings(){
        return view('admin.settings.settings');
    }
    public function messages(){
        return view('admin.messages.messages');
    }
    
    
    public function users(){
        return view('admin.users.index');
    }
        
   public function user_activity(Request $request)
{
    $query = Activity::query();

    // SEARCH (clean + reusable)
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('user', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('action', 'like', "%{$search}%")
              ->orWhere('module', 'like', "%{$search}%");
        });
    }

    // USER FILTER
    if ($request->filled('user')) {
        $query->where('user', $request->user);
    }

    // ACTION FILTER
    if ($request->filled('action')) {
        $query->where('action', $request->action);
    }

    // PAGINATION (IMPORTANT)
    $activities = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    // DISTINCT USERS (optimized)
    $users = Activity::with('user')
        ->get()
        ->pluck('user.name')
        ->filter()
        ->unique()
        ->values();

    return view('admin.users.user-activity', compact('activities', 'users'));
}
}
