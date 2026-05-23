<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display Cart Page
     */
    public function index()
{
    $cartItems = Cart::with('product')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    // SUBTOTAL
    $subtotal = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    // SHIPPING
    $shipping = 5;

    // TAX 5%
    $tax = $subtotal * 0.05;

    // FINAL TOTAL
    $total = $subtotal + $shipping + $tax;

    return view('components.user.Pages.cart', compact(
        'cartItems',
        'subtotal',
        'shipping',
        'tax',
        'total'
    ));
}

    /**
     * Add Product To Cart
     */
    public function add($productId)
    {
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Please login first.');
        }

        $product = Product::findOrFail($productId);

        // Check stock
        if ($product->stock < 1) {
            return back()->with('error', 'Product out of stock.');
        }

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cart) {

            // Prevent exceeding stock
            if ($cart->quantity >= $product->stock) {
                return back()->with('error', 'Maximum stock reached.');
            }

            $cart->increment('quantity');

        } else {

            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Product added to cart.');
    }

    /**
     * Update Quantity
     */
    public function update(Request $request, $id)
{
    $cart = Cart::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $product = $cart->product;

    $quantity = max(1, (int) $request->quantity);

    if ($quantity > $product->stock) {
        return back()->with('error', 'Not enough stock available.');
    }

    $cart->update([
        'quantity' => $quantity
    ]);

    return back();
}   

    /**
     * Remove Item
     */
    public function remove($id)
    {
        $cart = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart) {
            return back()->with('error', 'Cart item not found.');
        }

        $cart->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * Clear Cart
     */
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Cart cleared.');
    }
}