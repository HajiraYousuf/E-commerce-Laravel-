<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;

// Bogga Wishlist-ka inuu ina tuso
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');


// Bogga rasmiga ah ee Wishlist-ka (Kani waa kan Nav-barka ku xirmaya)
// Ku dar koodkan faylka routes/web.php
Route::get('/wishlist/add/{product_id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/add/{id}', [WishlistController::class, 'store'])->name('wishlist.store');
Route::get('/wishlist', function () {
    $wishlistIds = session()->get('wishlist', []);

    // Array-gan weeyo kii alaabta dukaankaaga oo dhan hididiisa u ahaa (Hubi inuu la mid yahay kii hore)
    $allProducts = [
        'airpods' => ['name' => 'Airpods Pro', 'price' => '$50', 'image' => 'airpods.jpg'],
        'iphone' => ['name' => 'iPhone 16 PRO', 'price' => '$1,000', 'image' => 'iphone16.jpg'],
        'laptop-pro' => ['name' => 'Laptop Pro', 'price' => '$570', 'image' => 'laptop_pro.jpg'],
        'headphone' => ['name' => 'Sony Headphones', 'price' => '$60', 'image' => 'sony_headphone.jpg'],
    ];

    // Soo saar kaliya alaabta uu user-ku doortay ee session-ka ku jirta
    $wishlistItems = [];
    foreach ($wishlistIds as $id) {
        if (isset($allProducts[$id])) {
            $wishlistItems[$id] = $allProducts[$id];
        }
    }

    return view('components.user.pages.wishlist', compact('wishlistItems'));
})->name('wishlist.index');
Route::view('/products', 'pages.products');
Route::get('/products', function () {
    return view('pages.products');
});

// 1. Bogga faahfaahinta alaabta (Show Page)
Route::get('/product/{id}', function ($id) {
    $products = [
        'headphone' => [
            'name' => 'Airpods Pro',
            'price' => '$50',
            'image' => 'image1.jpg',
            'desc' => 'Immerse yourself in pure sound. Engineered with active noise cancellation and premium bass for non-stop crystal clear audio.'
        ],
        'iphone' => [
            'name' => 'iPhone 16 PRO',
            'price' => '$1,000',
            'image' => 'image2.jpg',
            'desc' => 'The pinnacle of mobile engineering. Featuring an advanced camera system, titanium finish, and the fastest chip on the market.'
        ],
        'laptops' => [
            'name' => 'MacBook Air',
            'price' => '$570',
            'image' => 'image3.jpg',
            'desc' => 'Power meets portability. Built for developers and creators who demand seamless multitasking and heavy-duty performance.'
        ],
        'samsung' => [
            'name' => 'Samsung S24 Ultra',
            'price' => '$900',
            'image' => 'image4.jpg',
            'desc' => 'Experience the ultimate smartphone. Equipped with an industry-leading camera, AI features, and a stunning dynamic display.'
        ],
        'smartwatch' => [
            'name' => 'Apple Watch 8',
            'price' => '$80',
            'image' => 'image5.jpg',
            'desc' => 'Track your health and stay connected in style. Advanced fitness sensors, elegant design, and long-lasting battery life.'
        ],
    ];

    $product = $products[$id] ?? $products['iphone'];

    return view('components.user.pages.show', compact('product', 'id'));
})->name('products.show');

// 2. Bogga foomka dalbashada (Checkout Page)
Route::get('/checkout', function () {
    // Waxaan isticmaalnay request() helper-ka si aan dhibka meesha uga saarno
    $productId = request()->query('product_id', 'Unknown Product');
    
    // U beddel magaca mid qurux badan oo dadku akhrisan karaan
    $productName = ucwords(str_replace('-', ' ', $productId)); 

    return view('components.user.pages.checkout', compact('productName'));
})->name('products.checkout');
// AUTH
Route::get('/auth', [AuthController::class, 'show'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// USER DASHBOARD
Route::get('/dashboard', function () {
    return view('user.dashboard.userdashboard');
})->middleware('auth')->name('dashboard');

// ADMIN DASHBOARD
Route::get('/admin/dashboard', [PagesController::class, 'dashboard'])->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::get('categories/',[CategoryController::class, 'index'])->name('categories');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('categories/store',[CategoryController::class, 'store'])->name('category.store');






Route::get('/products', function () {
    return view('components.user.Pages.products');
});
Route::get('/home', function () {
   return view('components.user.Pages.home');
})->name('home');

