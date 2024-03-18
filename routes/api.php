<?php

use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\Route;

Route::post('/cart', [CartController::class, 'index']);
