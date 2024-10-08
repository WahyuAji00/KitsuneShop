<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// User
Route::get('/', [UserController::class, 'index'])->name('home');
Route::middleware(['authUser'])->group(function() {
    Route::get('/shop', [UserController::class, 'shop'])->name('shop');
    Route::prefix('/shop')->name('shop.')->group(function() {
        Route::get('/detailProduct/{name}', [UserController::class, 'detailProduct'])->name('detailProduct');
        Route::post('/add-to-cart/{id}', [UserController::class, 'addToCart'])->name('addToCart');
        Route::post('/add-to-favorites/{id}', [UserController::class, 'addToFavorites'])->name('addToFavorites');
        Route::get('/favoriteProduct', [UserController::class, 'viewFavoriteProduct'])->name('viewFavoriteProduct');
        Route::get('/cartProduct', [UserController::class, 'viewCartProduct'])->name('viewCartProduct');
    });
    Route::get('/activity', [UserController::class, 'activity'])->name('activity');
    Route::get('/about', [UserController::class, 'about'])->name('about');
    Route::get('/user', [UserController::class, 'profileUser'])->name('profileUser');
});
Route::get('/login', [UserController::class, 'showLoginUser'])->name('login');
Route::post('/login', [UserController::class, 'loginUser']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
Route::get('/register', [UserController::class, 'showRegisterUser'])->name('register');
Route::post('/register', [UserController::class, 'registerUser']);



// Admin
Route::middleware('authAdmin')->group(function() {
    Route::get('/adminPage', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::prefix('/adminPage')->name('adminPage.')->group(function() {
        Route::get('/product', [AdminController::class, 'product'])->name('product');
        Route::prefix('/product')->name('product.')->group(function() {
            Route::get('/createProduct', [AdminController::class, 'createProduct'])->name('createProduct');
            Route::post('/prosesCreateProsuct', [AdminController::class, 'prosesCreateProduct'])->name('prosesCreateProduct');
            Route::get('/editProduct/{id}', [AdminController::class, 'editProduct'])->name('editProduct');
            Route::put('/updateProduct/{id}', [AdminController::class, 'updateProduct'])->name('updateProdct');
            Route::get('/historyProduct/{id}', [AdminController::class, 'historyProduct'])->name('historyProduct');
            Route::get('/deleteProduct/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');
            Route::get('/restoreProduct/{id}', [AdminController::class, 'restoreProduct'])->name('restoreProduct');
            Route::get('/forceDeleteProduct/{id}', [AdminController::class, 'forceDeleteProduct'])->name('forceDeleteProduct');
        });
        Route::get('/userData', [AdminController::class, 'userData'])->name('userData');
        Route::prefix('/userData')->name('userData.')->group(function() {
            Route::get('/createUser', [AdminController::class, 'createUser'])->name('createUser');
            Route::post('/prosesCreateUser', [AdminController::class, 'prosesCreateUser'])->name('prosesCreateUser');
            Route::get('/editUser/{id}', [AdminController::class, 'editUser'])->name('editUser');
            Route::put('/updateUser/{id}', [AdminController::class, 'updateUser'])->name('updateUser');
            Route::get('/historyUser/{id}', [AdminController::class, 'historyUser'])->name('historyUser');
            Route::get('/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
            Route::get('/restoreUser/{id}', [AdminController::class, 'restoreUser'])->name('restoreUser');
            Route::get('/forceDeleteUser/{id}', [AdminController::class, 'forceDeleteUser'])->name('forceDeleteUser');
        });
        Route::get('/sale', [AdminController::class, 'sale'])->name('sale');
    });
});
Route::get('/loginAdmin', [AdminController::class, 'loginAdmin'])->name('loginAdmin');
Route::post('/loginAdmin', [AdminController::class, 'login_prosesAdmin']);
Route::post('/logoutAdmin', function () {
    Auth::logout();
    return redirect('/loginAdmin');
})->name('logoutAdmin');
Route::get('/registerAdmin', [AdminController::class, 'registerAdmin'])->name('registerAdmin');
Route::post('/registerAdmin', [AdminController::class, 'register_prosesAdmin']);
