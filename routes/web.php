<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlantProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GardenerController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\RoleRequestController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrderController;




// =========================
// 🚀 Public Routes
// =========================
Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/plants', [PlantController::class, 'publicIndex'])->name('public.plants.index');
Route::get('/plants/{plant}', [PlantController::class, 'publicShow'])->name('public.plants.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('public.categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('public.categories.show');

Route::get('/products', [PlantProductController::class, 'publicIndex'])->name('public.products.index');
Route::get('/products/{product}', [PlantProductController::class, 'publicShow'])->name('public.products.show');

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');



// =========================
// 🔒 Authenticated & Verified Users
// =========================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================
// 🛠 Admin Routes (Only Admins)
// =========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/user/{id}', [AdminController::class, 'destroy'])->name('admin.user.delete');

    Route::resource('articles', ArticleController::class);

    Route::resource('plants', PlantController::class)->names([
        'index' => 'admin.plants.index',
        'create' => 'admin.plants.create',
        'store' => 'admin.plants.store',
        'edit' => 'admin.plants.edit',
        'update' => 'admin.plants.update',
        'destroy' => 'admin.plants.destroy',
    ]);
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store'); // 👈 ADD THIS
        Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    });

    Route::get('/regions/{region}/edit', [RegionController::class, 'edit'])->name('regions.edit');
    Route::put('/regions/{region}', [RegionController::class, 'update'])->name('regions.update');

    // Categories
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');


    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ])->except(['show']); // Exclude 'show' to avoid conflicts with public categories

    Route::resource('products', PlantProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);


    Route::resource('regions', RegionController::class)->names([
        'index' => 'admin.regions.index',
        'create' => 'admin.regions.create',
        'store' => 'admin.regions.store',
        'edit' => 'admin.regions.edit',
        'update' => 'admin.regions.update',
        'destroy' => 'admin.regions.destroy',
    ]);

    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::post('/user/register', [AdminController::class, 'registerUser'])->name('admin.user.register');
    Route::post('/user/{user}/assign-admin', [AdminController::class, 'assignAdmin'])->name('admin.user.assignAdmin');
    Route::post('/user/{user}/change-role', [AdminController::class, 'changeUserRole'])->name('admin.user.changeRole');
    Route::post('/user/{user}/delete', [AdminController::class, 'deleteUser'])->name('admin.user.delete');

    Route::post('/role-requests/{roleRequest}/update', [AdminController::class, 'updateRoleRequest'])->name('admin.role.request.update');


    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


});

// =========================
// 👤 User Routes
// =========================
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::post('/account/delete', [UserController::class, 'deleteAccount'])->name('account.delete');
});

// =========================
// 🌱 Gardener Routes
// =========================
Route::middleware(['auth', 'role:gardener'])->prefix('gardener')->group(function () {
    Route::get('/dashboard', [GardenerController::class, 'index'])->name('gardener.dashboard');
    Route::get('/inquiries', [GardenerController::class, 'viewInquiries'])->name('gardener.inquiries');
});

// =========================
// 🛒 Seller Routes
// =========================
Route::middleware(['auth', 'role:seller'])->prefix('seller')->group(function () {
    Route::get('/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('/items', [SellerController::class, 'store'])->name('seller.items');

    Route::get('/products/create', [PlantProductController::class, 'create'])->name('seller.products.create');
    Route::post('/products/store', [PlantProductController::class, 'store'])->name('seller.products.store');
    Route::get('/products/{product}/edit', [PlantProductController::class, 'edit'])->name('seller.products.edit');
    Route::patch('/products/{product}', [PlantProductController::class, 'update'])->name('seller.products.update');
    Route::delete('/products/{product}', [PlantProductController::class, 'destroy'])->name('seller.products.destroy');
});

// =========================
// 🛒 Shopping Cart Routes
// =========================
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [ShoppingCartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [ShoppingCartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove/{id}', [ShoppingCartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/clear', [ShoppingCartController::class, 'clearCart'])->name('cart.clear');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('orders.place');
});

// =========================
// 📝 Blog Posts Routes
// =========================
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');

// =========================
// ✅ Include Laravel authentication routes
// =========================

Route::middleware('auth')->group(function () {

    // **1️⃣ User Requests a Role**
    Route::post('/role/request', [RoleRequestController::class, 'store'])
        ->name('role.request');

    // **2️⃣ User Checks Role Request Status**
    Route::get('/role-request-status', [UserController::class, 'showRequestStatus'])
        ->name('role.request.status');

    Route::post('/role-request/cancel', [RoleRequestController::class, 'cancel'])
        ->name('role.request.cancel');

    Route::post('/role/remove', [RoleRequestController::class, 'removeRole'])
        ->name('role.remove');

});

// =========================
// ✅ Order routes
// =========================
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('orders.place');
    Route::get('/order-success', [OrderController::class, 'orderSuccess'])->name('orders.success');
});

require __DIR__ . '/auth.php';

