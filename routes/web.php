<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;

use App\Http\Controllers\AdminController;


Route::post('/PostLogin', [AdminController::class, 'PostLogin'])->name('post.login');

Route::middleware(['admin'])->group(function () {

    Route::inertia('/', 'Auth/Login');

    Route::inertia('/dashboard', 'Dashboard'); 
    Route::get('/products', [AdminController::class, 'Products']);

    Route::get('/products/{category}', [AdminController::class, 'FilterProducts']);
    
    Route::inertia('/create-product', 'CreateProduct');
    Route::post('/post-product', [AdminController::class, 'PostProduct']);

    Route::delete('/delete-product/{id}', [AdminController::class, 'DeleteProduct']);

    Route::post('/update-product', [AdminController::class, 'UpdateProduct']);

    Route::inertia('/videos', 'Videos');

    Route::get('/videos/{id}', [AdminController::class, 'VideoPlayer']);

    Route::get('/logout', [AdminController::class, 'logout']); 
});

