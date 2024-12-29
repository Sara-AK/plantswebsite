<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlantProductController;
use App\Http\Controllers\PlantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

Route::get('/plants', [PlantController::class, 'index'])->name('plants.index'); // List all plants
Route::get('/plants/{id}', [PlantController::class, 'show'])->name('plants.show'); // Show a specific plant


Route::get('/', [WelcomeController::class, 'index']);

Route::get('/plants', [PlantController::class, 'publicIndex'])->name('plants.index');
Route::get('/plants/{plant}', [PlantController::class, 'publicShow'])->name('plants.show');

Route::get('/products', [PlantProductController::class, 'publicIndex'])->name('products.index');
Route::get('/products/{product}', [PlantProductController::class, 'publicShow'])->name('products.show');

Route::prefix('admin')->group(function () {
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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('plant-products', PlantProductController::class);


require __DIR__ . '/auth.php';
