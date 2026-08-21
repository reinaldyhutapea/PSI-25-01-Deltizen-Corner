<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\ConfirmAdminController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


// ==========================================
// AUTH ROUTES (Guest only)
// ==========================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login_process'])->name('login.submit');
Route::post('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');


// ==========================================
// PUBLIC ROUTES (Semua orang bisa akses)
// ==========================================
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

// Menu (browsing produk — publik)
Route::get('/menu', [HomeController::class, 'all'])->name('products.index');
Route::get('/menu/semua', [HomeController::class, 'semua'])->name('products.semua');
Route::get('/menu/makanan', [HomeController::class, 'makanan'])->name('products.makanan');
Route::get('/menu/minuman', [HomeController::class, 'minuman'])->name('products.minuman');
Route::get('/menu/promo', [HomeController::class, 'promo'])->name('products.promo');
Route::get('/menu/cari', [HomeController::class, 'cari'])->name('products.cari');

// Detail produk (publik)
Route::get('/product/detail_front/{id}', [HomeController::class, 'detail_front'])->name('product.detail_front');

// Cart (session-based, bisa guest)
Route::get('/cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/bayar', [CartController::class, 'bayar'])->name('cart.bayar');
Route::get('/cart/guest-login', [CartController::class, 'guestLogin'])->name('cart.guest-login');


// ==========================================
// CUSTOMER ROUTES (Login/Guest dengan session)
// Invoice & Pembayaran — hanya bisa diakses oleh pemilik order
// ==========================================
Route::get('/invoice/list', [InvoiceController::class, 'list'])->name('invoice.list');
Route::get('/invoice/detail/{id}', [InvoiceController::class, 'detail'])->name('invoice.detail');
Route::get('/pembayaran/{id}', [HomeController::class, 'pembayaran'])->name('pembayaran');
Route::get('/confirm/{id}', [ConfirmController::class, 'index'])->name('confirm.index');
Route::post('/confirm/store', [ConfirmController::class, 'store'])->name('confirm.store');


// ==========================================
// OWNER ROUTES (role:owner middleware)
// ==========================================
Route::middleware(['role:owner'])->prefix('owner')->group(function () {
    // Dashboard & Profil
    Route::get('/index', [OwnerController::class, 'index0'])->name('owner.index');
    Route::get('/profil', [OwnerController::class, 'profil'])->name('owner.profil');
    Route::post('/profil/change_password', [OwnerController::class, 'store'])->name('change.password');

    // Laporan Penjualan
    Route::get('/laporan/penjualan', [OwnerController::class, 'penjualan'])->name('owner.laporan_penjualan');
    Route::get('/laporan/penjualan/cetak', [OwnerController::class, 'penjualan_cetak'])->name('penjualan.cetak');

    // Laporan Pesanan
    Route::get('/laporan/pesanan', [OwnerController::class, 'index2'])->name('laporan.data');
    Route::get('/laporan/pesanan/cetak', [OwnerController::class, 'pesanan_cetak'])->name('pesanan.cetak');
    Route::get('/laporan/pesanan/tercetak', [OwnerController::class, 'cari2'])->name('pesanan.tercetak');
    Route::get('/laporan/pesanan/{id}', [OwnerController::class, 'pesananLaporanDetail'])->name('pesanan.data.detail');
    Route::get('/laporan/cari', [OwnerController::class, 'cari']);
    Route::get('/laporan/kategori', [OwnerController::class, 'kategori']);

    // Data Management
    Route::get('/produk', [OwnerController::class, 'index3']);
    Route::get('/pelanggan', [OwnerController::class, 'index4']);
    Route::get('/admin', [OwnerController::class, 'index5']);
    Route::get('/data/produk', [OwnerController::class, 'produkOwner'])->name('produk.data');
    Route::get('/data/admin', [OwnerController::class, 'adminOwner'])->name('admin.data');
    Route::post('/data/admin', [OwnerController::class, 'storeAdmin'])->name('owner.storeAdmin');
    Route::get('/data/pelanggan', [OwnerController::class, 'pelangganOwner'])->name('pelanggan.data');
    Route::get('/data/penjualan', [OwnerController::class, 'penjualanLaporan'])->name('penjualan.data');
    Route::get('/data/pesanan', [OwnerController::class, 'pesananLaporan'])->name('pesanan.data');

    // Cetak
    Route::get('/cetak_pertanggal/{tglawal}/{tglakhir}', [OwnerController::class, 'cetak'])->name('order.cetak_pertanggal');
});


// ==========================================
// ADMIN ROUTES (role:admin middleware)
// ==========================================
Route::middleware(['role:admin'])->group(function () {
    // Dashboard & Profil
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profil', [AdminController::class, 'profil'])->name('admin.profil');
    Route::post('/admin/profil/change_password', [AdminController::class, 'store'])->name('admin.password');

    // Order Management
    Route::get('/admin/order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/admin/order/data', [OrderController::class, 'produkData'])->name('admin.order.data');
    Route::get('/admin/order/detail/{id}', [OrderController::class, 'detail'])->name('admin.order.detail');
    Route::post('/admin/order/{id}/update-status', [OrderController::class, 'updateStatus'])->name('admin.order.updateStatus');

    // Product Management
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/data', [ProductController::class, 'produkData'])->name('product2.data');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::get('/product/stoks/{id}', [ProductController::class, 'changeStoks'])->name('change.stoks');

    // Category Management
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/categories/detail/{id}', [CategoryController::class, 'detail'])->name('category.detail');

    // Confirm Admin (verifikasi pembayaran)
    Route::get('/confirmAdmin', [ConfirmAdminController::class, 'index'])->name('confirmAdmin');
    Route::get('/confirmAdmin/detail/{id}', [ConfirmAdminController::class, 'detail'])->name('confirmAdmin.detail');
    Route::post('/confirmAdmin/terima/{order_id}', [ConfirmAdminController::class, 'terima'])->name('confirmAdmin.terima');
    Route::post('/confirmAdmin/tolak/{order_id}', [ConfirmAdminController::class, 'tolak'])->name('confirmAdmin.tolak');

    // Invoice (admin view)
    Route::get('/admin/invoice/detail/{id}', [OrderController::class, 'invoiceDetail'])->name('admin.invoice.detail');
});
