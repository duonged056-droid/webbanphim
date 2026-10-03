<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SanPhamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/san-pham/{id}', [HomeController::class, 'detail'])->name('detail');
Route::get('/lien-he', [HomeController::class, 'contact'])->name('contact');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cart Routes (Yêu cầu đăng nhập)
Route::middleware(['auth'])->group(function () {
    Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/gio-hang/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/gio-hang/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    
    // Tự build bàn phím
    Route::get('/build', [App\Http\Controllers\BuildController::class, 'index'])->name('build.index');
    Route::post('/build', [App\Http\Controllers\BuildController::class, 'process'])->name('build.process');

    // Thanh toán
    Route::get('/thanh-toan', [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('/thanh-toan', [CartController::class, 'processCheckout'])->name('checkout.process');

    // Đơn hàng của khách
    Route::get('/don-hang', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/don-hang/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::post('/don-hang/{id}/complete', [App\Http\Controllers\OrderController::class, 'markAsCompleted'])->name('orders.complete');
});

// Admin Routes (CRUD Sản Phẩm)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('sanpham', SanPhamController::class);
    
    // Quản lý đơn hàng
    Route::get('/don-hang', [App\Http\Controllers\OrderController::class, 'adminIndex'])->name('orders.index');
    Route::get('/don-hang/{id}', [App\Http\Controllers\OrderController::class, 'adminShow'])->name('orders.show');
    Route::post('/don-hang/{id}/complete', [App\Http\Controllers\OrderController::class, 'adminMarkAsCompleted'])->name('orders.complete');
});
