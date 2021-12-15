<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Auth::routes();

//guest or accessible to anyone
Route::get('/', [GuestController::class, 'index'])->name('home');
Route::get('/profile', [GuestController::class, 'profile']);
Route::get('/products', [GuestController::class, 'showProduct']);


//admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/order_list', [AdminController::class, 'order_list']);
    Route::get('/admin/produk', [AdminController::class, 'product']);
    Route::get('/admin/profile', [AdminController::class, 'profile']);
    Route::get('/admin/history', [AdminController::class, 'history']);
    Route::get('/admin/detail_produk', [AdminController::class, 'single_product']);
    Route::post('/admin/hapus_produk', [AdminController::class, 'delete']);
    Route::post('/admin/update_produk', [AdminController::class, 'update_product']);
    Route::get('/admin/tambah_produk', [AdminController::class, 'add_product_page']);
    Route::post('/admin/add', [AdminController::class, 'create']);
    Route::post('/admin/store', [AdminController::class, 'store']);
    Route::get('/admin/myprofile', [AdminController::class, 'profile']);
    Route::post('/admin/update_profile', [AdminController::class, 'update_profile']);
    Route::post('/admin/editBills', [AdminController::class, 'editBills']);
    Route::post('/admin/updateBills', [AdminController::class, 'updateBills']);
    Route::get('/admin/history', [AdminController::class, 'history']);
    Route::post('/admin/deleteBills', [AdminController::class, 'deleteBills']);
    Route::get('/admin/billDetail', [AdminController::class, 'billDetail']);
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::post('/admin/update_user', [AdminController::class, 'update_user']);
    Route::post('/admin/update_admin', [AdminController::class, 'update_admin']);
    Route::post('/admin/delete_user', [AdminController::class, 'delete_user']);
    Route::post('/admin/single_product_read', [AdminController::class, 'single_product_read']);
});

// user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index']);
    Route::get('/user/showprofile', [UserController::class, 'showprofile']);
    Route::get('/user/cart', [UserController::class, 'showCart'])->name('cart');
    Route::post('/user/addcart', [UserController::class, 'addCart']);
    Route::get('/user/product', [UserController::class, 'showProduct']);
    Route::get('/user/myprofile', [UserController::class, 'showMyProfile']);
    Route::post('/user/update_profile', [UserController::class, 'updateProfile']);
    Route::post('/user/updateQuantity', [UserController::class, 'updateQuantity']);
    Route::post('/user/addToCart', [UserController::class, 'addToCart']);
    Route::post('/user/deleteCart', [UserController::class, 'deleteCart']);
    Route::post('/user/addBill', [UserController::class, 'addBill']);
    Route::get('/user/history', [UserController::class, 'history']);
    Route::post('/user/bill', [UserController::class, 'bill_page']);

    //untuk keperluan ongkir
    Route::get('/province/{id}/cities', [UserController::class,'getCities']);
    Route::post('/user/cart', [UserController::class,'submit']);
});


