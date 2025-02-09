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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleRequestController;

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

    Route::get('/role-requests', [AdminController::class, 'roleRequests'])->name('admin.role.requests');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/assign', [AdminController::class, 'showAssignAdminForm'])->name('admin.assign');
        Route::post('/admin/assign', [AdminController::class, 'assignAdmin'])->name('admin.assign.post');
    });
});

// =========================
// 👤 User Routes
// =========================
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
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
});

// =========================
// 🔑 Authentication Routes
// =========================
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// =========================
// 🏷️ Role Request Routes
// =========================
// Route::post('/role/request', [RoleRequestController::class, 'store'])->name('role.request');

// Route::post('/role/request', [RoleRequestController::class, 'store'])->name('role.request');
// Route::post('/role/request/cancel', [RoleRequestController::class, 'cancel'])->name('role.request.cancel');
// Route::post('/role/request/modify', [RoleRequestController::class, 'modify'])->name('role.request.modify');
Route::patch('/role/request/{roleRequest}', [RoleRequestController::class, 'update'])
    ->name('role.request.update')
    ->middleware(['auth', 'role:admin']);
Route::get('/role-request', function () {
    return view('role_request');
})->middleware('auth')->name('role.request.view');

Route::middleware(['auth'])->group(function () {
    Route::post('/role/request', [RoleRequestController::class, 'store'])->name('role.request');
    Route::post('/role/request/cancel', [RoleRequestController::class, 'cancel'])->name('role.request.cancel');
    Route::post('/role/request/modify', [RoleRequestController::class, 'modify'])->name('role.request.modify');
    Route::post('/role/request/remove', [RoleRequestController::class, 'requestRoleRemoval'])->name('role.request.remove'); // New Route
    Route::post('/role/request/change', [RoleRequestController::class, 'requestRoleChange'])->name('role.request.change'); // New Route
});


// =========================
// 📝 Blog Posts Routes
// =========================
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');

// =========================
// 🛠️ Miscellaneous Routes
// =========================
Route::get('/role-request-status', [UserController::class, 'showRequestStatus'])->middleware('auth');

// ✅ Include Laravel authentication routes
require __DIR__.'/auth.php';
