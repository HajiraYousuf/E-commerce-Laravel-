<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index() {
        return view('components.user.Pages.wishlist'); 
    }

    // Halkan waxaa loogu talagalay Logic-ga keydinta (Session ama Database)
    public function store($id) {
        // Halkan koodhka keydinta ayaa la gelinayaa gadaal
        return back()->with('success', 'Alaabta waa la keydiyey!');
    }
}

