<?php

use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\Categories\CategorieController;
use App\Http\Controllers\Dashboard\Coming_soonController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FileController;
use App\Http\Controllers\Dashboard\GalleryController;
use App\Http\Controllers\Dashboard\Get_in_touchController;
use App\Http\Controllers\Dashboard\HistoryController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\OurTeamController;
use App\Http\Controllers\Dashboard\PartnerController;
use App\Http\Controllers\Dashboard\Products\ProductController;
use App\Http\Controllers\Dashboard\User\ProfileController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Models\RoleAndPermission\Enums\RoleType;
use Illuminate\Support\Facades\Route;


$roleAdmin = RoleType::ADMIN;

Route::get('/', [DashboardController::class, 'index'])->name('index');

// Files
Route::group(['prefix' => 'files', 'as' => 'files.'], function () {
    Route::delete('delete/{id}', [FileController::class, 'delete'])->whereUuid('id')->name('delete');
    Route::post('store-temp-file', [FileController::class, 'storeTempFile'])->name('storeTempFile');
});

// Order routes (public - outside admin middleware) - ПЕРЕИМЕНОВАТЬ!
Route::post('/order/create', [OrderController::class, 'checkout'])->name('web.order.create');
Route::get('/checkout', [OrderController::class, 'checkoutPage'])->name('web.checkout.page');
Route::get('/orders', [OrderController::class, 'indexes'])->name('web.orders.index');
Route::get('/orders/{id}', [OrderController::class, 'shows'])->name('web.orders.show');

// Translations
Route::controller(Barryvdh\TranslationManager\Controller::class)->as('translation.')->group(function () {
    Route::get('/translations', 'getIndex')->name('manager');
    Route::get('/translations/view/{group?}', 'getView')->name('group');
});

// Middleware(Admin)
Route::group(['middleware' => ["role:$roleAdmin"]], function () {
    // Users
    Route::resource('users', UserController::class);
    Route::get('users/dataTable/get-list', [UserController::class, 'getListData'])->name('users.getListData');

    // Category
    Route::resource('categories', CategorieController::class)->parameters(['categories' => 'categorie']);
    Route::get('categories/dataTable/get-list', [CategorieController::class, 'getListData'])->name('categories.getListData');
    Route::get('/dashboard/categories/list', [CategorieController::class, 'getAllCategories'])->name('categories.list');

    // Products
    Route::resource('products', ProductController::class)->parameters(['products' => 'product']);
    Route::get('products/dataTable/get-list', [ProductController::class, 'getListData'])->name('products.getListData');

    // OurTeams
    Route::resource('our-teams', OurTeamController::class);
    Route::get('our-teams/dataTable/get-list', [OurTeamController::class, 'getListData'])->name('our-teams.getListData');

    // Blogs
    Route::resource('blogs', BlogController::class);
    Route::get('blogs/dataTable/get-list', [BlogController::class, 'getListData'])->name('blogs.getListData');

    // Galleries
    Route::resource('galleries', GalleryController::class);
    Route::get('galleries/dataTable/get-list', [GalleryController::class, 'getListData'])->name('galleries.getListData');

    // Get_in_touches
    Route::resource('get_in_touches', Get_in_touchController::class);
    Route::get('get_in_touches/dataTable/get-list', [Get_in_touchController::class, 'getListData'])->name('get_in_touches.getListData');

    // Banners
    Route::resource('banners', BannerController::class);
    Route::get('banners/dataTable/get-list', [BannerController::class, 'getListData'])->name('banners.getListData');

    // Coming_soons
    Route::resource('coming_soons', Coming_soonController::class);
    Route::get('coming_soons/dataTable/get-list', [Coming_soonController::class, 'getListData'])->name('coming_soons.getListData');

    // Orders (admin management)
    Route::resource('orders', OrderController::class);
    Route::get('orders/dataTable/get-list', [OrderController::class, 'getListData'])->name('orders.getListData');

    // Partners
    Route::resource('partners', PartnerController::class);
    Route::get('partners/dataTable/get-list', [PartnerController::class, 'getListData'])->name('partners.getListData');

    // Histories
    Route::resource('histories', HistoryController::class);
    Route::get('histories/dataTable/get-list', [HistoryController::class, 'getListData'])->name('histories.getListData');
});

Route::post('/send-mail', [OrderController::class, 'sendStatusEmail'])->name('send-mail');
Route::post('/orders/export-pdf', [OrderController::class, 'exportPdf'])->name('orders.exportPdf');

// Profile
Route::controller(ProfileController::class)->as('profile.')->group(function () {
    Route::get('profile', 'index')->name('index');
    Route::put('profile/{id}', 'update')->whereNumber('id')->name('update');
});



// Route::get('product/{id}', [ProductController::class, 'getProduct'])->name('web.product');
