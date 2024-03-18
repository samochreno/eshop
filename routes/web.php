<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Storage;

Route::redirect('/', '/home');
Route::redirect('/home', '/products')
    ->name('home');

Route::get('storage/{path?}', function ($path) {
    return response()->file(Storage::path('public/'.$path));
})->where('path', '(.*)');

Route::prefix('sign-up')->group(function () {
    Route::get('/', [AuthController::class, 'showSignUp'])->name('sign-up');
    Route::post('/', [AuthController::class, 'signUp'])->name('sign-up.process');
});

Route::prefix('sign-in')->group(function () {
    Route::get('/', [AuthController::class, 'showSignIn'])->name('sign-in');
    Route::post('/', [AuthController::class, 'signIn'])->name('sign-in.process');
});

Route::get('/sign-out', [AuthController::class, 'signOut'])->name('sign-out');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'showAll'])->name('products');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('product');
});

Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/', [CheckoutController::class, 'order'])->name('checkout.process');
});

Route::get('/description', [DescriptionController::class, 'show'])->name('description');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::redirect('/', '/admin/customers')->name('admin');

    Route::prefix('customers')->group(function () {
        Route::get('/', [AdminUserController::class, 'show'])->name('admin.users');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [AdminOrderController::class, 'show'])->name('admin.orders');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [AdminProductController::class, 'show'])->name('admin.products');
        Route::post('/create', [AdminProductController::class, 'create']);
        Route::post('/delete', [AdminProductController::class, 'delete']);
    });
});
