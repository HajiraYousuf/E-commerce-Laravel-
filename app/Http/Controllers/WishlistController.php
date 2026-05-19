<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function store(Request $request, $id) 
    {
        // Logic-gaaga keydinta session-ka halkan geli saxiib
        $wishlist = session()->get('wishlist', []);
        
        if (!in_array($id, $wishlist)) {
            $wishlist[] = $id;
            session()->put('wishlist', $wishlist);
        }

        // Waxaan ka saaray calaamadihii HTML-ka ahaa ee khaldamay
        return back()->with('success', 'Alaabta si guul leh ayaa loogu daray Wishlist-ka!');
    }
}