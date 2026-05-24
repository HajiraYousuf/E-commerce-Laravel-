<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\customer;
use App\Models\message;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function home()
    {

        $categories = Category::latest()->take(8)->get();

        $topSellingProducts = Product::with('category')
            ->orderByDesc('sold')
            ->take(8)
            ->get();

        $productsCount = Product::count();

        $categoriesCount = Category::count();
        $cartCount = 0;

        if (Auth::check()) {
            $cartCount = Cart::where('user_id', Auth::id())
                ->sum('quantity');
        }
        return view('components.user.Pages.home',  compact(
            'categories',
            'topSellingProducts',
            'productsCount',
            'categoriesCount',
            'cartCount'
            ));
    }

    public function shop(Request $request)
{
    $query = Product::with('category');

    // SEARCH
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%");

        });
    }

    // CATEGORY FILTER
    if ($request->filled('category')) {

        $query->where('category_id', $request->category);

    }

    // SORTING
    switch ($request->sort) {

        case 'price_low':
            $query->orderBy('price', 'asc');
            break;

        case 'price_high':
            $query->orderBy('price', 'desc');
            break;

        case 'stock':
            $query->orderBy('stock', 'desc');
            break;

        case 'sold':
            $query->orderBy('sold', 'desc');
            break;

        default:
            $query->latest();
            break;
    }

    $products = $query->paginate(12)->withQueryString();

    $categories = Category::latest()->get();

    return view('components.user.Pages.products', compact(
        'products',
        'categories'
    ));
}
    public function productShow($id)
{
    $product = Product::with('category')->findOrFail($id);

    return view('components.user.Pages.show', compact('product'));
}

    public function categories()
    {
        $categories = Category::withCount('products')->latest()->get();

        return view('components.user.Pages.categories', compact('categories'));
    }
    public function cart()
    {
        $cartItems = Cart::with('product')->get(); // or session-based

        $subtotal = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
        $tax = $subtotal * 0.05;
        $total = $subtotal + $tax + 5;

        return view('components.user.Pages.carts', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    public function orders()
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('components.user.Pages.orders', compact('orders'));
    }

    // SINGLE ORDER VIEW
    public function orderShow($id)
    {
        $order = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('components.user.Pages.ordersshow', compact('order'));
    }

    public function checkout()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('error', 'Cart is empty');
        }

        $subtotal = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
        $tax = $subtotal * 0.05;
        $shipping = 5;
        $total = $subtotal + $tax + $shipping;

        return view('components.user.Pages.checkout', compact(
            'cartItems',
            'subtotal',
            'tax',
            'shipping',
            'total'
        ));
    }

    // ================= PLACE ORDER =================
    public function placeOrder(Request $request)
    {
        // ✅ VALIDATION FIXED
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'payment_method' => 'required|in:cash,credit,other',
        ]);

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }

        $subtotal = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);

        // 💡 SHIPPING LOGIC
        $shipping = 5; // default shipping
        if ($request->payment_method === 'cash') {
            $shipping = 5;
        } else {
            $shipping = 0;
        }

        $tax = $subtotal * 0.05;
        $total = $subtotal + $shipping + $tax;

        DB::beginTransaction();

        try {

            // ================= CREATE ORDER =================
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'shipped',
                'payment_method' => $request->payment_method,

                // user info
                'name' => $request->name,
                'phone' => $request->phone,
                'shipping_address' => $request->address,
                'delivery_user_id' => 2,
            ]);

            // ================= ORDER ITEMS =================
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->product->price * $item->quantity,
                ]);

                // increase sold count
                $item->product->increment('sold', $item->quantity);
            }

            Transaction::create([
            'transaction_id' => 'TRX-' . time() . rand(1000, 9999),
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'amount' => $total,
            'status' => $request->payment_method === 'cash' ? 'pending' : 'completed',
            'payment_method' => $request->payment_method,
            'transaction_date' => now(),

        ]);
        $customer = Customer::firstOrCreate(
            ['email' => Auth::user()->email],
            [
                'customer_id' => 'CUS-' . rand(1000, 9999),
                'name' => $request->name,
                'phone' => $request->phone,
                'country' => $request->country ?? 'Unknown',
                'status' => 'Active',
            ]
        );

            // ================= CLEAR CART =================
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('orders.index')
                ->with('success', 'Order placed successfully');

        } catch (\Exception $e) {
            DB::rollBack();

    return back()->with('error', 'Order failed: ' . $e->getMessage());        }
    }


    
     public function contact()
    {
        return view('components.user.Pages.contact');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        message::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Message sent successfully');
    }
     public function show(Category $category)
    {
        $products = $category->products()->latest()->paginate(12);

        $categories = Category::all();

        return view('components.user.pages.category', compact(
            'category',
            'products',
            'categories'
        ));
    }
}
