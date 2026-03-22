<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\Categories\CategorieController;
use App\Http\Controllers\Dashboard\Get_in_touchController;
use App\Http\Controllers\Dashboard\HistoryController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\OurTeamController;
use App\Http\Controllers\Dashboard\PartnerController;
use App\Http\Controllers\Web\Basket\BasketController;
use App\Http\Controllers\Web\Product\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('language/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ru'])) {
        abort(400);
    }

    $cookie = cookie('locale', $locale, 60 * 24 * 30);

    app()->setLocale($locale);

    return redirect()->back()->withCookie($cookie);
})->name('language.switch');

Auth::routes(['register' => false, 'reset' => false]);

Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::post('auth/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Route::get('/', function () {
//    return redirect(route('login'));
// });

// Route::get('/my', function () {
//    return view('web.home');
// });

// Redirect root to home
Route::get('/', function () {
    return redirect()->route('web.home');
});

// Public pages
Route::view('/home', 'web.home')->name('web.home');
Route::view('/team', 'web.team')->name('web.team');
Route::view('/what-we-offer', 'web.shop')->name('web.what-we-offer');
Route::view('/shop', 'web.shop')->name('web.shop');
Route::view('/faq', 'web.faq')->name('web.faq');
Route::view('/contact', 'web.contact')->name('web.contact');
Route::view('/gallery', 'web.gallery')->name('web.gallery');
Route::view('/contact-us', 'web.contact-us')->name('web.contact-us');

Route::view('/wedding-furnitures', 'web.wedding-furnitures')->name('wedding.furnitures');
Route::view('/birthday-furnitures', 'web.birthday-furnitures')->name('birthday.furnitures');
Route::view('/macarons', 'web.macarons')->name('macarons');
Route::view('/cup-furnitures', 'web.cup-furnitures')->name('cup.furnitures');
Route::view('/biscuits', 'web.biscuits')->name('biscuits');

// Legal pages
Route::view('/privacy-policy', 'web.privacy-policy')->name('web.privacy.policy');
Route::view('/terms-and-conditions', 'web.terms')->name('web.terms');

// Auth user pages
// Route::view('/cart', 'web.cart')->name('web.cart');
// Route::get('/cart/{id}', [CartController::class, 'index'])->name('web.cart');
// Route::view('/checkout', 'web.checkout')->name('web.checkout');

// Product
Route::get('/products', [ProductController::class, 'index'])->name('web.products');
Route::get('/products/{id}', [ProductController::class, 'getProduct'])->name('web.product')->whereNumber('id');
Route::get('/product/{categoryId}', [ProductController::class, 'getProductForCategories'])->name('web.products.category');
Route::get('/products/get-eight', [ProductController::class, 'getEightProducts'])->name('web.getEightProducts');
Route::get('/shop/products', [ProductController::class, 'browse'])->name('web.shop.products');
Route::get('/shop/filter', [ProductController::class, 'browse'])->name('web.shop.filter');
Route::get('/search-products', [ProductController::class, 'search'])->name('products.search');

// Корзина
Route::get('/basket', [BasketController::class, 'show'])->name('web.cart');
Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
Route::post('/basket/update', [BasketController::class, 'updateQuantity'])->name('basket.update');
Route::delete('/basket/remove/{id}', [BasketController::class, 'remove'])->name('basket.remove');
Route::get('/basket/data', [BasketController::class, 'getData'])->name('basket.data');

// Оформление заказа
Route::get('/checkout', [OrderController::class, 'checkoutPage'])->name('order.checkout');
Route::get('/orders', [OrderController::class, 'indexes'])->name('order.index');
Route::get('/orders/{id}', [OrderController::class, 'shows'])->name('order.show');

// Blog
Route::get('/blog', [BlogController::class, 'getBlogs'])->name('web.blog');
Route::get('/get-latest-blogs', [BlogController::class, 'getLatestBlogs'])->name('web.getLatestBlogs');
Route::get('/blog/{id}', [BlogController::class, 'getSingleBlog'])->name('web.getSingleBlog');

// get_in_touches
Route::post('/contact', [Get_in_touchController::class, 'store'])->name('contact.submit');

// Our Partners
Route::get('/our-partners', [PartnerController::class, 'getPartnersData'])->name('web.our-partners');

// Our-teams
Route::get('/get-team-members', [OurTeamController::class, 'getLatestMembers'])->name('web.getTeamMembers');

// Categories
Route::get('/categories', [CategorieController::class, 'getCategories'])->name('web.category');

Route::get('/about', [HistoryController::class, 'geet'])->name('web.about');

Route::post('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

// Example for a catch-all page if needed
// Route::fallback(function () {
//    return view('web.404');
// });
