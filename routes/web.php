<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManajerGudangController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockOpnameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini kita mendefinisikan route aplikasi Stockify.
| Pastikan route untuk login, logout, dan halaman utama tersedia,
| kemudian semua route yang memerlukan autentikasi dikelompokkan.
|
*/

// Routes untuk Login & Logout
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [LoginController::class, 'index']);

// Routes yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    
    // Global dashboard (bisa diakses oleh semua role jika diperlukan)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Group Routes untuk Admin
    Route::middleware(['role:Admin'])->prefix('admin')->name('admin.')->group(function () {
        
        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // --- Manajemen Produk ---
        // Import/Export Produk (didefinisikan terlebih dahulu agar tidak tertangkap oleh resource route produk)
        Route::get('/products/import', [ProductController::class, 'importForm'])->name('products.import');
        Route::post('/products/import', [ProductController::class, 'import'])->name('products.import.process');
        Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
        
        // Resource route untuk Produk (kecuali method show jika tidak diperlukan)
        Route::resource('products', ProductController::class)->except(['show']);
        // Routes untuk transaksi stok
        Route::get('products/transaction/{type}', [ProductController::class, 'createTransaction'])
        ->name('products.transaction.create');
        Route::post('products/transaction/{type}', [ProductController::class, 'storeTransaction'])
        ->name('products.transaction.store');
        
        // --- Manajemen Kategori Produk ---
        Route::resource('categories', CategoryController::class);
        
        // --- Manajemen Atribut Produk ---
        Route::resource('product_attributes', ProductAttributeController::class);
        
        // --- Manajemen Supplier ---
        Route::resource('suppliers', SupplierController::class);
        
        // --- Manajemen Pengguna ---
        Route::resource('users', UserController::class);
        
        // --- Menu Reports (Gabungan Laporan) ---
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        
        // --- Menu Stock ---
        Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
        Route::get('/stock-opname', [StockOpnameController::class, 'index'])->name('stock.opname');
        Route::get('/stock-settings', [StockController::class, 'settings'])->name('stock.settings');
    
        // Ubah route update stok minimum:
        Route::put('stock/settings/{id}', [StockController::class, 'updateStockSettings'])
            ->name('stock.settings.update');

        
        // --- Pengaturan Aplikasi ---
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::put('/settings/update', [SettingController::class, 'update'])->name('settings.update');
    });

    Route::middleware(['auth', 'role:Manajer Gudang'])
    ->prefix('manajer-gudang')
    ->name('manajer.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'managerDashboard'])->name('dashboard');
        Route::resource('products', ProductController::class);
        Route::get('/manajer/products', [ProductController::class, 'index'])->name('manajer.products.index');
        Route::get('/manajer/products/{id}', [ProductController::class, 'show'])->name('manajer.products.show');
        Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
        Route::resource('suppliers', SupplierController::class);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });


    Route::middleware(['auth', 'role:Staff Gudang'])
    ->prefix('staff-gudang')
    ->name('staff.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'staffDashboard'])->name('dashboard');
        Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    });
    Route::group(['middleware' => ['auth'], 'prefix' => 'staff/stock'], function () {
        Route::get('/pending', [StockController::class, 'pending'])->name('staff.stock.pending');
        Route::post('/update-status/{id}', [StockController::class, 'updateStatus'])->name('staff.stock.update_status');
    });
});
