<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\ConfirmAdminController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Auth::routes();
Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
Route::get('/home', [HomeController::class, 'index'])->name('products.index');
Route::get('/home/cari', [HomeController::class, 'cari'])->name('products.cari');
Route::get('/home/makanan', [HomeController::class, 'makanan'])->name('products.makanan');
Route::get('/home/minuman', [HomeController::class, 'minuman'])->name('products.minuman');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/bayar', [CartController::class, 'bayar'])->name('cart.bayar');
Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
Route::get('/invoice/list', [InvoiceController::class, 'list'])->name('invoice.list');
Route::get('/invoice/detail/{id}', [InvoiceController::class, 'detail'])->name('invoice.detail');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/stoks/{id}', [ProductController::class, 'changeStoks'])->name('change.stoks');
Route::get('/product/data', [ProductController::class, 'produkData'])->name('product2.data');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/product/detail_front/{id}', [HomeController::class, 'detail_front'])->name('product.detail_front');
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/categories/detail/{id}', [CategoryController::class, 'detail'])->name('category.detail');
Route::get('/confirmAdmin', [ConfirmAdminController::class, 'index'])->name('confirmAdmin');
Route::get('/confirmAdmin/detail/{id}', [ConfirmAdminController::class, 'detail'])->name('confirmAdmin.detail');
Route::get('/confirmAdmin/terima/{order_id}', [ConfirmAdminController::class, 'terima'])->name('confirmAdmin.terima');
Route::get('/confirmAdmin/tolak/{order_id}', [ConfirmAdminController::class, 'tolak'])->name('confirmAdmin.tolak');
Route::get('/confirm/{id}', [ConfirmController::class, 'index'])->name('confirm.index');
Route::post('/confirm/store', [ConfirmController::class, 'store'])->name('confirm.store');
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/order/data', [OrderController::class, 'produkData'])->name('order.data');
Route::get('/order/record', [OrderController::class, 'Records'])->name('order.record');
Route::get('/order/cetak', [OrderController::class, 'cetak'])->name('order.cetak');
Route::get('/order/detail/{id}', [OrderController::class, 'detail'])->name('order.detail');
Route::get('/admin/profil',[AdminController::class, 'profil'])->name('admin.profil');
Route::post('/admin/profil/change_password',[AdminController::class, 'store'])->name('admin.password');
Route::get('/tentang',[HomeController::class, 'tentang']);
Route::get('/kontak',[HomeController::class, 'kontak']);
Route::get('/owner/index',[OwnerController::class, 'index0'])->name('owner.index');
Route::get('/owner/profil',[OwnerController::class, 'profil'])->name('owner.profil');
Route::post('/owner/profil/change_password',[OwnerController::class, 'store'])->name('change.password');
Route::get('/owner/laporan/penjualan',[OwnerController::class, 'index']);
Route::get('/owner/laporan/penjualan/cetak',[OwnerController::class, 'penjualan_cetak'])->name('penjualan.cetak');
Route::get('/owner/laporan/pesanan',[OwnerController::class, 'index2']);
Route::get('/owner/laporan/pesanan/cetak',[OwnerController::class, 'pesanan_cetak'])->name('pesanan.cetak');
Route::get('/owner/laporan/pesanan/tercetak',[OwnerController::class, 'cari2'])->name('pesanan.tercetak');
Route::get('/owner/produk',[OwnerController::class, 'index3']);
Route::get('/owner/pelanggan',[OwnerController::class, 'index4' ]);
Route::get('/owner/admin',[OwnerController::class, 'index5']);
Route::get('/owner/data/produk',[OwnerController::class, 'produkOwner'])->name('produk.data');
Route::get('/owner/data/admin',[OwnerController::class, 'adminOwner'])->name('admin.data');
Route::get('/owner/data/pelanggan',[OwnerController::class, 'pelangganOwner'])->name('pelanggan.data');
Route::get('/owner/data/penjualan',[OwnerController::class, 'penjualanLaporan'])->name('penjualan.data');
Route::get('/owner/data/pesanan',[OwnerController::class, 'pesananLaporan'])->name('pesanan.data');
Route::get('/owner/laporan/cari',[OwnerController::class, 'cari']);
Route::get('/owner/laporan/kategori',[OwnerController::class, 'kategori']);
Route::get('/order/cetak_pertanggal/{tglawal}/{tglakhir}', [OwnerController::class, 'cetak'])->name('order.cetak_pertanggal');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/profil', [AdminController::class, 'profil'])->name('admin.profil');
        Route::post('/profil/change_password', [AdminController::class, 'store'])->name('admin.password');
    });
});




