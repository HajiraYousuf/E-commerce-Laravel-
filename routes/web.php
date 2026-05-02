<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;

// Bogga Wishlist-ka inuu ina tuso
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

// Inaan alaab ku darno Wishlist-ka
Route::get('/wishlist/create', [WishlistController::class, 'store'])->name('wishlist.add');


Route::get('/', function () {
    return view('welcome');
});





Route::get('/products', function () {
    return view('components.user.Pages.products');
});
Route::get('/home', function () {
   return view('components.user.Pages.home');
})->name('home');
