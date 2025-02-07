<?php

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
use Illuminate\Support\Facades\Route;

// ✅ Homepage route (Ensure WelcomeController exists)
Route::get('/', [WelcomeController::class, 'index'])->name('home');

// ✅ Public Plant Routes
Route::get('/plants', [PlantController::class, 'publicIndex'])->name('public.plants.index');
Route::get('/plants/{plant}', [PlantController::class, 'publicShow'])->name('public.plants.show');

// ✅ Public Category Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('public.categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('public.categories.show');

// ✅ Public Plant Product Routes
Route::get('/products', [PlantProductController::class, 'publicIndex'])->name('public.products.index');
Route::get('/products/{product}', [PlantProductController::class, 'publicShow'])->name('public.products.show');

// ✅ Dashboard route (Authenticated & Verified users only)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Authentication Middleware Group
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Admin Routes (Only accessible to Admins)
Route::middleware('role:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::delete('/user/{id}', [AdminController::class, 'destroy']);

    Route::resource('plants', PlantController::class)->names([
        'index' => 'admin.plants.index',
        'create' => 'admin.plants.create',
        'store' => 'admin.plants.store',
        'edit' => 'admin.plants.edit',
        'update' => 'admin.plants.update',
        'destroy' => 'admin.plants.destroy',
    ]);

    Route::resource('plant-products', PlantProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
});

// ✅ User Routes
Route::middleware('role:user')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index']);
});

// ✅ Gardener Routes
Route::middleware('role:gardener')->group(function () {
    Route::get('/gardener/dashboard', [GardenerController::class, 'index']);
    Route::get('/gardener/inquiries', [GardenerController::class, 'viewInquiries']);
});

// ✅ Seller Routes
Route::middleware('role:seller')->group(function () {
    Route::get('/seller/dashboard', [SellerController::class, 'index']);
    Route::get('/seller/items', [SellerController::class, 'store']);
});

// ✅ Register Routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

// Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
// Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name('register.store');


// ✅ Blog Posts Route
Route::get('/posts', [PostsController::class, 'index'])->name('posts_index');

// ✅ Authentication Routes
require __DIR__.'/auth.php';
