<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\ContactController;

Route::redirect('/', '/home');
Route::redirect('/home', '/products')
    ->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');
Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/products', [ProductController::class, 'showAll'])
    ->name('products');
Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('product');

/*
Route::get('/cart')
    ->name('cart');
*/

Route::get('/description', [DescriptionController::class, 'show'])
    ->name('description');

Route::get('/contact', [ContactController::class, 'show'])
    ->name('contact');

/*
Route::get('/admin/products', [AdminController::class, 'showProducts'])
    ->name('admin.products')
    ->middleware('auth.admin');
Route::get('/admin/orders', [AdminController::class, 'showOrders'])
    ->name('admin.orders')
    ->middleware('auth.admin');
 */
