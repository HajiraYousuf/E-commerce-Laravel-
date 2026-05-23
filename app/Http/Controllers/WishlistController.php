<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
     public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('components.user.Pages.wishlist', compact('wishlists'));
    }

    // Halkan waxaa loogu talagalay Logic-ga keydinta (Session ama Database)
    public function store($id)
{
    $wishlist = Wishlist::where('user_id', Auth::id())
        ->where('product_id', $id)
        ->first();

    if ($wishlist) {
        $wishlist->delete();
        $message = 'Removed from wishlist';
    } else {
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
        ]);
        $message = 'Added to wishlist';
    }

    return back()->with('success', $message);
}
}

